<?php
/**
 * Created by PhpStorm.
 * User: 夏骏
 * Date: 2016/9/13
 * Time: 16:12
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Model;

class PaleController extends Controller
{
    public function Pale()
    {
        if (IS_POST) {
            if ($_POST['address'] == null) {
                echo 3;
                exit;
            }
            $cu = curl_init();//创建一个curl对象
            if (!curl_setopt($cu, CURLOPT_URL, $_POST['address'])) {
                echo 4;
                exit;
            }//抓取该url文本内容
            /*  curl_setopt($cu, CURLOPT_HEADER, 1);*///抓取头部
            curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);//文件保存在字符串中还是显示在页面上
            curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
            $data = curl_exec($cu);//运行请求网页
            curl_close($cu);//关闭资源
            $coding = mb_detect_encoding($data);//转化utf8各格式
            if ($coding != 'UTF-8' || !mb_check_encoding($data, 'UTF-8')) {
                $html = mb_convert_encoding($data, 'utf-8', 'GBK,UTF-8,ASCII');
            }

            $jieguo = array();
            $mystr = strchr($data, '</thead>');
            $mystr = strchr($mystr, '</tbody>', true);
            /*$mystr=htmlspecialchars($mystr);*/
            $arrdata = explode('</tr>', $mystr);
            /*  var_dump($arrdata);*/
            array_pop($arrdata);

            foreach ($arrdata as $key => $value) {
                $arrx = explode('</td>', $value);
                foreach ($arrx as $key1 => $value1) {
                    preg_match_all('/\d+/', $arrx[0], $jieguo[$key]['time']);
                    if ($jieguo[$key]['time'][0][0] == 59) {
                        break;
                    }
                    $last[$key]['time'] = $jieguo[$key]['time'][0][0];
                    if (strpos($value1, 'chartball') !== false) {
                        preg_match_all('/\d+/', $value1, $arry);
                        $last[$key][] = $arry[0][1];
                        $yilou[$key][] = 0;
                    }
                    if (strpos($value1, 'yl02') !== false || strpos($value1, 'yl01') !== false || strpos($value1, 'bg_p') !== false||strpos($value1, 'bg_bl') !== false) {
                        if  (strpos($value1, 'bg_p') !== false||strpos($value1, 'bg_bl')){
                            preg_match_all('/\d+/', $value1, $arry);
                            $yilou[$key][] = $arry[0][0];
                        }else {
                            preg_match_all('/\d+/', $value1, $arry);
                            $yilou[$key][] = $arry[0][1];
                        }
                    }
                }
            }


            foreach ($last as $key => $value) {
                $semap['times'][] = array('EQ', $last[$key]['time']);
            }
            $semap['times'][] = 'or';

            $letou = M('letou');
            $letou1 = $letou->field('times')->where($semap)->select();


            if ($letou1) {
                foreach ($last as $key => $value) {
                    foreach ($letou1 as $key1 => $value1) {
                        if ($letou1[$key1]['times'] == $last[$key]['time']) {
                            $last[$key]['status'] = 2;
                        }
                    }
                }
            }


            $model = new Model();
            $model->startTrans();
            $flag = 0;
            foreach ($last as $key => $value) {
                if (!isset($last[$key]['status']) || $last[$key]['status'] != 2) {
                    $map = null;
                    $data = null;
                    $map['times'] = $last[$key]['time'];
                    $data['times'] = $map['times'];
                    foreach ($yilou[$key] as $key1 => $value1) {
                        if ($value1 == 0) {
                            $value1 = '0';
                        }
                        if ($key1 <= 34) {
                            $data['redyi'][] = $value1;
                        } else {
                            $data['blueyi'][] = $value1;
                        }
                    }
                    for ($i = 1; $i < 8; $i++) {
                        if ($i <= 5) {
                            $map['allcode'] .= $last[$key][$i - 1] . ',';
                            $map['red' . $i] = $last[$key][$i - 1];
                        } else {
                            if ($i == 6) {
                                $map['allcode'] .= $last[$key][$i - 1] . ',';
                                $map['blue1'] = $last[$key][$i - 1];
                            } else {
                                $map['allcode'] .= $last[$key][$i - 1];
                                $map['blue2'] = $last[$key][$i - 1];
                            }
                        }
                    }
                    $data['redyi'] = json_encode($data['redyi']);
                    $data['blueyi'] = json_encode($data['blueyi']);
                    if ($model->table('bocai_letou')->add($map)) {
                        $flag = 1;
                    } else {
                        $model->rollback();
                        echo 2;
                        exit();
                    }
                    if ($model->table('bocai_leyi')->add($data)) {
                        $flag = 1;
                    } else {
                        $model->rollback();
                        echo 2;
                        exit();
                    }
                }
            }
            if ($flag == 1) {
                $model->commit();
                echo 1;
                exit();
            } else {
                $model->rollback();
                echo 2;
                exit();
            }
        }
    }

    public function Show()
    {
        if($_GET['times']!=null) {
            $this->assign('times', $_GET['times']);
        }
        $this->assign('url', 'Pale/Pale');
        $this->assign('title', '大乐透获取数据');
        $this->display('Curl/Curl');
    }

}