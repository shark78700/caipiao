<?php
/**
 * Created by PhpStorm.
 * User: alex_2
 * Date: 2017/6/20
 * Time: 14:37
 */

namespace Think;


use Think\Cache\Driver\Redis;

class User
{
    private $usersession;
    private $userinfo;
    private $flage;
    function __construct($usersession,$userinfo=null)
    {
        if($usersession!=null) {
            $this->usersession = $usersession;
            $this->flage=1;
            if($userinfo!=null){
                $this->userinfo=$userinfo;
            }
        }else{
            return false;
        }
    }

    private function redisid(){
        $redis=new Redis();
        if($redis->get($this->usersession)){
            $this->userinfo=$redis->get($this->usersession);
        }else{
            $this->flage=0;
        }

    }
    
    private function saveredis($time){
        $redis=new Redis();
        if(!$redis->set($this->usersession,$this->userinfo,$time)){
            $this->flage=0;
        }
    }
    
    public function checkmyredis(){
        $this->redisid();
        if($this->flage==0){
            return false;
        }
        return $this->userinfo;
    }
    public function savemyredis($time){
        if($time==null||$this->flage==0) {
            return false;
        }
        $this->saveredis($time);
        if($this->flage==1){
            return 1;
        }else{
            return false;
        }
    }
}