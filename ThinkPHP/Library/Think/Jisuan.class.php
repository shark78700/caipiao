<?php
/**
 * Created by PhpStorm.
 * User: 夏骏
 * Date: 2016/11/2
 * Time: 14:56
 */

namespace Think;


use Think\Cache\Driver\Redis;

class Jisuan
{


    public function times(){
        $redis=new Redis();
       
        $shuangse=M('shuangse'); 
        $shuangse1=$shuangse->field('allcode,times')->select();
        
        if($redis->get($shuangse1[count($shuangse1)-1]['times'].'shuangse')!=null){
         return $redis->get($shuangse1[count($shuangse1)-1]['times'].'shuangse');
        }else{

            
            for($i=1;$i<=33;$i++){
                if($i<=16){
                    $blue[$i]=0;
                }
                $red[$i]=0;
            }



            for($i=0;$i<count($shuangse1);$i++){
                $shuangse1[$i]['allcode']=explode(',',$shuangse1[$i]['allcode']);
                for($j=0;$j<count($shuangse1[$i]['allcode']);$j++){
                    if($j!=6) {
                        for ($z = 1; $z <= 33; $z++) {
                           /* echo 1;*/
                            if ($z == $shuangse1[$i]['allcode'][$j]) {
                              /*  echo 2;*/
                                $red[$z] =$red[$z]+ 1;
                            }
                        }
                    }else{
                        for($z=1;$z<=16;$z++){
                            if($z==$shuangse1[$i]['allcode'][$j]){
                                $blue[$z]=$blue[$z]+1;
                            }
                        }
                    }
                }
                
                
            }

            $timesshuangse=json_encode(array('red'=>$red,'blue'=>$blue));
           /* var_dump($timesshuangse);
            var_dump($shuangse1[count($shuangse1)-1]['times'].'shuangse');*/

            $redis->set($shuangse1[count($shuangse1)-1]['times'].'shuangse',$timesshuangse);
            

            if($redis->get(($shuangse1[count($shuangse1)-1]['times']-1).'shuangse')!=null){
                $times=M('shuangsetimes');
                $map['times']=$shuangse1[count($shuangse1)-1]['times'];
                $map['alltimes']=$timesshuangse;
                if($times->add($map)){
                    $redis->rm(($shuangse1[count($shuangse1)-1]['times']-1).'shuangse');
                }
                else{
                    
                }
                
            }
           return $redis->get($shuangse1[count($shuangse1)-1]['times'].'shuangse');
            
        }

    }

}