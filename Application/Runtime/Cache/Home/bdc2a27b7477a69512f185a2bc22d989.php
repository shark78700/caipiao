<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="/caipiao/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="/caipiao/Public/bootstrap-3.3.5-dist/js/jquery-3.1.0.js"></script>
    <script src="/caipiao/Public/bootstrap-3.3.5-dist/js/bootstrap.js" type="text/javascript"></script>
    <!--<script type="text/javascript">
        $(document).ready(function () {
            var haome
            if {{}}
        })
    </script>-->


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        div{
           /* border: 1px solid #000000;*/
        }
        .today{
            text-align: center;
            color: #cba397;
            font-size: 38px;

        }
        .yesterday{
            margin-left: 20px;

        }
        .number{
            text-align: center;
            color: #e60214;
        }
        h2{

            color: blue;
            width: auto;
            text-align: center;
        }
        a{
            display: block;
            width: 100%;
            height: 100%;
            line-height: 100%;
        }
        a:hover{
            background-color: #ff8be6;
        }

    </style>

</head>
<body>
<div class="row">

    <div class="row">

        <div class="col-lg-12"><h2 class="today"><em><strong>今日开奖:<?php echo ($todaykai); ?></strong></em></h2></div>
    </div>
    <div class="row">
        <div class="col-lg-12"><h2 class="number"><em><strong>号码:<?php echo ($todaynumber); ?></strong></em></h2></div>
    </div>
    <div class="row">
        <div class="col-lg-12"><h2 class="number"><em><strong><?php echo ($today); ?></strong></em></h2></div>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="col-lg-12"><h2 class="yesterday"><em><strong>昨日开奖:<?php echo ($yesterkai); ?></strong></em></h2></div>
    </div>
    <div class="row">
        <div class="col-lg-12"><h2><em><strong>号码:<?php echo ($yesternumber); ?></strong></em></h2></div>
    </div>
    <div class="row">
        <div class="col-lg-12"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6"><h2><a href="/caipiao/Admin/Curl/Show/times/<?php echo ($stimes); ?>">双色球</a></h2>

    </div>
    <div class="col-lg-6"><h2><a href="/caipiao/Admin/Pale/Show/times/<?php echo ($ltimes); ?>">大乐透</a></h2>

    </div>
   <!-- <div class="col-lg-4"><h2><a>足彩</a></h2>

    </div>-->

</div>
</body>
</html>