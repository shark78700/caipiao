<?php
/**
 * Created by PhpStorm.
 * User: 夏骏
 * Date: 2016/9/9
 * Time: 17:44
 */

namespace Home\Controller;


use Think\Controller;
use Think\User;

class HomepageController extends Controller
{
    public function Homepage(){
        $userredis=new User(session_id());
        $userinfo=$userredis->checkmyredis();
        if($userinfo){

           if(date('w',time())==1||date('w',time())==3||date('w',time())==5||date('w',time())==6) {
               if (date('w', time() != 6)) {
                   $ymap['kai_time'] = strtotime(date('Y-m-d', strtotime('-1 day')));
               } else {
                   $ymap['kai_time'] = strtotime(date('Y-m-d', strtotime('-2 day')));
               }
               $shuangse = M('shuangse');
               $yesterkaijiang = '双色球';
               $this->assign('yesterkai', $yesterkaijiang);
               if (count($info = $shuangse->order('times desc')->limit(1)->select()) == 1) {
                   $times=$info[0]['times'];
                   $kainumber = explode(',',$info[0]['allcode']);
                   $sum=count($kainumber);
                   $mystr = '';
                   for($i=0;$i<$sum;$i++){
                       if($i==6){
                           $mystr.='<span style="color: blue">'.$kainumber[$i].'</span>';
                       }else{
                           $mystr.='<span style="color: red">'.$kainumber[$i].'</span>,';
                       }
                   }

                   $this->assign('yesternumber', $mystr);
               } else {

                   $this->assign('yesternumber', '数据待跟新');
               }
               $todaykaijiang = '大乐透';
               if (date('G') <= 22) {
                   $todaynumber = '未开';
               } else {
                   $tmap['kai_time'] = strtotime(date('Y-m-d', strtotime('today')));
                   $leto = M('letou');
                   if (count($tinfo = $leto->order('times desc')->limit(1)->select())==1){
                       $times=$tinfo[0]['times'];
                       $kainumber = explode(',',$tinfo[0]['allcode']);
                       $sum=count($kainumber);
                       $mystr = '';
                       for($i=0;$i<$sum;$i++){
                           if($i==6){
                               $mystr.='<span style="color: blue">'.$kainumber[$i].'</span>';
                           }elseif(i==5){
                               $mystr.='<span style="color: blue">'.$kainumber[$i].'</span>,';
                           }else{
                               $mystr.='<span style="color: red">'.$kainumber[$i].'</span>,';
                           }
                       }

                       $todaynumber=$mystr;
                   }else {
                       $todaynumber = '已开奖，数据待跟新';
                   }
               }
               $this->assign('times',$times);
               $this->assign('todaykai', $todaykaijiang);
               $this->assign('todaynumber', $todaynumber);


               $this->display('Homepage/Homepage');
           }else{
               $ymap['kai_time'] = strtotime(date('Y-m-d', strtotime('-1 day')));
               $leto=M('letou');
               $yesterkaijiang='大乐透';

               if(count($info=$leto->order('times desc')->limit(1)->select())==1){
                   $times=$info[0]['times'];
                   $mystr='';
                   foreach ($info as $key=>$value){
                       $kainumber=$info[$key]['allcode'];
                   }
                   $kainumber=explode(',',$kainumber);
                   for($i=0;$i<count($kainumber);$i++){
                       if($i==6){
                           $mystr.='<span style="color: blue">'.$kainumber[$i].'</span>';
                       }elseif($i==5){
                           $mystr.='<span style="color: blue">'.$kainumber[$i].'</span>,';
                       }else{
                           $mystr.='<span style="color: red">'.$kainumber[$i].'</span>,';
                       }
                   }

                   $this->assign('yesternumber',$mystr);
               }else{

                   $this->assign('yesternumber','数据待跟新');
               }
               $this->assign('yesterkai',$yesterkaijiang);

               $todaykaijiang='双色球';
               if(date('G')<=22){
                   $todaynumber='未开';
               }else{
                   $tmap['kai_time'] = strtotime(date('Y-m-d', strtotime('today')));

                   $shuangse=M('shuangse');
                   if(count($tinfo = $shuangse->order('times desc')->limit(1)->select())==1) {
                       $times=$tinfo[0]['times'];
                       $kainumber = explode(',',$info[0]['allcode']);
                       $sum=count($kainumber);
                       $mystr = '';
                       for($i=0;$i<$sum;$i++){
                           if($i==6){
                               $mystr.='<span style="color: blue">'.$kainumber[$i].'</span>';
                           }else{
                               $mystr.='<span style="color: red">'.$kainumber[$i].'</span>,';
                           }
                       }
                       $todaynumber=$mystr;

                   }else {
                       $todaynumber = '已开奖，数据待跟新';
                   }
           }
               $this->assign('times',$times);
               $this->assign('todaykai',$todaykaijiang);
               $this->assign('todaynumber',$todaynumber);
               $this->assign('today',date('Y-m-d'),strtotime('today'));


               $this->display('Homepage/Homepage');



           }

        }else{
            $this->redirect('Lonin/Login',3,'请先登录，页面将在三秒后自动跳转到登录页面');
        }
    }

}