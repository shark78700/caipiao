<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="/caipiao/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="/caipiao/Public/bootstrap-3.3.5-dist/js/jquery-3.1.0.js"></script>
    <script src="/caipiao/Public/bootstrap-3.3.5-dist/js/bootstrap.js" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
        $(document).ready(function () {
            $("div[name='shuangse']").hide();
            $("div[name='leto']").hide();
            $('#caizhong').change(function () {
                if($(this).find('option:selected').text()=='双色球'){
                    $("div[name='shuangse']").show();
                    $("div[name='leto']").hide();
                }
                if($(this).find('option:selected').text()=='大乐透'){
                    $("div[name='leto']").show();
                    $("div[name='shuangse']").hide();
                }
                if($(this).find('option:selected').text()==false){
                    $("div[name='shuangse']").hide();
                    $("div[name='leto']").hide();
                }

            })
            $("input[name='sub1']").click(function () {
                var times=$("input[name='times']").val();
                var red1=$("select[name='red1']").find('option:selected').text();
                var red2=$("select[name='red2']").find('option:selected').text();
                var red3=$("select[name='red3']").find('option:selected').text();
                var red4=$("select[name='red4']").find('option:selected').text();
                var red5=$("select[name='red5']").find('option:selected').text();
                var red6=$("select[name='red6']").find('option:selected').text();
                var blue=$("select[name='blue']").find('option:selected').text();
                var reg= /^[0-9]*$/;
                if(times==false||reg.test(times)==false){

                }else {
                    if (red1 == false && red2 == false && red3 == false && red4 == false && red5 == false && red6 == false && blue == false) {

                    } else {

                        $.ajax({
                            url: "/caipiao/Admin/Updata/Updata",//互交的地址（控制器）
                            type: "POST",//专递的方法
                            data: {
                                red1: red1,
                                red2: red2,
                                red3: red3,
                                red4: red4,
                                red5: red5,
                                red6: red6,
                                blue: blue,
                            },//互交的数据（post 上传的数据 数据名为user_name 内容是my_data）
                            //dataType: "json",//选择专递文件类型
                            error: function (XMLHttpRequest, textStatus, errorThrown) {//抛出错误信息
                                alert(XMLHttpRequest.status);
                                alert(XMLHttpRequest.readyState);
                                alert(textStatus);
                            },
                            success: function (data, status) {//如果调用php成功
                                if(data==1){

                                }

                            }

                        })
                    }
                }
            })



        })

    </script>
</head>
<body>
    <div class="row">
        <div class="row">
            <div class="col-xs-12"><h1 style="text-align: center"><em><strong>系统数据跟新</strong></em></h1></div>
        </div>
        <form role="form">
            <div class="row">
                <div class="col-xs-2 col-md-offset-5">
                    <label for="caizhong">彩票种类：</label>
                    <select class="form-control" id="caizhong" name="caizhong">
                        <option></option>
                        <option>双色球</option>
                        <option>大乐透</option>
                    </select>
                </div>

            </div>

                <div class="row">
                    <div class="col-xs-2 col-md-offset-5" >

                        <label >期数：</label>
                        <input type="text" class="form-control" name="times">

                    </div>
            </div>
            <div class="row" style="margin-top: 2%" name="shuangse">
            <div class="col-xs-1 col-md-offset-1">
                <label for="redball">红球：</label>
                <select class="form-control" id="redball" name="red1">
                    <option></option>
                    <?php if(is_array($shuang)): $i = 0; $__LIST__ = $shuang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sh): $mod = ($i % 2 );++$i;?><option><?php echo ($sh); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
            </div>
            <div class="col-xs-1 ">
                <label >红球：</label>
                <select class="form-control" name="red2">

                    <option></option>
                    <?php if(is_array($shuang)): $i = 0; $__LIST__ = $shuang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sh): $mod = ($i % 2 );++$i;?><option><?php echo ($sh); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
            </div>
            <div class="col-xs-1">
                <label >红球：</label>
                <select class="form-control" name="red3">
                    <option></option>
                    <?php if(is_array($shuang)): $i = 0; $__LIST__ = $shuang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sh): $mod = ($i % 2 );++$i;?><option><?php echo ($sh); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
            </div>
            <div class="col-xs-1 ">
                <label >红球：</label>
                <select class="form-control" name="red4">
                    <option></option>
                    <?php if(is_array($shuang)): $i = 0; $__LIST__ = $shuang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sh): $mod = ($i % 2 );++$i;?><option><?php echo ($sh); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
            </div>
            <div class="col-xs-1 ">
                <label >红球：</label>
                <select class="form-control" name="red5">
                    <option></option>
                    <?php if(is_array($shuang)): $i = 0; $__LIST__ = $shuang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sh): $mod = ($i % 2 );++$i;?><option><?php echo ($sh); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
            </div>
            <div class="col-xs-1 ">
                <label >红球：</label>
                <select class="form-control" name="red6">
                    <option></option>
                    <?php if(is_array($shuang)): $i = 0; $__LIST__ = $shuang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sh): $mod = ($i % 2 );++$i;?><option><?php echo ($sh); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
            </div>
            <div class="col-xs-1  col-md-offset-2" >
                <label >蓝球：</label>
                <select class="form-control"  name="blue">
                    <option></option>
                    <?php if(is_array($shuanglan)): $i = 0; $__LIST__ = $shuanglan;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shb): $mod = ($i % 2 );++$i;?><option><?php echo ($shb); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
            </div>

        </div>

            <div class="row" style="margin-top: 2%" name="leto">
                <div class="col-xs-1 col-md-offset-1">
                    <label for="blueball">红球：</label>
                    <select class="form-control" id="blueball" name="lred1">
                        <option></option>
                        <?php if(is_array($dale)): $i = 0; $__LIST__ = $dale;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dl): $mod = ($i % 2 );++$i;?><option><?php echo ($dl); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </div>
                <div class="col-xs-1 ">
                    <label >红球：</label>
                    <select class="form-control" name="lred2">

                        <option></option>
                        <?php if(is_array($dale)): $i = 0; $__LIST__ = $dale;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dl): $mod = ($i % 2 );++$i;?><option><?php echo ($dl); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </div>
                <div class="col-xs-1">
                    <label >红球：</label>
                    <select class="form-control" name="lred3">
                        <option></option>
                        <?php if(is_array($dale)): $i = 0; $__LIST__ = $dale;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dl): $mod = ($i % 2 );++$i;?><option><?php echo ($dl); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </div>
                <div class="col-xs-1 ">
                    <label >红球：</label>
                    <select class="form-control" name="lred4">
                        <option></option>
                        <?php if(is_array($dale)): $i = 0; $__LIST__ = $dale;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dl): $mod = ($i % 2 );++$i;?><option><?php echo ($dl); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </div>
                <div class="col-xs-1 ">
                    <label >红球：</label>
                    <select class="form-control" name="lred5">
                        <option></option>
                        <?php if(is_array($dale)): $i = 0; $__LIST__ = $dale;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dl): $mod = ($i % 2 );++$i;?><option><?php echo ($dl); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </div>
                <div class="col-xs-1  col-md-offset-1" name="lblue1">
                    <label >蓝球：</label>
                    <select class="form-control" >
                        <option></option>
                        <?php if(is_array($dale)): $i = 0; $__LIST__ = $dale;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dl): $mod = ($i % 2 );++$i;?><option><?php echo ($dl); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </div>

                <div class="col-xs-1  " >
                    <label >蓝球：</label>
                    <select class="form-control" name="lblue2">
                        <option></option>
                        <?php if(is_array($dalelan)): $i = 0; $__LIST__ = $dalelan;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dlb): $mod = ($i % 2 );++$i;?><option><?php echo ($dlb); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </div>

            </div>
            <div class="row" style="margin-top: 5%">
                <div class="col-xs-1 col-md-offset-4 ">
                    <input type="button" class="form-control" value="插入" name="sub1">
                </div>
                <div class="col-xs-1 col-md-offset-1">
                    <input type="button" class="form-control" value="跟新" name="sub2">
                </div>
            </div>

        </form>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h1 style="text-align: center"><em><strong></strong></em></h1>
        </div>
    </div>
</body>
</html>