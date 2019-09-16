<?php /*a:2:{s:76:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\goods\index.html";i:1560505561;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    
<div class="wst-toolbar">
<input type="text" style="height:16px;" name="goodsName"  placeholder='商品名称/商品编号' id="goodsName" class='j-ipt'/>
<button class="btn btn-primary" onclick='javascript:loadGrid(0)'><i class='fa fa-search'></i>查询</button>
<div style='clear:both'></div>
</div>
<div class="layui-btn-container" style="margin-left: 5px;">
    <a class="layui-btn layui-btn-sm" onclick="toAdd()">新增商品</a>
</div>
<div id="mmg" class="mmg layui-form"></div>
<div id="pg" style="text-align: right;"></div>
<script>    
var mmg;
$(function(){saleByPage(<?php echo htmlentities($p); ?>)})
</script>

    
<script src="/static/libs/mmgrid/mmGrid.js" type="text/javascript"></script>
<script src="/static/admin/js/goods.js" type="text/javascript"></script>

</body>
</html>