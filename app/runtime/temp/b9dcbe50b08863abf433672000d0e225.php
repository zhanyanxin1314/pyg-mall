<?php /*a:2:{s:75:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\bank\index.html";i:1560423488;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    <div class="layui-card-header">银行管理</div>
    <div class="layui-card-body">
        <div class="layui-form">
            <table class="layui-hide" id="table" lay-filter="table"></table>
        </div>
    </div>
</div>
<div class="layui-btn-container">
    <a class="layui-btn layui-btn-sm" onclick='javascript:toEdit(0)'>新增银行</a>
</div>
<div id="mmg" class="mmg"></div>
<div id="pg" style="text-align: right;"></div>
<div id='bankBox' style='display:none'>
    <form id='bankForm' autocomplete="off">
    <table class='wst-form wst-box-top'>
       <tr>
          <th width='100'>银行名称<font color='red'>*</font>：</th>
          <td><input type='text' id='bankName' name="bankName"  class='ipt' maxLength='20'/></td>
       </tr>
    </table>
    </form>
 </div>
<script>
  $(function(){initGrid(<?php echo htmlentities($p); ?>)});
</script>

    
<script src="/static/libs/mmgrid/mmGrid.js" type="text/javascript"></script>
<script src="/static/admin/js/bank.js" type="text/javascript"></script>

</body>
</html>