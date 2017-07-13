<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="/caipiao/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="/caipiao/Public/bootstrap-3.3.5-dist/js/jquery-3.1.0.js"></script>
    <script src="/caipiao/Public/bootstrap-3.3.5-dist/js/bootstrap.js" type="text/javascript"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">

        h1{
            text-align: center;
            color: #ff0018;
        }
        td{
            text-align: center;
            font-size: 5px;
        }
        /*.page span{
            display: block;
            width: auto;
        }
        .page a{
            display: block!important;
            width: auto;
        }*/
        .page div{

            width: 80%;
            margin: auto;
            font-size: 24px;

        }

    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            var tdl=$('td').length;
            for(var i=0;i<tdl;i++){

                if($('td').eq(i).html().substr(0,1)==','){
                    var mystr=$('td').eq(i).html().substr(1);
                    $('td').eq(i).html(mystr);
                    $('td').eq(i).css('background-color','#DDA0DD');
                }
            }


        })

    </script>

</head>
<body>
    <div class="row">
        <div class="col-lg-12"><h1>双色球</h1></div>
    </div>
    <div class="row">

        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="margin-left: 1%">
                <tr class="info">
                    <td></td>
                    <td colspan="33">红球</td>
                    <td colspan="16">蓝球</td>
                    <td colspan="7">开奖</td>
                </tr>
                <tr class="success">

                    <td>期数</td>
                    <?php if(is_array($reball)): $i = 0; $__LIST__ = $reball;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reb): $mod = ($i % 2 );++$i;?><td><img src="/caipiao/Public/image/redball.png" width="15px" height="15px"></td><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php if(is_array($buleball)): $i = 0; $__LIST__ = $buleball;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bub): $mod = ($i % 2 );++$i;?><td><img src="/caipiao/Public/image/blueball.png" width="15px" height="15px"></td><?php endforeach; endif; else: echo "" ;endif; ?>
                    <td><img src="/caipiao/Public/image/redball.png" width="15px" height="15px"></td>
                    <td><img src="/caipiao/Public/image/redball.png" width="15px" height="15px"></td>
                    <td><img src="/caipiao/Public/image/redball.png" width="15px" height="15px"></td>
                    <td><img src="/caipiao/Public/image/redball.png" width="15px" height="15px"></td>
                    <td><img src="/caipiao/Public/image/redball.png" width="15px" height="15px"></td>
                    <td><img src="/caipiao/Public/image/redball.png" width="15px" height="15px"></td>
                    <td><img src="/caipiao/Public/image/blueball.png" width="15px" height="15px"></td>
                   <!-- <td>开奖时间</td>-->
                </tr>
                <?php if(is_array($jiang)): $i = 0; $__LIST__ = $jiang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jiang): $mod = ($i % 2 );++$i;?><tr class="danger">

                        <td><?php echo ($jiang["times"]); ?></td>

                        <?php if(is_array($jiang["allred"])): $i = 0; $__LIST__ = $jiang["allred"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reb): $mod = ($i % 2 );++$i;?><td name="red"><?php echo ($reb); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php if(is_array($jiang["allblue"])): $i = 0; $__LIST__ = $jiang["allblue"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bub): $mod = ($i % 2 );++$i;?><td style="background-color: #b9def0 "><?php echo ($bub); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        <td><?php echo ($jiang["red1"]); ?></td>
                        <td><?php echo ($jiang["red2"]); ?></td>
                        <td><?php echo ($jiang["red3"]); ?></td>
                        <td><?php echo ($jiang["red4"]); ?></td>
                        <td><?php echo ($jiang["red5"]); ?></td>
                        <td><?php echo ($jiang["red6"]); ?></td>
                        <td style="background-color: #b9def0 "><?php echo ($jiang["blue"]); ?></td>
                      <!--  <td>{{}}</td>-->
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td>当前遗漏：</td>

                </tr>
                <tr>
                    <td>出现总次数：</td>
                    <?php if(is_array($timesshuangse["red"])): $i = 0; $__LIST__ = $timesshuangse["red"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tsr): $mod = ($i % 2 );++$i;?><td><?php echo ($tsr); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php if(is_array($timesshuangse["blue"])): $i = 0; $__LIST__ = $timesshuangse["blue"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tsb): $mod = ($i % 2 );++$i;?><td><?php echo ($tsb); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                </tr>
                <tr>
                    <td></td>

                </tr>
            </table>

        </div>
        <div class="row">
            <div class="col-lg-8 col-md-offset-4 page" >

               <?php echo ($show); ?>
            </div>
        </div>

    </div>
    <div class="row">

    </div>


</body>
</html>