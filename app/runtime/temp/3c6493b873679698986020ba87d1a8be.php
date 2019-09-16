<?php /*a:2:{s:80:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\order\shipments.html";i:1561971752;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    <div class="layui-card-body">
       
         <input type="hidden" name="orderId" id="orderId" class="ipt" value="<?php echo htmlentities($orderId); ?>" />
        <form id="expressForm">
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: auto;">快递名称 </label>
                <div class="layui-input-inline w300">
                  <select id="expressCode" name="expressCode" class='ipt' maxLength='20'>
                  <option value="">-请选择-</option>
                  <?php $_result=PYGGetExpressDatas();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo htmlentities($vo['expressName']); ?>"><?php echo htmlentities($vo['expressName']); ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: auto;">快递单号 </label>
                <div class="layui-input-inline w300">
                    <input type="text" name="tracking" id="tracking" placeholder="快递单号" class="ipt" />
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" type="submit">立即发货</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(function(){
  $('#expressForm').validator({
        fields: {
          expressCode: {
            tip: "请选择快递名称",
            rule: '快递名称:required;length[~30];'
          },
          tracking:{
                  tip:"请输入快递单号",
                  rule:"快递单号:required;",
          }
        },
        valid: function(form){
          var orderId = $('#orderId').val();
          toEditsExpress(orderId,<?php echo htmlentities($p); ?>);
        }
  })
});
</script>

    
<script src="/static/admin/js/order.js" type="text/javascript"></script>

</body>
</html>