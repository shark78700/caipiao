<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2017/7/13
 * Time: 11:21
 */

namespace Home\Controller;


use Think\Controller;

class TestController extends Controller
//php调用python事例
{
   public function Test(){
     //  $x=system('python /var/www/mypy/callback.py',$res);
       exec('python /var/www/mypy/php.py',$arr,$res);
       if(!$res) {
           var_dump($arr);
       }else{
           echo 'error';
       }

   }

}