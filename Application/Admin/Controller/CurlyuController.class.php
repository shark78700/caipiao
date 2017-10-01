<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2017/7/21
 * Time: 17:32
 */

namespace Admin\Controller;


use Think\Controller;

class CurlyuController extends Controller
{
    public function Getcode()
    {
        if (IS_POST || $_POST['times'] != null) {
            system("python /var/www/mypy/Data.py", $res);
        }
    }
    public function Getcodeb()
    {
        if (IS_POST || $_POST['times'] != null) {
            system("python /var/www/mypy/Datab.py", $res);
        }
    }

    public function Indata()
    {
        if (IS_POST && $_POST['code'] != null && $_GET['times'] != null) {
            $data['code'] = $_POST['code'];
            $data['times'] = $_GET['times'] + 1;
            $shuangseyuce = M('shuangseyuce');
            $shuangseyuce1 = $shuangseyuce->field('times')->order('times desc')->limit(1)->select();
            if ($shuangseyuce1[0]['times'] != $data['times']) {
                if ($shuangseyuce->add($data)) {
                    echo 1;
                    exit();
                } else {
                    echo 2;
                    exit();
                }
            } else {
                echo 3;
                exit();
            }
        }
    }
    public function Indatab()
    {
        if (IS_POST && $_POST['code'] != null && $_GET['times'] != null) {
            $data['code'] = $_POST['code'];
            $data['times'] = $_GET['times'] + 1;
            $shuangseyuce = M('letoouyuce');
            $shuangseyuce1 = $shuangseyuce->field('times')->order('times desc')->limit(1)->select();
            if ($shuangseyuce1[0]['times'] != $data['times']) {
                if ($shuangseyuce->add($data)) {
                    echo 1;
                    exit();
                } else {
                    echo 2;
                    exit();
                }
            } else {
                echo 3;
                exit();
            }
        }
    }
}