<?php /*a:2:{s:84:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\ordercomplains\view.html";i:1563441532;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    
<div id="wst-tabs" style="width:100%; height:99%;overflow: hidden; border: 1px solid #D3D3d3;" class="liger-tab">
   <div id="wst-tab-1" tabId="wst-tab-1"  title="投诉详情" class='wst-tab'  style="height: 100%"> 
   <div style="margin:10px">
    <!-- 投诉信息 -->
    <div class='order-box'>
      <table class='wst-form'>
         <tr>
           <td class='head-ititle'>投诉信息</td>
         </tr>
         <tr>
           <th width='100'>订单编号：</th>
           <td><?php echo htmlentities($object['orderNo']); ?></td>
         </tr>
         <tr>
           <th>投诉人：</th>
           <td><?php echo htmlentities($order['userName']); ?></td>
         </tr>
         <tr>
            <th>投诉类型：</th>
            <td>
             <?php if($order['complainType'] == 1): ?>
                                        承诺的没有做到
            <?php elseif($order['complainType'] == 2): ?>
                                        未按约定时间发货
            <?php elseif($order['complainType'] == 3): ?>
                                        未按成交价进行交易
            <?php elseif($order['complainType'] == 4): ?>
                                        恶意骚扰                          
            <?php endif; ?>
            </td>
         </tr>
        
         <tr>
            <th>投诉内容：</th>
            <td class='line-break'><?php echo htmlentities($order['complainContent']); ?></td>
         </tr>
         <tr>
            <th>投诉时间：</th>
            <td><?php echo htmlentities($order['complainTime']); ?></td>
         </tr>
      </table>
   </div>
   <!-- 仲裁结果 -->
   <div class='order-box'>
      <table class='wst-form'>
         <tr>
           <td class='head-ititle'>仲裁结果</td>
         </tr>
         <tr>
      <th>处理状态：</th>
          <td>
            <?php if($order['complainStatus'] == 0): ?>
                                        等待处理
            <?php elseif($order['complainStatus'] == 1): ?>
                                        等待应诉人回应
            <?php elseif($order['complainStatus'] == 2): ?>
                                        应诉人回应
            <?php elseif($order['complainStatus'] == 3): ?>
                                        等待仲裁
            <?php elseif($order['complainStatus'] == 4): ?>
                                         已仲裁       
            <?php endif; ?>
          </td>
       </tr>
       <tr>
          <td align='right' valign='right' width='120'>当前订单状态：</td>
          <td>
              <?php echo PYGLangOrderStatus($order['order']['orderStatus']); ?>
          </td>
       </tr>
       <tr>
      <th>仲裁结果：</th>
          <td class='line-break'>
           <?php echo htmlentities($order['finalResult']); ?>
          </td>
       </tr>
       <th>仲裁时间：</th>
          <td>
           <?php echo htmlentities($order['finalResultTime']); ?>
          </td>
       </tr>
      
        
      </table>
   </div>
  </div>
</div>
   <div title="订单详情" class='wst-tab' id="order-detail"  style="height: 99%"> 
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
      </table>
   </div>


   <!-- 收货人信息 -->
   <div class='order-box'>
      <div class='box-head'>收货人信息</div>
      <table class='wst-form'>
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
            
             <div class='item j-g<?php echo htmlentities($vo2['goodsId']); ?>'>
            <div class='goods'>
                <div class='img'>
                    <a href='<?php echo Url("home/goods/detail","goodsId=".$vo2["goodsId"]); ?>' target='_blank'>
                  <img src='<?php echo htmlentities($vo2["goodsImg"]); ?>' width='80' height='80' title='<?php echo htmlentities($vo2["goodsName"]); ?>'/>
                  </a>
                </div>
                <div class='name'><?php echo htmlentities($vo2["goodsName"]); ?></div>
                <div class='spec'><?php echo str_replace('@@_@@','<br/>',$vo2["goodsSpecNames"]); ?></div>
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
             <div class='summary'>应付总金额：¥<span><?php echo htmlentities($object['totalMoney']); ?></span></div>
          </div>
       </div>
   </div>
   <?php if($from == 0): ?>
   <div class='wst-footer'><button type="button" onclick='javascript:history.go(-1)' class='btn'><i class="fa fa-angle-double-left"></i>返回</button></div>
   <?php endif; ?>
<div>
   </div>


</div>
<script>
$(function(){
  parent.showImg({photos: $('#respondAnnex')});
  parent.showImg({photos: $('#complainAnnex')});
});
</script>

    
</body>
</html>