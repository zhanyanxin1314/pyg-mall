<?php /*a:4:{s:78:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\center\cancel.html";i:1561975165;s:71:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\layout.html";i:1563936177;s:68:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\top.html";i:1563935465;s:69:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\left.html";i:1563517946;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>品优购，优质！优质！</title>
	<link rel="icon" href="/assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/static/index/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/pages-JD-index.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/widget-jquery.autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/duibi.css" />
     <link rel="stylesheet" type="text/css" href="/static/libs/layui/css/layui.css" />
     <link href="/static/libs/validator/jquery.validator.css" rel="stylesheet">
    <script src="/static/libs/jquery/jquery.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$("#service").hover(function(){
			$(".service").show();
		},function(){
			$(".service").hide();
		});
		$("#shopcar").hover(function(){
			$("#shopcarlist").show();
 			var str1 = '';
            $.post("/index/index/getcart",function(data){
         			if(data.shopnum == 0){
         				str1 += '购物车暂无数据';
         				$("#shopcarlist").html(str1);
         				return;
         			} else {
	         			$('.shopnum').html(data.shopnum);
	                    $.each(data,function(i,subobj) {
	                       $.each(subobj.goods,function(k,subobk) {
	                        str1 += '<p>'+subobk['goodsName'].substring(0,25)+'</p>';
	                        
	                        $("#shopcarlist").html(str1);
	                   		});  
	                	}); 
                	}
            });
		},function(){
			$("#shopcarlist").hide();
		});
	})
	</script>
	<script src="/static/libs/validator/jquery.validator.min.js"></script>
	<script type="text/javascript" src="/static/index/js/model/cartModel.js"></script>
	<script type="text/javascript" src="/static/index/js/czFunction.js"></script>
	<script type="text/javascript" src="/static/libs/jquery.easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="/static/libs/sui/sui.min.js"></script>
	<script type="text/javascript" src="/static/index/js/pages/index.js"></script>
	<script type="text/javascript" src="/static/index/js/widget/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="/static/index/js/widget/nav.js"></script>
    <script src="/static/libs/layui/layui.js"></script>
    <script src="/static/libs/layui/layui.all.js"></script>
    <script src="/static/common/js/common.js"></script>
    <script type="text/javascript" src="/static/libs/jquery.jqzoom/jquery.jqzoom.js"></script>
	<script type="text/javascript" src="/static/libs/jquery.jqzoom/zoom.js"></script>
	<script type="text/javascript" src="/static/index/js/goods.js"></script>
	<script src="/static/index/js/order.js"></script>
	<script src="/static/index/js/center.js"></script>
</head>
<script type="text/javascript">
window.conf = {"ROOT":"__ROOT__","APP":"__APP__","STATIC":"/static","IS_LOGIN":"<?php if((int)session('PYG_USER.userId')>0): ?>1<?php else: ?>0<?php endif; ?>"}
</script>
<body>
	
		<div id="nav-bottom">
	<!--顶部-->
	<div class="nav-top">
		<div class="top">
			<div class="py-container">
				<div class="shortcut">
					<?php if(session('PYG_USER.userId') >0): ?>
						<ul class="fl">
							<li class="f-item">品优购欢迎您！</li>
							<li class="f-item"> <?php echo session('PYG_USER.trueName')?session('PYG_USER.trueName'):session('PYG_USER.loginName'); ?> | <span><a href="javascript:logout();" >退出</a></span></li>
						</ul>
						<ul class="fr">
							<li class="f-item"><a href="<?php echo Url('index/center/order'); ?>" target="_blank">我的订单</a></li>
							<li class="f-item space"></li>
							<li class="f-item"><a href="<?php echo Url('index/center/favorites'); ?>" target="_blank">我的关注</a></li>
							<li class="f-item space"></li>
						</ul>
					<?php else: ?>
						<ul class="fl">
							<li class="f-item">品优购欢迎您！</li>
							<li class="f-item"> 请 <a href="<?php echo Url('index/users/login'); ?>" target="_blank"> 登录 </a>　<span><a href="<?php echo Url('index/users/regist'); ?>" >免费注册</a></span></li>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!--头部-->
		<div class="header">
			<div class="py-container">
				<div class="yui3-g Logo">
					<div class="yui3-u Left logoArea">
					<a class="logo-bd" title="品优购" href="/" target="_blank"></a>
					</div>
					<div class="yui3-u Center searchArea">
						<div class="search">
							<form action="" class="sui-form form-inline">
								<div class="input-append">
									<input type="text" id='search-ipt' type="text" class="input-error input-xxlarge" value="<?php echo htmlentities($keyword); ?>" />
									<button class="sui-btn btn-xlarge btn-danger" type="button" onclick='javascript:search(this.value)'>搜索</button>
								</div>
							</form>
						</div>
						<div class="hotwords">
							<ul>
								<li class="f-item">品优购首发</li>
								<li class="f-item">亿元优惠</li>
								<li class="f-item">9.9元团购</li>
								<li class="f-item">每满99减30</li>
								<li class="f-item">亿元优惠</li>
								<li class="f-item">9.9元团购</li>
							</ul>
						</div>
					</div>
					<div class="yui3-u Right shopArea">
						<div class="fr shopcar">
							<div class="show-shopcar" id="shopcar">
								<span class="car"></span>
								<a class="sui-btn btn-default btn-xlarge" href="<?php echo Url('index/carts/index'); ?>" target="_blank">
									<span>我的购物车</span>
									<i class="shopnum"><?php echo PYGCartsGoodsNum(); ?></i>
								</a>
								<div class="clearfix shopcarlist" id="shopcarlist" >
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="yui3-g NavList">
					<div class="yui3-u Left all-sort">
						<h4>全部商品分类</h4>
					</div>
					<div class="yui3-u Center navArea">
						<ul class="nav">
							<li class="f-item"><a style="color:#000;text-decoration:none;" href="/" target="_blank">首页</a></li>
							<li class="f-item"><a style="color:#000;text-decoration:none;" href="<?php echo Url('index/seckill/index'); ?>" target="_blank">秒杀</a></li>
							
							<!--<li class="f-item">品优超市</li>
							<li class="f-item">全球购</li>
							<li class="f-item">闪购</li>
							<li class="f-item">团购</li>
							<li class="f-item">有趣</li>-->
						</ul>
					</div>
					<div class="yui3-u Right"></div>
				</div>
			</div>
		</div>
	</div>
</div>
	
	
  <link rel="stylesheet" type="text/css" href="/static/index/css/pages-myOrder.css" />

	
	
		<div id="account">
			<div class="py-container">
				<div class="yui3-g home">
					<!--左侧列表-->
					<div class="yui3-u-1-6 list">
	<dl>
		<dt><i>·</i> 订单中心</dt>
		<a style="text-decoration:none;color: #333;" href="<?php echo Url('index/center/order'); ?>"><dd <?php if($nav =='order'): ?>class="active"<?php endif; ?>>我的订单</dd></a>
		<a style="text-decoration:none;color: #333;" href="<?php echo Url('index/center/appraise'); ?>"><dd <?php if($nav =='appraise'): ?>class="active"<?php endif; ?>>评价晒单</dd></a>
		<a style="text-decoration:none;color: #333;" href="<?php echo Url('index/center/cancel'); ?>"><dd <?php if($nav =='cancel'): ?>class="active"<?php endif; ?>>取消订单记录</dd></a>
	</dl>
	<dl>
		<dt><i>·</i> 关注中心</dt>
		<a style="text-decoration:none;color: #333;" href="<?php echo Url('index/center/favorites'); ?>"><dd <?php if($nav =='favorites'): ?>class="active"<?php endif; ?>>关注的商品 </dd></a>
		<a style="text-decoration:none;color: #333;" href="<?php echo Url('index/center/history'); ?>"><dd <?php if($nav =='history'): ?>class="active"<?php endif; ?>>浏览历史 </dd></a>
	</dl>
	<dl>
		<dt><i>·</i> 客户服务</dt>
		<!--<dd>返修退换货 </dd>-->
		<a style="text-decoration:none;color: #333;" href="<?php echo Url('index/center/inform'); ?>"><dd <?php if($nav =='inform'): ?>class="active"<?php endif; ?>>违规举报 </dd></a>
		<a style="text-decoration:none;color: #333;" href="<?php echo Url('index/center/complains'); ?>"><dd <?php if($nav =='complains'): ?>class="active"<?php endif; ?>>投诉管理 </dd></a>
	</dl>
	<dl>
		<dt><i>·</i> 设置</dt>
		<a style="text-decoration:none;color:#333;" href="<?php echo Url('index/center/info'); ?>"><dd <?php if($nav =='info'): ?>class="active"<?php endif; ?>>个人信息</dd></a>
		<a style="text-decoration:none;color:#333;" href="<?php echo Url('index/center/address'); ?>"><dd <?php if($nav =='address'): ?>class="active"<?php endif; ?>> 收货地址</dd></a>
		<a style="text-decoration:none;color:#333;" href="<?php echo Url('index/center/safe'); ?>"><dd <?php if($nav =='safe'): ?>class="active"<?php endif; ?>> 安全设置</dd></a>
	</dl>
</div>		
					<!--右侧主内容-->
					<div class="yui3-u-5-6 body">
						<div class="order">
							<div class="mt">
								<span class="fl"><strong >取消订单记录</strong></span>
							</div>
						</div>
						<div class="order-detail">
							<div class="ever">
								<div class="clearfix"></div>
								<div class="tab-content">
											<div class="chosetype">
												<table class="sui-table table-bordered-simple">
													<thead>
														<tr>
															<th width="60%">订单详情</th>
															<th width="13%">收货人</th>
															<th width="10%">金额</th>
															<th>订单状态</th>
															<th>操作</th>
														</tr>
													</thead>
													</tbody>
												</table>
											</div>
											<div id="all" class="tab-pane active">
											<div class="orders">
											<table class="sui-table table-bordered">
												<?php if(is_array($list['cancelOrders']) || $list['cancelOrders'] instanceof \think\Collection || $list['cancelOrders'] instanceof \think\Paginator): $i = 0; $__LIST__ = $list['cancelOrders'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
												<thead>
													<tr>
														<th colspan="5">
															<span class="ordertitle"><?php echo htmlentities($vo['createTime']); ?>　订单编号：<?php echo htmlentities($vo['orderNo']); ?> <span class="pull-right delete"><a onclick="toDel(<?php echo htmlentities($vo['orderId']); ?>);"><img src="/static/index/img/delete.png"/></a></span></span>
														</th>
													</tr>
												</thead>
												<tbody>
													<?php if(is_array($vo['goods']['list']) || $vo['goods']['list'] instanceof \think\Collection || $vo['goods']['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $vo['goods']['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($key % 2 );++$key;?>
													<tr>
														<td width="60%">
															<div class="typographic"><img style="width:100px;height:100px;" src="<?php echo htmlentities($vo1['goodsImg']); ?>" />
																<a target="_blank" href='<?php echo Url("index/goods/detail",["goodsId"=>$vo1["goodsId"]]); ?>' class="block-text"><?php echo htmlentities($vo1['goodsName']); ?></a><span>x<?php echo htmlentities($vo1['goodsNum']); ?></span>
															</div>
														</td>
														<?php if($key == 1): ?>
														<td rowspan="<?php echo htmlentities($vo['goods']['totalk']); ?>" width="8%" class="center"><?php echo htmlentities($vo['userName']); ?></td>
														<td rowspan="<?php echo htmlentities($vo['goods']['totalk']); ?>" width="13%" class="center">
															<ul class="unstyled">
																<li>总金额&nbsp;¥<?php echo htmlentities($vo['totalMoney']); ?></li>
																<li><?php if($vo['payType'] == 1): ?>在线支付<?php else: ?>货到付款<?php endif; ?></li>
															</ul>
														</td>
														<td rowspan="<?php echo htmlentities($vo['goods']['totalk']); ?>"  class="center">
															<ul class="unstyled">
																<?php if($vo['isCancel'] == 1): ?> 
																	已取消
																<?php endif; ?>
															</ul>
														</td>
														<td rowspan="<?php echo htmlentities($vo['goods']['totalk']); ?>" width="8%" class="center">
															<a onclick="resumedOrders(<?php echo htmlentities($vo['orderId']); ?>);" style="text-decoration:none;" class="layui-btn layui-btn-sm layui-btn-radius layui-btn-danger">恢复订单</a><br /><br />
														</td>
														<?php endif; ?>
													</tr>
													<?php endforeach; endif; else: echo "" ;endif; ?>
												</tbody>
												<?php endforeach; endif; else: echo "" ;endif; ?>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="order">
							<div class="mt">
								<span class="fl"><strong>猜你喜欢</strong></span>
							</div>
						</div>
						<div class="like-list">
							<ul class="yui3-g">
								<?php $_result=PYGGetIndexLikeGoods();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
								<li class="yui3-u-1-4">
									<div class="list-wrap">
										<div class="p-img">
											<a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>" title="<?php echo htmlentities($vo['goodsName']); ?>"><img src="<?php echo htmlentities($vo['goodsImg']); ?>" /></a>
										</div>
										<div class="attr">
											<em><?php echo htmlentities(mb_substr($vo['goodsName'],0,20,'utf-8')); ?></em>
										</div>
										<div class="price">
											<strong>
											<em>¥</em>
											<i><?php echo htmlentities($vo['marketPrice']); ?></i>
										</strong>
										</div>
										<div class="commit">
											<i class="command">已有700人评价</i>
										</div>
									</div>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 底部栏位 -->
		<!--页面底部-->
	<div class="clearfix footer">
	<div class="py-container">
		<div class="footlink">
			<div class="Mod-service">
				<ul class="Mod-Service-list">
					<li class="grid-service-item intro  intro1">
						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>
					</li>
					<li class="grid-service-item  intro intro2">
						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>
					</li>
					<li class="grid-service-item intro  intro3">
						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>
					</li>
					<li class="grid-service-item  intro intro4">
						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>
					</li>
					<li class="grid-service-item intro intro5">
						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>
					</li>
				</ul>
			</div>
			<div class="clearfix Mod-list">
				<div class="yui3-g">
					<div class="yui3-u-1-6">
						<h4>购物指南</h4>
						<ul class="unstyled">
							<li>购物流程</li>
							<li>会员介绍</li>
							<li>生活旅行/团购</li>
							<li>常见问题</li>
							<li>购物指南</li>
						</ul>

					</div>
					<div class="yui3-u-1-6">
						<h4>配送方式</h4>
						<ul class="unstyled">
							<li>上门自提</li>
							<li>211限时达</li>
							<li>配送服务查询</li>
							<li>配送费收取标准</li>
							<li>海外配送</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>支付方式</h4>
						<ul class="unstyled">
							<li>货到付款</li>
							<li>在线支付</li>
							<li>分期付款</li>
							<li>邮局汇款</li>
							<li>公司转账</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>售后服务</h4>
						<ul class="unstyled">
							<li>售后政策</li>
							<li>价格保护</li>
							<li>退款说明</li>
							<li>返修/退换货</li>
							<li>取消订单</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>特色服务</h4>
						<ul class="unstyled">
							<li>夺宝岛</li>
							<li>DIY装机</li>
							<li>延保服务</li>
							<li>品优购E卡</li>
							<li>品优购通信</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>帮助中心</h4>
						<img src="../img/wx_cz.jpg">
					</div>
				</div>
			</div>
			<div class="Mod-copyright">
				<ul class="helpLink">
					<li>关于我们<span class="space"></span></li>
					<li>联系我们<span class="space"></span></li>
					<li>关于我们<span class="space"></span></li>
					<li>商家入驻<span class="space"></span></li>
					<li>营销中心<span class="space"></span></li>
					<li>友情链接<span class="space"></span></li>
					<li>关于我们<span class="space"></span></li>
					<li>营销中心<span class="space"></span></li>
					<li>友情链接<span class="space"></span></li>
					<li>关于我们</li>
				</ul>
				<p>地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</p>
				<p>京ICP备08001421号京公网安备110108007702</p>
			</div>
		</div>
	</div>
</div>

</body>
</html>