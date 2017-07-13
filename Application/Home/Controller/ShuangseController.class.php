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
    public function Shuangse(){

        $userredis=new User(session_id());
        $userinfo=$userredis->checkmyredis();
        if($userinfo) {
            for($i=1;$i<=33;$i++){
                $reball[]=$i;
            }
            for($i=1;$i<=16;$i++){
                $buleball[]=$i;
            }
            $this->assign('buleball',$buleball);
            $this->assign('reball',$reball);
            $shuangse=M('shuangse');
            $count=$shuangse->count();
            $page=new Page($count,20);
            $show=$page->show();
            $list = $shuangse->field('times,red1,red2,red3,red4,red5,red6,blue')->limit($page->firstRow.','.$page->listRows)->order('times desc')->select();
            for($i=0;$i<count($list);$i++){
                $zhong=array($list[$i]['red1'],$list[$i]['red2'],$list[$i]['red3'],$list[$i]['red4'],$list[$i]['red5'],$list[$i]['red6']);

                for($j=1;$j<=33;$j++) {
                    if (in_array($j, $zhong)) {
                        $list[$i]['allred'][] = ','.$j ;
                    } else {
                        $list[$i]['allred'][] = $j;
                    }
                }


                for($j=1;$j<=16;$j++){
                    if($list[$i]['blue']==$j){
                        $list[$i]['allblue'][] =','.$j;
                    }else {
                        $list[$i]['allblue'][] = $j;
                    }
                }

            }
            $this->assign('jiang',$list);
            $this->assign('show',$show);
            $Jisuan=new Jisuan();
           // $yilou=new Ylou();
           // $yilou1=$yilou->Ylou();
           // var_dump($yilou1);
           // die();
           

            $this->assign('timesshuangse',$Jisuan->times());
          /*  $this->assign('jiang',$shuangse1);*/
           /* var_dump($shuangse1);die();*/
            
            
            $this->display('Shuangse/Shuangse');
        }else{
            $this->redirect('Lonin/Login',3,'请先登录，页面将在三秒后自动跳转到登录页面');
        }
    }

}