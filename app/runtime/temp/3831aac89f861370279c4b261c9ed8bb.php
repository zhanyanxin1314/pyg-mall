<?php /*a:2:{s:84:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\ordercomplains\list.html";i:1563437436;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>品优购后台管理系统</title>
    <link rel="stylesheet" href="/static/libs/mmgrid/mmGrid.css">
    <link rel="stylesheet" href="/static/libs/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/admin.css">
    <link rel="stylesheet" href="/static/admin/css/common.css">
    <link rel="stylesheet" href="/static/admin/css/base.css">
    <link rel="stylesheet" href="/static/common/font/iconfont.css">
    <link rel="stylesheet" href="/static/libs/font-awesome/css/font-awesome.min.css" type="text/css" />
    <script src="/static/libs/layui/layui.js"></script>
    <script src="/static/libs/layui/layui.all.js"></script>
    <script src="/static/libs/jquery/jquery.min.js"></script>
    <script src="/static/libs/validator/jquery.validator.min.js"></script>
    <script src="/static/admin/js/common.js"></script>
    <script src="/static/libs/echarts/echarts.min.js" type="text/javascript"></script>
    <script>
window.conf = {"DOMAIN":"<?php echo str_replace('index.php','',app('request')->root(true)); ?>","ROOT":"__ROOT__","APP":"__APP__","STATIC":"/static","SUFFIX":"<?php echo config('url_html_suffix'); ?>"}
</script>
</head>

<body class="childrenBody">
    
<div style="margin-bottom: 10px;">
<input type="text" style="height:16px;" name="orderNo"  placeholder='订单编号' id="orderNo" class='j-ipt'/>
<select id='complainStatus' class='j-ipt'>
 <option value='-1'>投诉处理状态</option>
 <option value='0'>新投诉</option>
 <option value='1'>转给应诉人</option>
 <option value='2'>应诉人回应</option>
 <option value='3'>等待仲裁</option>
 <option value='4'>已仲裁</option>
</select>
<input type="text" id="startDate" style="height:16px;" name="startDate" class="laydate-icon j-ipt" maxLength="20" value='' placeholder='开始日期'/>
至
<input type="text" id="endDate"  style="height:16px;" name="endDate" class="laydate-icon j-ipt" maxLength="20" value='' placeholder='结束日期'/>
   <button class="btn btn-primary" onclick='javascript:loadGrid(0)'><i class="fa fa-search"></i>查询</button>
   <div style='clear:both'></div>
</div>
 <div id="mmg" class="mmg"></div>
 <div id="pg" style="text-align: right;"></div>
<script>
$(function(){initGrid(<?php echo htmlentities($p); ?>);})
</script>

    
<script src="/static/libs/mmgrid/mmGrid.js" type="text/javascript"></script>
<script src="/static/admin/js/ordercomplains.js" type="text/javascript"></script>

</body>
</html>