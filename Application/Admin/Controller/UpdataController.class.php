<?php
/**
 * Created by PhpStorm.
 * User: 夏骏
 * Date: 2016/9/13
 * Time: 16:26
 */

namespace Admin\Controller;


use Think\Controller;

class UpdataController extends Controller
{
    public function Updata()
    {
        $name = session('name');
        if (isset($name)) {
            for ($i = 1; $i <= 33; $i++) {
                $shuang[] = $i;
            }
            for ($i = 1; $i <= 16; $i++) {
                $shuanglan[] = $i;
            }
            for ($i = 1; $i <= 35; $i++) {
                $dale[] = $i;
            }
            for ($i = 1; $i <= 12; $i++) {
                $dalelan[] = $i;
            }
            $this->assign('shuanglan', $shuanglan);
            $this->assign('dalelan', $dalelan);
            $this->assign('shuang', $shuang);
            $this->assign('dale', $dale);
            $this->display('Updata/Updata');

        }else{
            $this->redirect('Lonin/Login',3,'请先登录，页面将在三秒后自动跳转到登录页面');
        }
    }
    
    public function Upchashuang(){
        $name = session('name');
        if (isset($name)) {
            if(IS_POST){
                if (isset($_POST['times'])) {
                    if (isset($_POST['red1']) && isset($_POST['red2']) && isset($_POST['red3']) && isset($_POST['red4']) && isset($_POST['red5']) && isset($_POST['red6']) && isset($_POST['blue'])) {
                        $shuangse=M('shuangse');

                        $map['times']=$_POST['times'];
                        if(count($shuangse->where($map)->select())>=1){
                            echo 7;//已经存在数据应该被更新
                        }
                        for($i=1;$i<=7;$i++){
                            if($i!=7){
                                $map['red'.$i]=$_POST['red'.$i];
                                $map['number'].=$_POST['red'.$i];
                            }
                            else{
                                $map['blue']=$_POST['blue'];
                            }
                        }
                        if($shuangse->add($map)){
                            echo 1;//成功
                        }else{
                            echo 2;//插入失败
                        }
                        
                        
                    } else {
                        echo 3;//缺少红球或者蓝球

                    }
                } else {
                    echo 4;//没有设置期数
                    

                }
                
            }
            else{
                echo 8;//不是post传值
            }
            
        }else{
            echo 9;//需要登陆
            
        }
        
        
    }
    
}