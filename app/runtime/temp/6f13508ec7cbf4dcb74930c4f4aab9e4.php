<?php /*a:2:{s:76:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\order\index.html";i:1561685269;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    
<input type="hidden" id="userId" class="j-ipt" value='<?php echo htmlentities($userId); ?>' autocomplete="off"/>
<input type="text" style='height: 16px;' name="orderNo"  placeholder='订单编号' id="orderNo" class='j-ipt'/>
<select id='orderStatus' class='j-ipt' style='margin-top:2px'>
  <option value='10000'>订单状态</option>
  <option value='0'>待发货</option>
  <option value='-2'>待支付</option>
  <option value='-1'>已取消</option>
  <option value='1'>配送中</option>
  <option value='2'>已收货</option>
  <option value='-3'>用户拒收</option>
</select>
<select id='payType' class='j-ipt' style='margin-top:2px'>
   <option value='-1'>支付方式</option>
   <option value='0'>货到付款</option>
   <option value='1'>在线支付</option>
</select>
   <button class="btn btn-primary" onclick='javascript:loadGrid(0)'><i class="fa fa-search"></i>查询</button>
   <?php if(($userId>0)): ?><button class="btn f-right btn-fixtop" onclick="javascript:location.href='<?php echo Url('admin/users/index','p='.$p); ?>'" style="margin-left: 10px;"><i class="fa fa-angle-double-left"></i>返回</button><?php endif; ?>
   <button class="btn btn-primary f-right btn-fixtop" onclick='javascript:toExport(0)'><i class="fa fa-sign-in"></i>导出</button>
   <div style='clear:both'></div>
<div id="mmg" class="mmg layui-form"></div>
<div id="pg" style="text-align: right;"></div>
<script>    
$(function(){initGrid(<?php echo htmlentities($p); ?>);})
</script>

    
<script src="/static/libs/mmgrid/mmGrid.js" type="text/javascript"></script>
<script src="/static/admin/js/order.js" type="text/javascript"></script>

</body>
</html>