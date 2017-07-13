<?php
/**
 * Created by PhpStorm.
 * User: 夏骏
 * Date: 2016/9/1
 * Time: 14:36
 */

namespace Home\Controller;


use Think\Cache\Driver\Redis;
use Think\Controller;
use Think\User;

class LoginController extends Controller
{
    public function Login(){
        $userredis=new User(session_id());
        $userinfo=$userredis->checkmyredis();
        if($userinfo){
            echo 1;
        }
        else{
            if(isset($_POST['user_name'])&&isset($_POST['user_pwd'])){
                $login=M('user');
                $map['u_name']=I('post.user_name');
                $map['u_pwd']=sha1(md5(I('post.user_pwd')));
                if(count($login->where($map)->select())==1){
                   $saveredis=new User(session_id(),$map['u_name']);
                   if($saveredis->savemyredis(C('REDISTIME'))) {
                       echo 1;
                   }else{
                       echo 4;
                   }
                }
                else{
                    echo 3;
                }
            }
            else{
                echo 2;
            }
            
        }
      
    }
    
    
/*  ******************************************************************************************************* */ 
    
    public function Username(){
        if(IS_POST){
            if(isset($_POST['username'])){
                $user=I('post.username');
                $map['u_name']=$user;
                $login=M('user');
                if(count($login->where($map)->select())==1){
                    echo '1';
                    
                }
                else{
                    echo '2';
                }
            }
        }
    }
    
    public function Pwd(){
        if(IS_POST){
            
            
        }
        
    }
}