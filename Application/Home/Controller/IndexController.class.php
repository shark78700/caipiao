<?php
namespace Home\Controller;
use Think\Controller;
use Think\User;

class IndexController extends Controller {
    public function Index(){
        $userredis=new User(session_id());
        $userinfo=$userredis->checkmyredis();
        if($userinfo){
            $this->redirect('Homepage/Homepage');
        }else {
            $this->display('Login/Login');
        }
    }
}