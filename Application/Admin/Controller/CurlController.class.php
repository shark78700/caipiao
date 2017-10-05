<?php

/**
 * Created by PhpStorm.
 * User: 夏骏
 * Date: 2016/9/13
 * Time: 10:16
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Model;

class CurlController extends Controller
{

    public function Curl()
    {//使用curl库中的curl对象抓取指定url的网页中的html等文件代码
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
                $data = mb_convert_encoding($data, 'utf-8', 'GBK,UTF-8,ASCII');
            }


            $mystr = strchr($data, '</thead>');
            $mystr = strchr($mystr, '</tbody>', true);

            $arrdata = explode('</tr>', $mystr);
            $jieguo = '';
            $yilou = '';

            array_pop($arrdata);
            foreach ($arrdata as $key => $value) {
                $arrx = explode('</td>', $value);
                foreach ($arrx as $key1 => $value1) {
                    preg_match_all('/\d+/', $arrx[0], $jieguo[$key]['time']);
                    if ($jieguo[$key]['time'][0][0] == 61) {
                        break;
                    }
                    $last[$key]['time'] = $jieguo[$key]['time'][0][0];
                    if (strpos($value1, 'chartball') !== false) {
                        preg_match_all('/\d+/', $value1, $arry);
                        $last[$key][] = $arry[0][1];
                        $yilou[$key][] = 0;
                    }
                    if (strpos($value1, 'yl02') !== false || strpos($value1, 'yl01') !== false || strpos($value1, 'bg_p') !== false|| strpos($value1, 'bg_bl') !== false) {
                        if(strpos($value1, 'bg_p') !== false|| strpos($value1, 'bg_bl') !== false){
                            preg_match_all('/\d+/', $value1, $arry);
                            $yilou[$key][] = $arry[0][0];
                        }else {
                            preg_match_all('/\d+/', $value1, $arry);
                            $yilou[$key][] = $arry[0][1];
                        }
                    }
                }
            }

            $semap['times'] = array();
            foreach ($last as $key => $value) {
                $semap['times'][] = array('EQ', $last[$key]['time']);
            }
            $semap['times'][] = 'or';

            $shuangse = M('shuangse');
            $shuangse1 = $shuangse->field('times')->where($semap)->select();


            if ($shuangse1) {
                foreach ($last as $key => $value) {
                    foreach ($shuangse1 as $key1 => $value1) {
                        if ($shuangse1[$key1]['times'] == $last[$key]['time']) {
                            $last[$key]['status'] = 2;
                        }
                    }
                }
            }

            $falg = 0;
            $model = new Model();
            $model->startTrans();


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
                        if ($key1 <= 32) {
                            $data['redyilou'][] = $value1;
                        } else {
                            $data['blueyilou'][] = $value1;
                        }
                    }
                    for ($i = 1; $i < 8; $i++) {
                        if ($i != 7) {
                            $map['allcode'] .= $last[$key][$i - 1] . ',';
                            $map['red' . $i] = $last[$key][$i - 1];
                        } else {
                            $map['allcode'] .= $last[$key][$i - 1];
                            $map['blue'] = $last[$key][$i - 1];
                        }
                    }
                    if ($model->table('bocai_shuangse')->add($map)) {
                        $falg = 1;
                    } else {
                        $falg = 0;
                        $model->rollback();
                        echo 2;
                        exit();
                    }
                    $data['redyilou'] = json_encode($data['redyilou']);
                    $data['blueyilou'] = json_encode($data['blueyilou']);
                    if ($model->table('bocai_shuangseyi')->add($data)) {
                        $falg = 1;
                    } else {
                        $falg = 0;
                        $model->rollback();
                        echo 2;
                        exit();
                    }
                }
            }
            if ($falg == 1) {
                $model->commit();
               /* $allcode=$shuangse->field('allcode')->select();
                $jilv=array();
                for($i=1;$i<=33;$i++){
                    $jilv[]=0;
                }
                foreach ($allcode as $key=>$value){
                    $thisarr=explode(',',$allcode);
                    foreach ($thisarr as $key1 =>$value1){
                        for($i=1;$i<=33;$i++){
                            if($i==$value1){
                                $jilv[$i]++;
                            }
                        }
                    }
                }
                for($i=1;$i<=33;$i++){
                    $jilv[$i]=$jilv[$i]/count($allcode);
                }
                $lv['times']=$map['times'];
                $lv['bai']=json_encode($jilv);
                if(M('shaungsebai')->save($lv)) {*/
                    echo 1;
                    exit();
               /* }else{
                    echo 5;
                    exit();
                }*/
            } else {
                $model->rollback();
                echo 2;
                exit();
            }
        }
    }

    function Show()
    {
        if(IS_GET){
            $this->assign('times',$_GET['times']);
        }
        $this->assign('url', 'Curl/Curl');
        $this->assign('title', '双色球获取数据');
        $this->display('Curl/Curl');
    }

}