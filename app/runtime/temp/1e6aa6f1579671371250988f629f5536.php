<?php /*a:2:{s:78:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\seckill\index.html";i:1564472146;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    
<div class="layui-card">
    <div class="layui-card-header">秒杀商品列表</div>
    <div class="layui-card-body">
        <div class="layui-form">
            <table class="layui-hide" id="table" lay-filter="table"></table>
        </div>
    </div>
</div>
<div class="wst-toolbar">
<input type="text" style="height:16px;" name="goodsName"  placeholder='商品名称/商品编号' id="title" class='j-ipt'/>
<button class="btn btn-primary" onclick='javascript:loadGrid1(0)'><i class='fa fa-search'></i>查询</button>
<div style='clear:both'></div>
</div>
<div id="mmg1" class="mmg1 layui-form"></div>
<div id="pg1" style="text-align: right;"></div>
<script>    
var mmg1;
$(function(){saleByPage1(<?php echo htmlentities($p); ?>)})
</script>

    
<script src="/static/libs/mmgrid/mmGrid.js" type="text/javascript"></script>
<script src="/static/admin/js/goods.js" type="text/javascript"></script>

</body>
</html>