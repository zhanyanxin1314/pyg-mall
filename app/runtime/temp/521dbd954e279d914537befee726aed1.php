<?php /*a:5:{s:81:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\center\favorites.html";i:1563518434;s:71:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\layout.html";i:1563936177;s:68:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\top.html";i:1563935465;s:69:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\left.html";i:1563517946;s:70:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\duibi.html";i:1560842897;}*/ ?>
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
	
	
  <link rel="stylesheet" type="text/css" href="/static/index/css/pages-seckillOrder.css" />
  <link rel="stylesheet" type="text/css" href="/static/index/css/pages-list.css" />

	
<script src="/static/libs/layer/layer.js"></script>
<script src="/static/libs/lazyload/jquery.lazyload.min.js"></script>

	
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g collect">
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
                <div class="yui3-u-5-6 goods">


                    <div class="body">                   
                            <div style="border:1px solid #ddd;margin: 0 0 12px;overflow:hidden;padding: 12px 10px;background-color: #f1f1f1;font-size:15px;">关注的商品</div>
                            <div class="goods-list">
                                <ul class="yui3-g"  id="goods-list">
								<?php if(is_array($data['data']) || $data['data'] instanceof \think\Collection || $data['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <li class="yui3-u-1-4">
                                        <div class="list-wrap">
                                            <div class="p-img"><a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>" target="_blank" title="<?php echo htmlentities($vo['goodsName']); ?>"><img title="<?php echo htmlentities($vo['goodsName']); ?>" src="<?php echo htmlentities($vo['goodsImg']); ?>" alt=''></a></div>
                                            <div class="price"><strong><em>¥</em> <i><?php echo htmlentities($vo['marketPrice']); ?></i></strong></div>
                                            <div class="attr"><em><?php echo htmlentities(mb_substr($vo['goodsName'],0,30,'utf-8')); ?></em></div>
                                            <div class="cu" style="height:30px;"><em><span>促</span>满一件可参加超值换购</em></div>
                                            <div class="operate">
                                                <a href="javascript:addCart(<?php echo htmlentities($vo['goodsId']); ?>)" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                                <a href="javascript:void(0);" onclick="javascript:contrastGoods(1,<?php echo htmlentities($vo['goodsId']); ?>,1)" class="sui-btn btn-bordered">对比</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">降价通知</a>
                                            </div>
                                        </div>
                                    </li >
								<?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                        <!--猜你喜欢-->
                        <div class="like-title">
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
												<i class="command">已有6人评价</i>
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

<div class="wst-cont-frame" id="j-cont-frame">
	<div class="head"><span>对比栏</span><a href="javascript:void(0);" class="close" onclick="javascript:contrastGoods(0,0,0)">关闭</a></div>
	<div class="list">
		<div class="goods" id="contrastList"></div>
		<div class="term-contrast">
			<p><a class="contrast" href="/index/goods/contrast" target="_blank">对比</a></p>
			<p><a href="javascript:void(0);" onclick="javascript:contrastDels(0)" class="empty">清空</a></p>
		</div>
	</div>
	<script id="colist" type="text/html">
		{{# if(d.data && d.data.length>0){ }}
		{{# for(var i=0; i<d.data.length; i++){ }}
		<div class="term">
			<div class="img"><img  src="{{ d.data[i].goodsImg }}" title="{{ d.data[i].goodsName }}" width="50" height="50"></div>
			<div class="info"><p class="name">{{ d.data[i].goodsName }}</p><p class="price"><span>￥{{ d.data[i].marketPrice }}</span><a href="javascript:contrastDels({{ d.data[i].goodsId }});" >删除</a></p></div>
		</div>
		{{# } }}
		{{# } }}
		{{# var data = (d.data)?d.data.length:0 }}
		{{# for(var i=data+1; i<5; i++){ }}
		<div class="term-empty">
			<div class="img">{{ i }}</div>
			<div class="info"><p>您还可以继续添加</p></div>
		</div>
		{{# } }}
    </script>
</div>

</body>
</html>