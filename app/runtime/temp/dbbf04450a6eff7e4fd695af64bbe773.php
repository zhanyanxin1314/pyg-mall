<?php /*a:3:{s:76:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\carts\index.html";i:1568623786;s:71:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\layout.html";i:1563936177;s:68:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\top.html";i:1563935465;}*/ ?>
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
	
	
 <link rel="stylesheet" type="text/css" href="/static/index/css/pages-cart.css" />

	
	
	<div class="cart py-container">
		<!--All goods-->
		<div class="allgoods">
			<h4>全部商品<span></span></h4>
			<div class="cart-main">
				<div class="yui3-g cart-th">
					<div class="yui3-u-1-4"><input type="checkbox" name="" id="" value="" /> 全部</div>
					<div class="yui3-u-1-4">商品</div>
					<div class="yui3-u-1-8">单价（元）</div>
					<div class="yui3-u-1-8">数量</div>
					<div class="yui3-u-1-8">小计（元）</div>
					<div class="yui3-u-1-8">操作</div>
				</div>

				<div class="cart-item-list">
					<div class="cart-body">
						
						<div class="cart-list">
							<?php if(is_array($carts['carts']) || $carts['carts'] instanceof \think\Collection || $carts['carts'] instanceof \think\Paginator): $i = 0; $__LIST__ = $carts['carts'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<ul class="goods-list yui3-g">

								<li class="yui3-u-1-24">
									<input type="checkbox" name="" id="" value="" />
								</li>
								<li class="yui3-u-6-24">
									<div class="good-item" style="width: 500px;">
										<div class="item-img"><img src="<?php echo htmlentities($vo['goodsImg']); ?>" /></div>
										<div class="item-msg"><?php if($vo['isPro'] == 2): ?><?php echo htmlentities($vo['goodsName']); ?> <span style="color: #660000">[秒杀商品]</span> <?php else: ?><?php echo htmlentities($vo['goodsName']); ?><?php endif; ?></div>
									</div>
								</li>
								<li class="yui3-u-5-24">
									<div class="item-txt"></div>
								</li>
								<?php if($vo['isPro'] == 2): ?>
								<li class="yui3-u-1-8"><span class="price"><?php echo htmlentities($vo['price']); ?></span></li>
								<?php else: ?>
								<li class="yui3-u-1-8"><span class="price"><?php echo htmlentities($vo['marketPrice']); ?></span></li>
								<?php endif; ?>
								<li class="yui3-u-1-8">
									<!--<a href="javascript:void(0)" class="increment mins">-</a>-->
									<input autocomplete="off" type="text" value="<?php echo htmlentities($vo['cartNum']); ?>" minnum="1" class="itxt" />
									<!--<a href="javascript:void(0)" class="increment plus">+</a>-->
								</li>
								<li class="yui3-u-1-8"><span class="sum"><?php echo htmlentities($vo['xiaoji']); ?></span></li>
								<li class="yui3-u-1-8">
									<a href="javascript:delCart(<?php echo htmlentities($vo["cartId"]); ?>)">删除</a><br />
									<!--<a href="#none">移到我的关注</a>-->
								</li>
							</ul>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="cart-tool">
				<div class="select-all">
					<input type="checkbox" name="" id="" value="" />
					<span>全选</span>
				</div>
				<!--<div class="option">
					<a href="#none">删除选中的商品</a>
					<a href="#none">移到我的关注</a>
					<a href="#none">清除下柜商品</a>
				</div>-->
				<div class="toolbar">
					<div class="chosed">已选择<span style="font-size: 12px;color: red;">&nbsp;<?php echo htmlentities($carts['goodsTotalNum']); ?>&nbsp;</span>件商品</div>
					<div class="sumprice">
						<span><em>总价（不含运费） ：</em><i class="summoney">¥<?php echo htmlentities($carts['goodsTotalMoney']); ?></i></span>
						<!--<span><em>已节省：</em><i>-¥20.00</i></span>-->
					</div>
					<div class="sumbtn">
						<a class="sum-btn" target="_blank" href="<?php echo Url('index/carts/settlement'); ?>">结算</a>
					</div>
				</div>
			</div>
			<div class="liked">
				<ul class="sui-nav nav-tabs">
					<li class="active">
						<a href="#index" data-toggle="tab">猜你喜欢</a>
					</li>
					<li>
						<a href="#profile" data-toggle="tab">特惠换购</a>
					</li>
				</ul>
				<div class="clearfix"></div>
				<div class="tab-content">
					<div id="index" class="tab-pane active">
						<div id="myCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
							<div class="carousel-inner">
								<div class="active item">
									<ul>
										
										<?php $_result=PYGGetIndexLikeGoods();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
										<li>
										<a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>">
										<img style="width:197px;height:182px;" src="<?php echo htmlentities($vo['goodsImg']); ?>" />
										</a>
											<div class="intro">
												<i><?php echo htmlentities(mb_substr($vo['goodsName'],0,20,'utf-8')); ?></i>
											</div>
											<div class="money">
												<span>$<?php echo htmlentities($vo['marketPrice']); ?></span>
											</div>
											<div class="incar">
												<a href="javascript:addCart(<?php echo htmlentities($vo['goodsId']); ?>)" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
								<div class="item">
									<ul>
										<?php $_result=PYGGetIndexLikeGoods();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
										<li>
										<a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>">
										<img style="width:197px;height:182px;" src="<?php echo htmlentities($vo['goodsImg']); ?>" />
										</a>
											<div class="intro">
												<i><?php echo htmlentities(mb_substr($vo['goodsName'],0,20,'utf-8')); ?></i>
											</div>
											<div class="money">
												<span>$<?php echo htmlentities($vo['marketPrice']); ?></span>
											</div>
											<div class="incar">
												<a href="javascript:addCart(<?php echo htmlentities($vo['goodsId']); ?>)" class="sui-btn btn-bordered btn-xlarge btn-default"><i class="car"></i><span class="cartxt">加入购物车</span></a>
											</div>
										</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
							</div>
							<a href="#myCarousel" data-slide="prev" class="carousel-control left">‹</a>
							<a href="#myCarousel" data-slide="next" class="carousel-control right">›</a>
						</div>
					</div>
					<div id="profile" class="tab-pane">
						<p>特惠选购</p>
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