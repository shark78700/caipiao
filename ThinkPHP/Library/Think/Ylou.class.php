<?php
/**
 * Created by PhpStorm.
 * User: 夏骏
 * Date: 2016/11/2
 * Time: 17:26
 */

namespace Think;


use Think\Cache\Driver\Redis;

class Ylou
{
    
    public  function Ylou(){
        $redis=new Redis();
        $shuangse=M('shuangse');
        $shuangse1=$shuangse->field('number,times')->select();

        if($redis->get($shuangse1[count($shuangse1)-1]['times'].'ylou')!=null){
            echo 1;


        }
        else{
            if($redis->get($shuangse1[count($shuangse1)-2]['times'].'ylou')!=null){
                echo 2;

            }else{
                echo 3;

                for($i=1;$i<=33;$i++){
                    if($i<=16){
                        $blue[$i]=0;
                    }
                    $red[$i]=0;
                }

                $rednow=explode(',',$shuangse1[count($shuangse1)-1]['number']);

                for($i=1;$i<=33;$i++){
                    for($j=0;$j<count($rednow);$j++){
                        if($j!=count($rednow)-1){
                            if($i==$rednow[$j]){
                                $red[$i]-=1;
                            }
                        }else{
                            if($i<=16){
                                if($i==$red[$j]){
                                    $blue[$i]-=1;
                                }
                            }
                        }
                    }
                    if($i<=16){
                        $blue[$i]++;
                        $red[$i]++;
                    }else{
                        $red[$i]++;
                    }
                    if($red[$i]==0){
                        $yilou['red'][$i]=0;
                        unset($red[$i]);
                    }
                    if($blue[$i]==0){
                        $yilou['blue'][$i]=0;
                        unset($blue[$i]);
                    }
                }
                
                for($i=count($shuangse1)-2;$i>=0;$i--){
                    $zhongarr=explode(',',$shuangse1[$i]['number']);
                    for($j=1;$j<=33;$j++){
                        if($i<=16){
                            if(!is_int($blue[$j])){

                            }else {
                                if (isset($blue[$j]) && $blue[$j] != null) {
                                    if ($i == $zhongarr[count($zhongarr) - 1]) {
                                        $yilou['blue'][$i] = $blue[$j];
                                        $blue[$j] = 'x';
                                    }
                                }
                            }
                        }
                        if(isset($red[$j])&&$red[$j]!=null) {
                            if(!is_int($red[$j])){
                                break;
                            }
                            for ($z = 0; $z < count($zhongarr) - 2; $z++) {
                                if ($zhongarr[$z] == $i){
                                    $yilou['red'][$j]=$red[$j];
                                    $red[$j]='x';
                                }
                            }

                        }
                        if($red[$j]==0){
                            unset($red[$j]);
                        }
                        if($blue[$j]==0){
                            unset($blue[$j]);
                        }
                    }
                    if($red!=null) {
                        foreach ($red as $key => $value) {
                            $red[$key]++;
                        }
                        foreach ($blue as $key => $value) {
                            $blue[$key]++;
                        }
                    }else{
                        break;
                    }
                }
                return $yilou;
                
            }
        }
    }

}