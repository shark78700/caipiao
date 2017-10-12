<?php
/**
 * Created by PhpStorm.
 * User: 夏骏
 * Date: 2016/9/12
 * Time: 14:39
 */

namespace Home\Controller;


use Think\Controller;
use Think\Jisuan;
use Think\Page;
use Think\User;
use Think\Ylou;

class ShuangseController extends Controller
{
    public function Shuangse()
    {

        $userredis = new User(session_id());
        $userinfo = $userredis->checkmyredis();
        if ($userinfo) {
            for ($i = 1; $i <= 33; $i++) {
                $reball[] = $i;
            }
            for ($i = 1; $i <= 16; $i++) {
                $buleball[] = $i;
            }
            $this->assign('buleball', $buleball);
            $this->assign('reball', $reball);
            $shuangse = M('shuangse');
            $yilou = M('shuangseyi');
            $count = $shuangse->count();
            $page = new Page($count, 30);
            $show = $page->show();
            $yilist = $yilou->field('redyilou,blueyilou')->limit($page->firstRow . ',' . $page->listRows)->order('times desc')->select();
            foreach ($yilist as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $value1 = substr($value1, 1);
                    $value1 = substr($value1, 0, -1);
                    eval ('$yilist[$key][$key1]=array(' . $value1 . ');');
                }
            }
            $list = $shuangse->field('times,red1,red2,red3,red4,red5,red6,blue')->limit($page->firstRow . ',' . $page->listRows)->order('times desc')->select();
            for ($i = 0; $i < count($list); $i++) {
                $zhong = array($list[$i]['red1'], $list[$i]['red2'], $list[$i]['red3'], $list[$i]['red4'], $list[$i]['red5'], $list[$i]['red6']);

                for ($j = 1; $j <= 33; $j++) {
                    if (in_array($j, $zhong)) {
                        $list[$i]['allred'][] = ',' . $j;
                    } else {
                        $list[$i]['allred'][] = $yilist[$i]['redyilou'][$j - 1];
                    }
                }
                for ($j = 1; $j <= 16; $j++) {
                    if ($list[$i]['blue'] == $j) {
                        $list[$i]['allblue'][] = ',' . $j;
                    } else {
                        $list[$i]['allblue'][] = $yilist[$i]['blueyilou'][$j - 1];
                        /*$list[$i]['allblue'][] = $j;*/
                    }
                }

            }
            $nowlo = $yilist = $yilou->field('redyilou,blueyilou')->limit(1)->order('times desc')->select();
            foreach ($nowlo[0] as $key => $value) {
                $value = substr($value, 1);
                $value = substr($value, 0, -1);
                eval ('$nowlo[0][$key]=array(' . $value . ');');
            }
            $finanowlo = $nowlo[0];
            $pingyired=0;
            $pingyiblue=0;
            foreach ($finanowlo['redyilou'] as $key=>$value){
                $pingyired+=$value;
            }
            foreach ($finanowlo['blueyilou'] as $key=>$value){
                $pingyiblue+=$value;
            }
            /*var_dump($nowlo);
            die();*/
            /*for()*/

            $this->assign('nowlo', $finanowlo);
            $this->assign('pingyired', round($pingyired/33,2));
            $this->assign('pingyiblue', round($pingyiblue/16,2));
            $this->assign('jiang', array_reverse($list));
            $this->assign('show', $show);
            $Jisuan = new Jisuan();
            // $yilou=new Ylou();
            // $yilou1=$yilou->Ylou();
            // var_dump($yilou1);
            // die();
            $timesshuangse = $Jisuan->times();
            $redchuxian = array();
            $bluechuxian = array();
            $chuxiansumred = 0;
            $chuxiansumblue = 0;
            $pingcired = 0;
            $pingciblue = 0;
            foreach ($timesshuangse['red'] as $key => $value) {
                $pingcired += $value;
                $chuxiansumred += $value / $count;
                $redchuxian[$key] = round($value / $count, 4) * 100;
                $redchuxian[$key] .= '%';

        }
        foreach ($timesshuangse['blue'] as $key => $value) {
            $pingciblue += $value;
            $chuxiansumblue += $value / $count;
            $bluechuxian[$key] = round($value / $count, 4) * 100;
            $bluechuxian[$key] .= '%';
        }
        $pingcired = round($pingcired / 33, 2);

        $pingciblue = round($pingciblue / 16, 2);

        $chuxiansumred = round($chuxiansumred / 33, 4) * 100;
        $chuxiansumred .= '%';
        $chuxiansumblue = round($chuxiansumblue / 16, 4) * 100;
        $chuxiansumblue .= '%';
            $this->assign('pingcired', $pingcired);
            $this->assign('pingciblue', $pingciblue);
            $this->assign('pingchured', $chuxiansumred);
            $this->assign('pingchublue', $chuxiansumblue);
            $this->assign('chuxianred', $redchuxian);
            $this->assign('chuxianblue', $bluechuxian);


            $this->assign('timesshuangse', $Jisuan->times());
            /*  $this->assign('jiang',$shuangse1);*/
            /* var_dump($shuangse1);die();*/


            $this->display('Shuangse/Shuangse');
        } else {
            $this->redirect('Lonin/Login', 3, '请先登录，页面将在三秒后自动跳转到登录页面');
        }
    }

}