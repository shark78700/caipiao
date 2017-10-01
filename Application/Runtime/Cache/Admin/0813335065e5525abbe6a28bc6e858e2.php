<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="/Public/bootstrap-3.3.5-dist/js/jquery-3.1.0.js"></script>
    <script src="/Public/bootstrap-3.3.5-dist/js/bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("input[name='code']").hide();
            $("p[name='respo']").hide();
            $("p[name='baocun']").hide();
            $("button[name='back']").click(function () {
                history.go(-1);
            })
            $("button[name='sub']").click(function () {
                $("p[name='respo']").html('');
                var address = $("input[name='address']").val();
                if (address == null) {
                    $("p[name='respo']").show();
                    $("p[name='respo']").css('color', 'red');
                    $("p[name='respo']").html('网址不能为空');
                    return false;
                }
                $.ajax({
                    url: "/Admin/<?php echo ($url); ?>",
                    type: "POST",
                    data: {
                        address: address,
                    },
                    //dataType: "json",
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
                    success: function (data, status) {//如果调用php成功

                        if (data == 1) {
                            $("p[name='respo']").show();
                            $("p[name='respo']").css('color', 'green');
                            $("p[name='respo']").html(address + '获取数据成功');


                        }
                        if (data == 2) {
                            $("p[name='respo']").show();
                            $("p[name='respo']").css('color', 'red');
                            $("p[name='respo']").html(address + '获取数据失败');


                        }
                        if (data == 3) {
                            $("p[name='respo']").show();
                            $("p[name='respo']").css('color', 'red');
                            $("p[name='respo']").html('网址不能为空');

                        }
                        if (data == 4) {
                            $("p[name='respo']").show();
                            $("p[name='respo']").css('color', 'red');
                            $("p[name='respo']").html(address + '网址出错请确认页面可以访问');

                        }
                        if (data == 5) {
                            $("p[name='respo']").show();
                            $("p[name='respo']").css('color', 'red');
                            $("p[name='respo']").html(address + '储存出现概率时出错');
                        }
//                        else {
//                            console.log(data)
//                        }
                    }
                })
                return false;
            })
            $("button[name='yuce']").click(function () {
                var times = "<?php echo ($times); ?>";
                var myt="<?php echo ($title); ?>";
                if(myt=='大乐透获取数据')
                {
                    $.ajax({
                        url: "/Admin/Curlyu/Getcodeb",
                        type: "POST",
                        data: {
                            times: times,
                        },
                        //dataType: "json",
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert(XMLHttpRequest.status);
                            alert(XMLHttpRequest.readyState);
                            alert(textStatus);
                        },
                        success: function (data, status) {//如果调用php成功
                            if (data.length != 0) {
                                $("input[name='code']").show()
                                $("input[name='code']").val(data)
                            } else {
                                alert('error')
                            }

                        }
                    })
                }else{
                    $.ajax({
                        url: "/Admin/Curlyu/Getcode",
                        type: "POST",
                        data: {
                            times: times,
                        },
                        //dataType: "json",
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert(XMLHttpRequest.status);
                            alert(XMLHttpRequest.readyState);
                            alert(textStatus);
                        },
                        success: function (data, status) {//如果调用php成功
                            if (data.length != 0) {
                                $("input[name='code']").show()
                                $("input[name='code']").val(data)
                            } else {
                                alert('error')
                            }

                        }
                    })
                }
            });

            $("button[name='sqlin']").click(function () {
                var myt = "<?php echo ($title); ?>";
                var code = $("input[name='code']").val();
                if (code == null) {
                    alert('预测不能为空');
                }
                if (myt == '大乐透获取数据') {
                    $.ajax({
                        url: "/Admin/Curlyu/Indatab/times/<?php echo ($times); ?>",
                        type: "POST",
                        data: {

                            code: code,
                        },
                        //dataType: "json",
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert(XMLHttpRequest.status);
                            alert(XMLHttpRequest.readyState);
                            alert(textStatus);
                        },
                        success: function (data1, status) {//如果调用php成功
                            if (data1 == 1) {
                                $("p[name='baocun']").show();
                                var nowtime=times+1
                                $("p[name='baocun']").html('第' + nowtime + "期预测数据保存成功。请勿重复保存");
                            }
                            if (data1 == 3) {
                                $("p[name='baocun']").show();
                                $("p[name='baocun']").html("预测数据已经存在");
                            }
                            if (data1 == 2) {
                                $("p[name='baocun']").show();
                                $("p[name='baocun']").html("保存错误");
                            }
                        }

                    })
                } else {
                    $.ajax({
                        url: "/Admin/Curlyu/Indata/times/<?php echo ($times); ?>",
                        type: "POST",
                        data: {

                            code: code,
                        },
                        //dataType: "json",
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert(XMLHttpRequest.status);
                            alert(XMLHttpRequest.readyState);
                            alert(textStatus);
                        },
                        success: function (data1, status) {//如果调用php成功
                            if (data1 == 1) {
                                $("p[name='baocun']").show();
                                var nowtime=times+1
                                $("p[name='baocun']").html('第' + nowtime + "期预测数据保存成功。请勿重复保存");
                            }
                            if (data1 == 3) {
                                $("p[name='baocun']").show();
                                $("p[name='baocun']").html("预测数据已经存在");
                            }
                            if (data1 == 2) {
                                $("p[name='baocun']").show();
                                $("p[name='baocun']").html("保存错误");
                            }
                        }
                    })
                }
            })

            $("button[name='bidui']").click(function () {
                window.location.href="/Admin/Bidui/Biduishuang"
            })
        })
    </script>
</head>
<body>
    <div class="row" style="margin-top: 3%">
        <div class="col-xs-2 col-xs-offset-5">
            <h1><?php echo ($title); ?></h1>
            <p name="respo" ><p>
        </div>
        <div class="col-xs-6 col-xs-offset-3">
            <form>
                <div class="form-group">
                    <label for="address">数据网址:</label>
                    <input type="input" class="form-control" id="address" name="address">
                </div>
                <button  class="btn btn-default" name="sub">确定</button>
                <button  class="btn btn-default" name="back" style="margin-left: 88%">返回</button>
            </form>
        </div>
        <div class="col-xs-6 col-xs-offset-3" style="padding-top: 1%">
            <button class="btn btn-default" name="yuce">预测号码</button>
        </div>

        <div class="col-xs-6 col-xs-offset-3" style="padding-top:1%;">
            <input type="text" class="form-control" id="code" name="code" >
        </div>

        <div class="col-xs-6 col-xs-offset-3" style="padding-top: 1%">
            <button class="btn btn-default" name="sqlin">保存预测结果</button>
            <p name="baocun"></p>
        </div>

        <div class="col-xs-6 col-xs-offset-3" style="padding-top: 1%">
            <button class="btn btn-default" name="bidui">号码结果预测比对</button>
        </div>



    </div>


</body>
</html>