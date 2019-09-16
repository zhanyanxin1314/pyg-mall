<?php /*a:2:{s:82:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\adpositions\index.html";i:1560754252;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    
<form autocomplete="off" >
   <input type='text' style="height:16px;" id='key' class="query" placeholder='位置代码'/>
   <button type="button" class="btn btn-primary" onclick="javascript:loadQuery()"><i class='fa fa-search'></i>查询</button>
   <div style="clear:both"></div>
</form>
<div class="layui-btn-container" style="margin-left:6px;margin-top:10px;">
    <a class="layui-btn layui-btn-sm" onclick="javascript:location.href='<?=url("/admin/Adpositions/toEdit")?>'">新增广告位</a>
</div>

<div id="mmg" class="mmg"></div>
<div id="pg" style="text-align: right;"></div>
<script>
  $(function(){initGrid(<?php echo htmlentities($p); ?>)});
</script>

    
<script src="/static/libs/mmgrid/mmGrid.js" type="text/javascript"></script>
<script src="/static/admin/js/adpositions.js" type="text/javascript"></script>

</body>
</html>