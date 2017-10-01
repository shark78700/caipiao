<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2017/7/27
 * Time: 17:37
 */

namespace Admin\Controller;


use Think\Controller;
use Think\User;

class BiduiController extends Controller
{
    public function Biduishuang(){
        $userredis=new User(session_id());
        $userinfo=$userredis->checkmyredis();
        if($userinfo){
            
        $this->display('Bidui/Bidui');
        }else{

        }
    }
}