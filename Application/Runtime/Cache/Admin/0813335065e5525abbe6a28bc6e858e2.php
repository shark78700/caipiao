<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="/caipiao/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="/caipiao/Public/bootstrap-3.3.5-dist/js/jquery-3.1.0.js"></script>
    <script src="/caipiao/Public/bootstrap-3.3.5-dist/js/bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("p[name='respo']").hide();
            $("button[name='sub']").click(function () {
                $("p[name='respo']").html('');
                var address = $("input[name='address']").val();
                if(address==null){
                    $("p[name='respo']").show();
                    $("p[name='respo']").css('color', 'red');
                    $("p[name='respo']").html('网址不能为空');
                    return false;
                }
                $.ajax({
                    url: "/caipiao/Admin/<?php echo ($url); ?>",
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
                            $("p[name='respo']").html(address+'获取数据成功');


                        }
                        if (data == 2) {
                            $("p[name='respo']").show();
                            $("p[name='respo']").css('color', 'red');
                            $("p[name='respo']").html(address+'获取数据失败');


                        }
                        if (data == 3) {
                            $("p[name='respo']").show();
                            $("p[name='respo']").css('color', 'red');
                            $("p[name='respo']").html('网址不能为空');

                        }
                        if (data == 4) {
                            $("p[name='respo']").show();
                            $("p[name='respo']").css('color', 'red');
                            $("p[name='respo']").html(address+'网址出错请确认页面可以访问');

                        }
                        else{
                           console.log(data);
                        }
                    }
                })
                return false;
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
            </form>
        </div>
    </div>


</body>
</html>