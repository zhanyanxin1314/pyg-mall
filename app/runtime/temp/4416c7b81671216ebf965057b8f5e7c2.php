<?php /*a:2:{s:75:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\order\view.html";i:1561969153;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    
<div style='margin:10px;'>

   <!-- 订单信息 -->
   <div class='order-box'>
      <div class='box-head'>订单信息</div>
      <table class='wst-form'>
         <tr>
           <th width='100'>订单编号：</th>
           <td><?php echo htmlentities($object['orderNo']); ?></td>
         </tr>
         <tr>
           <th>支付方式：</th>
           <td><?php echo PYGLangPayType($object['payType']); ?></td>
         </tr>
         <?php if(($object['payType']==1 && $object['isPay']==1)): ?>
         <tr>
           <th>支付时间：</th>
           <td><?php echo htmlentities($object['payTime']); ?></td>
         </tr>

         <?php endif; ?>
      </table>
   </div>
 
   <!-- 收货人信息 -->
   <div class='order-box'>
      <div class='box-head'>收货人信息</div>
      <table class='wst-form'>
         <tr>
           <th width='100'>下单会员：</th>
           <td><?php echo htmlentities($object['loginName']); ?></td>
         </tr>
         <tr>
           <th width='100'>收货人：</th>
           <td><?php echo htmlentities($object['userName']); ?></td>
         </tr>
         <tr>
           <th>收货地址：</th>
           <td><?php echo htmlentities($object['userAddress']); ?></td>
         </tr>
         <tr>
            <th>联系方式：</th>
            <td><?php echo htmlentities($object['userPhone']); ?></td>
         </tr>
      </table>
   </div>

    <!-- 快递信息 -->
   <div class='order-box'>
      <div class='box-head'>快递信息</div>
      <table class='wst-form'>
         <tr>
           <th width='100'>快递名称：</th>
           <td><?php echo htmlentities($object['expressCode']); ?></td>
         </tr>
         <tr>
           <th>快递单号：</th>
           <td><?php echo htmlentities($object['tracking']); ?></td>
         </tr>
      </table>
   </div>
   <!-- 商品信息 -->
   <div class='order-box'>
       <div class='box-head'>商品清单</div>
       <div class='goods-head'>
          <div class='goods'>商品</div>
          <div class='price'>单价</div>
          <div class='num'>数量</div>
          <div class='t-price'>总价</div>
       </div>
       <div class='goods-item'>
          <div class='goods-list'>
             <?php if(is_array($object["goods"]) || $object["goods"] instanceof \think\Collection || $object["goods"] instanceof \think\Paginator): $i = 0; $__LIST__ = $object["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?>
             <?php echo hook('adminDocumentOrderViewGoodsPromotion',['goods'=>$vo2]); ?>
             <div class='item j-g<?php echo htmlentities($vo2['goodsId']); ?>'>
		        <div class='goods'>
		            <div class='img'>
		                <a href='<?php echo Url("index/goods/detail","goodsId=".$vo2["goodsId"]); ?>' target='_blank'>
			            <img src='<?php echo htmlentities($vo2["goodsImg"]); ?>' width='80' height='80' title='<?php echo htmlentities($vo2["goodsName"]); ?>'/>
			            </a>
		            </div>
		            <div class='name'><?php echo htmlentities($vo2["goodsName"]); ?></div>
		        </div>
		        <div class='price'>¥<?php echo htmlentities($vo2['goodsPrice']); ?></div>
		        <div class='num'><?php echo htmlentities($vo2['goodsNum']); ?></div>
		        <div class='t-price'>¥<?php echo htmlentities($vo2['goodsPrice']*$vo2['goodsNum']); ?></div>
		        <div class='f-clear'></div>
             </div>
             <?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
       </div>
       <div class='goods-footer'>
          <div class='goods-summary' style='text-align:right'>
             <div class='summary'>实付总金额：¥<span><?php echo htmlentities($object['totalMoney']); ?></span></div>
          </div>
       </div>
   </div>
   <div class='wst-footer'>
       <button type="button" class="btn btn-mright" onclick="javascript:history.back(-1)"><i class="fa fa-angle-double-left"></i>返回</button>
   </div>
    <div id="editOrder" style="display: none;">
        <table class='wst-form wst-box-top'>
            <tr>
              <th>支付方式<font color='red'>*</font>：</th>
              <td>
            <select id="payFrom">
                <?php if(is_array($payMents) || $payMents instanceof \think\Collection || $payMents instanceof \think\Paginator): $i = 0; $__LIST__ = $payMents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pays): $mod = ($i % 2 );++$i;if($pays['payCode']!='wallets'): ?>
                <option value="<?php echo htmlentities($pays['payCode']); ?>"><?php echo htmlentities($pays['payName']); ?></option>
                <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select></td>
        </tr>
        <tr>
            <th>外部流水号<font color='red'>*</font>：</th>
            <td><input type="text" id="trade_no" autocomplete="false" style='width:95%'></td>
        </tr>
    </div>
<div>

    
</body>
</html>