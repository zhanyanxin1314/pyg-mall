<?php /*a:2:{s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\seckill\edit.html";i:1564476782;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    
<form id='editseckillform1' autocomplete='off'>
<input type='hidden' id='seckillId' class='j-ipt' value='<?php echo htmlentities($object["seckillId"]); ?>'/>
<table class='pyg-form' style="line-height:50px;">
  <tr>
     <th width='150'>商品名称<font color='red'>*</font>：</th>
     <td width='550'>
        <textarea style='height:50px;width:400px' class='j-ipt' id='title' maxLength='150' data-rule='商品名称:required;'><?php echo htmlentities($object["title"]); ?></textarea>
     </td>
     <td rowspan='6'>
      <div id='goodsImgBox' style='margin-bottom:5px;'>
        <img src='<?php if($object["image"]!=''): ?><?php echo htmlentities($object["image"]); else: ?>/static/admin/img/goods.png<?php endif; ?>' id='preview' width='150' height='150'>
        </div>
        <button type="button" style="margin-left:15px;margin-top:10px" class="layui-btn layui-btn-primary pull-left" id="slide-pc1">选择商品图片</button>
        <input type='hidden' id='image' class='j-ipt' data-target='#msg_goodsImg' value='<?php if($object["seckillId"]>0): ?><?php echo htmlentities($object["image"]); ?><?php endif; ?>' data-rule="商品图片: required;"/>
     </td>
  </tr>
  <tr>
     <th>商品编号<font color='red'>*</font>：</th>
     <td><input type='text' class='j-ipt' id='goods_sn' value='<?php echo htmlentities($object["goods_sn"]); ?>' disabled="disabled" maxLength='20' data-rule='商品编号:required;'/></td>
  </tr>
  <tr>
     <th>原价<font color='red'>*</font>：</th>
     <td><input type='text' class='j-ipt' id='ot_price' value='<?php echo htmlentities($object["ot_price"]); ?>' maxLength='10' data-rule='市场价格:required;price' data-rule-price="[/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/, '价格必须大于0']" onblur="javascript:limitDecimal(this,2)" onkeypress="return isNumberdoteKey(event)" onkeyup="javascript:isChinese(this,1)"/></td>
  </tr>
  <tr>
     <th>秒杀价格<font color='red'>*</font>：</th>
     <td><input type='text' class='j-ipt' id='price' value='<?php echo htmlentities($object["price"]); ?>' maxLength='10' data-rule='市场价格:required;price' data-rule-price="[/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/, '价格必须大于0']" onblur="javascript:limitDecimal(this,2)" onkeypress="return isNumberdoteKey(event)" onkeyup="javascript:isChinese(this,1)"/></td>
  </tr>
  <tr id='goodsStockTr'>
     <th>商品库存<font color='red'>*</font>：</th>
     <td><input type='text' class='j-ipt' id='stock' value='<?php echo htmlentities($object["stock"]); ?>' maxLength='10' data-rule='商品库存:required;integer[+0]' onkeypress="return isNumberKey(event)" onkeyup="javascript:isChinese(this,1)"/></td>
  </tr>

  <tr id='goodsStockTr'>
     <th>单词购买数量<font color='red'>*</font>：</th>
     <td><input type='text' class='j-ipt' id='num' value='<?php echo htmlentities($object["num"]); ?>' maxLength='10' data-rule='商品库存:required;integer[+0]' onkeypress="return isNumberKey(event)" onkeyup="javascript:isChinese(this,1)"/></td>
  </tr>

  <tr>
     <th>促销时间<font color='red'>*</font>：</th>
     <td colspan='2'>
        <input type="text" id="start_time"  name="start_time" class="laydate-icon j-ipt" value='<?php echo htmlentities($object["start_time"]); ?>' placeholder='促销开始日期'/>
        至
        <input type="text" id="stop_time" name="stop_time" class="laydate-icon j-ipt" value='<?php echo htmlentities($object["stop_time"]); ?>' placeholder='促销结束日期'/>
     </td>
  </tr>

  <tr>
     <th>活动状态<font color='red'>*</font>：</th>
     <td colspan='2'>
        <label><input type='radio' name='status' id="status-1" class='j-ipt' value='1' <?php if($object['status']==1): ?>checked<?php endif; ?> />上架</label>
        <label><input type='radio' name='status' id="status-0" class='j-ipt' value='0' <?php if($object['status']==0): ?>checked<?php endif; ?> />下架</label>
     </td>
  </tr>
  <tr>
     <th>秒杀活动简介<font color='red'>*</font>：</th>
     <td colspan='2'>
         <textarea rows="2" cols="60" id='goodsDesc' class='j-ipt' name='goodsDesc' data-rule='商品描述:required;'><?php echo htmlentities($object['goodsDesc']); ?></textarea>
     </td>
  </tr>
  <tr>
     <td colspan='3' align='center' style='text-align:center;padding-top:10px;'>
        <button type='button' class="btn btn-primary btn-mright" onclick='javascript:editSeckill()'><i class="fa fa-check"></i>保&nbsp;存</button>
        <button type='button' class="btn" onclick="toBack(<?php echo htmlentities($p); ?>,'<?php echo htmlentities($src); ?>')"><i class="fa fa-angle-double-left"></i>返&nbsp;回</button>
     </td>
  </tr>
</table>
</form>

    
<script src="/static/libs/kindeditor/kindeditor.js" type="text/javascript" ></script>
<script type='text/javascript' src='/static/admin/js/goods.js'></script>
<script>
layui.use('laydate', function(){
  var laydate = layui.laydate;
    laydate.render({
        elem: '#start_time'
        ,type: 'datetime'
    });
    laydate.render({
        elem: '#stop_time'
        ,type: 'datetime'
    });
})
var initBatchUpload = false,editor1 = null;
<?php unset($object['goodsDesc']); ?>
var OBJ = <?=json_encode($object)?>;
$(function(){initEdit()});

</script>

</body>
</html>