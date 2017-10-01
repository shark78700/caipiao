<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="/Public/bootstrap-3.3.5-dist/js/jquery-3.1.0.js"></script>
    <script src="/Public/bootstrap-3.3.5-dist/js/bootstrap.js" type="text/javascript"></script>
    <link href="/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/Public/bootstrap-3.3.5-dist/css/Login.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
        $(document).ready(function(){
            $("input[name='username']").focusin(function(){

                $(this).next().text('');
            })
            $("input[name='username']").focusout(function(){
                if($(this).val()==false){
                    $(this).next().css('color','red');
                    $(this).next().text('用户名不能为空!');
                }else {
                    var my_data=$(this).val();

                    $.ajax({
                        url: "/Home/Login/Username",
                        type: "POST",
                        data:{
                            username:my_data
                        },
                        //dataType: "json",
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert(XMLHttpRequest.status);
                            alert(XMLHttpRequest.readyState);
                            alert(textStatus);
                        },
                        success: function(data,status) {//如果调用php成功

                            if (data == '1') {

                                $("input[name='username']").next().css('color','green')
                               /* $("input[name='username']").after('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span><span id="userStatus" class="sr-only">(success)</span>')*/
                                $("input[name='username']").next().text('用户名正确')
                            } else {
                                $("input[name='username']").next().css('color','red')
                                $("input[name='username']").next().text('用户名不存在')

                            }
                        }

                    })
                }
                $("input[name='pwd']").focusin(function(){


                    $(this).next().text('');
                })
            });
            $("input[name='pwd']").focusout(function(){
                if($(this).val()==false) {
                   /* $("input[name='pwd']").after('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span><span id="pwdStatus" class="sr-only">(error)</span>')*/

                    $(this).next().text('密码不能为空!');
                }
                else{
                    $(this).next().text('');
                }
        });

            $("button[name='sub']").click(function () {

                var username=$("input[name='username']").val();
                var userpwd=$("input[name='pwd']").val();

                $.ajax( {
                    url: "/Home/Login/Login",//互交的地址（控制器）
                    type: "POST",//专递的方法
                    data:{
                        user_name:username,
                        user_pwd:userpwd,

                    },//互交的数据（post 上传的数据 数据名为user_name 内容是my_data）
                    //dataType: "json",//选择专递文件类型
                    error: function(XMLHttpRequest, textStatus, errorThrown) {//抛出错误信息
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
                    success: function(data1,status) {//如果调用php成功
                        if (data1 == 1) {
                            window.location.href ='/Home/Homepage/Homepage'
                        }
                        if(data1==3){
                            alert('用户名或密码出错');
                        }
                        if(data1 == 2){
                            alert('用户名或密码不能为空');
                        }
                    }

                });

            })

        })
    </script>
</head>
<body>
    <div class="content">
        <div class="'content">
            <h1 >你好，欢迎登录彩票系统</h1>
        </div>
        <div id="content" class="content" >
            <form method="post" action="/Home/Login/Login">
                <div class="form-group ">
                <label for="user" class="control-label">用户名：</label>
                <input type="text" class="form-control" id="user" name="username" placeholder="用户名"><p></p>
            </div>
                <div class="form-group">
                    <label for="pwd" class="control-label">密码：</label>
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="密码" ><p></p>
                </div>
                <button type="button" class="btn btn-default" name="sub">登录</button>
            </form>

            </div>

        </div>
    </div>
</body>
</html>