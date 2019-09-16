<?php /*a:3:{s:79:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\seckill\detail.html";i:1565001347;s:71:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\layout.html";i:1563936177;s:68:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\top.html";i:1563935465;}*/ ?>
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
	
	
<link rel="stylesheet" type="text/css" href="/static/index/css/pages-item.css" />
<link rel="stylesheet" type="text/css" href="/static/index/css/pages-zoom.css" />
<style type="text/css">
.timeBox{
    background: #c81623;
	position: relative;
	bottom:-12px;
	color:#fff;
	padding:5px 10px;
}
.timeBox .icon{
	display: inline-block;
	position: relative;
	top:2px;
	width: 15px;
	height: 15px;
	margin-right: 3px;
	background: url(../../static/index/img/clockm.png) left top no-repeat;
}
.timeBox .time{
	position: absolute;
	top:5px;
	right:10px;
}
.timeBox .time span{
	display: inline-block;
	text-align: center;
	margin-right:0px;
	background: #9b1a2c;
	width: 20px;
}
.gw_num{border: 1px solid #dbdbdb;width: 110px;line-height: 26px;overflow: hidden;}
.gw_num em{display: block;height: 26px;width: 26px;float: left;color: #7A7979;border-right: 1px solid #dbdbdb;text-align: center;cursor: pointer;}
.gw_num .num{display: block;float: left;text-align: center;width: 52px;font-style: normal;font-size: 14px;line-height: 24px;border: 0;}
.gw_num em.add{float: right;border-right: 0;border-left: 1px solid #dbdbdb;}
</style>

	
<script type="text/javascript">
	
	var currentDate = new Date();

	var EndTime=new Date("<?php echo htmlentities($goods['stop_time']); ?>");

	var days= EndTime - currentDate; 

	EndTimeMsg  = parseInt(days / 1000);

	function show(){
		h = Math.floor(EndTimeMsg / 60 / 60);
	    m = Math.floor((EndTimeMsg - h * 60 * 60) / 60);
	    s = Math.floor((EndTimeMsg - h * 60 * 60 - m * 60));
	    $('#DD').html(parseInt(h/24));
	    $('#HH').html(h);
	    $('#MM').html(m);
	    $('#SS').html(s);
	    EndTimeMsg--;
	    if (EndTimeMsg < 0)
	    {
	    	$('#DD').html("00");
	    	$('#HH').html("00");
	    	$('#MM').html("00");
	    	$('#SS').html("00");
	    }
	}
	setInterval("show()",1000);
</script>

	
	<div class="py-container">
		<div id="item">
			<div class="crumb-wrap">
				<ul class="sui-breadcrumb">
					<li>
						<a href='/'>首页</a>
					</li>
				</ul>
			</div>
			<!--product-info-->
			<div class="product-info">
				<div class="fl preview-wrap">
					<!--放大镜效果-->
					<div class="zoom">

						<!--默认第一个预览-->
						<div id="preview" class="spec-preview">
							<span class="jqzoom"><img style="width: 400px;" jqimg="" src="<?php echo htmlentities($goods['image']); ?>" /></span>

						</div>

						<!--下方的缩略图-->
						<div class="spec-scroll">
							<a class="prev">&lt;</a>
							<!--左右按钮-->
							<div class="items">
								<ul>
									<?php if(is_array($goods['gallery']) || $goods['gallery'] instanceof \think\Collection || $goods['gallery'] instanceof \think\Paginator): $i = 0; $__LIST__ = $goods['gallery'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<li><img src="<?php echo htmlentities($vo); ?>" bimg="<?php echo htmlentities($vo); ?>" onmousemove="preview(this)" /></li>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>

							</div>
							<a class="next">&gt;</a>
						</div>
					</div>
				</div>
				<div class="fr itemInfo-wrap">
					<div class="sku-name">
						<h4><?php echo htmlentities($goods['title']); ?></h4>
					</div>
					<div class="news"><span>推荐选择下方[移动优惠购],手机套餐齐搞定,不用换号,每月还有花费返</span></div>
					<div class="timeBox">
						<span><i class="icon"></i>秒杀活动</span>
						<span class="time">

							<!-- <div><strong class="DD"></strong>&nbsp;天 <strong class="HH"></strong>&nbsp;时 <strong class="MM"></strong>&nbsp;分 <strong class="SS"></strong>&nbsp;秒</div> -->

							<i>距离结束：</i>
							<span id="DD"></span>
							
							<i>:</i>
							<span id="HH"></span>
							
							<i>:</i>
							<span id="MM"></span>

							<i>:</i>
							<span id="SS"></span>
						</span>
					</div>
					<div class="summary">
						<div class="summary-wrap">
							<div class="fl title">
								<i>秒杀价</i>
							</div>
							<div class="fl price" style="margin-top:11px;">
								<i>¥</i>
								<em><?php echo htmlentities($goods['price']); ?></em>
							</div>
							<div class="fr remark">
								<i>剩余库存 : </i><em><?php echo htmlentities($goods['stock']); ?></em>
							</div>
						</div>

						<div class="summary-wrap">
							<div class="fl title">
								<i>原&nbsp;价</i>
							</div>
							<div class="fl" style="margin-top:11px;text-decoration:line-through">
								<i>¥</i>
								<em><?php echo htmlentities($goods['ot_price']); ?></em>
							</div>
						</div>
						<div class="summary-wrap">
							<div class="fl title">
								<i>促　　销</i>
							</div>
							<div class="fl fix-width">
								<i class="red-bg">加价购</i>
								<em class="t-gray">满999.00另加20.00元，或满1999.00另加30.00元，或满2999.00另加40.00元，即可在购物车换购热销商品</em>
							</div>
						</div>
					</div>
					<div class="support">
						<div class="summary-wrap">
							<div class="fl title">
								<i>支　　持</i>
							</div>
							<div class="fl fix-width">
								<em class="t-gray">以旧换新，闲置手机回收  4G套餐超值抢  礼品购</em>
							</div>
						</div>
						<div class="summary-wrap">
							<div class="fl title">
								<i>配 送 至</i>
							</div>
							<div class="fl fix-width">
								<em class="t-gray">满999.00另加20.00元，或满1999.00另加30.00元，或满2999.00另加40.00元，即可在购物车换购热销商品</em>
							</div>
						</div>
					</div>
					<div class="clearfix choose">
						<div id="specification" class="summary-wrap clearfix">
							<!--<dl>
								<dt>
									<div class="fl title">
									<i>选择颜色</i>
								</div>
								</dt>
								<dd><a href="javascript:;" class="selected">金色<span title="点击取消选择">&nbsp;</span></a></dd>
								<dd><a href="javascript:;">银色</a></dd>
								<dd><a href="javascript:;">黑色</a></dd>
							</dl>
							<dl>
								<dt>
									<div class="fl title">
									<i>内存容量</i>
								</div>
								</dt>
								<dd><a href="javascript:;" class="selected">16G<span title="点击取消选择">&nbsp;</span></a></dd>
								<dd><a href="javascript:;">64G</a></dd>
								<dd><a href="javascript:;" class="locked">128G</a></dd>
							</dl>
							<dl>
								<dt>
									<div class="fl title">
									<i>选择版本</i>
								</div>
								</dt>
								<dd><a href="javascript:;" class="selected">公开版<span title="点击取消选择">&nbsp;</span></a></dd>
								<dd><a href="javascript:;">移动版</a></dd>							
							</dl>
							<dl>
								<dt>
									<div class="fl title">
									<i>购买方式</i>
								</div>
								</dt>
								<dd><a href="javascript:;" class="selected">官方标配<span title="点击取消选择">&nbsp;</span></a></dd>
								<dd><a href="javascript:;">移动优惠版</a></dd>	
								<dd><a href="javascript:;"  class="locked">电信优惠版</a></dd>
							</dl>
							<dl>
								<dt>
									<div class="fl title">
									<i>套　　装</i>
								</div>
								</dt>
								<dd><a href="javascript:;" class="selected">保护套装<span title="点击取消选择">&nbsp;</span></a></dd>
								<dd><a href="javascript:;"  class="locked">充电套装</a></dd>
							</dl>-->
						</div>
						<div class="summary-wrap">
							<div class="fl">
								<ul class="btn-choose unstyled">
									<li>
										<a href="javascript:addSeckillCart(<?php echo htmlentities($goods['product_id']); ?>)" class="sui-btn  btn-danger addshopcar">加入购物车</a>
										<a href='<?php echo Url("index/center/addinform",["gId"=>$goods["goodsId"]]); ?>' style="text-decoration:none;" class="layui-btn layui-btn-primary" target="_blank">举报</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--product-detail-->
			<div class="clearfix product-detail">
				<div class="fl aside">
					<ul class="sui-nav nav-tabs tab-wraped">
						<li class="active">
							<a href="#index" data-toggle="tab">
								<span>相关商品</span>
							</a>
						</li>
						<li>
							<a href="#profile" data-toggle="tab">
								<span>推荐品牌</span>
							</a>
						</li>
					</ul>
					<div class="tab-content tab-wraped">
						<div id="index" class="tab-pane active">
							<ul class="goods-list unstyled">
								<li>
									<?php $_result=PYGRelatedGoods($goods['goodsCatId']);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<div class="list-wrap" style="text-align: center;">
										<div class="p-img">
											<a  target="_blank" href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>" title="<?php echo htmlentities($vo['goodsName']); ?>"><img style="width: 100px;" src="<?php echo htmlentities($vo['goodsImg']); ?>" /></a>
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
										<div class="operate">
											<a href="javascript:addCart(<?php echo htmlentities($vo['goodsId']); ?>)" class="sui-btn btn-bordered">加入购物车</a>
										</div>
									</div>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</li>
							</ul>
						</div>
						<div id="profile" class="tab-pane">
							<p>推荐品牌</p>
						</div>
					</div>
				</div>
				<div class="fr detail">
					<div class="tab-main intro">
						<ul class="sui-nav nav-tabs tab-wraped">
							<li class="active">
								<a href="#one" data-toggle="tab">
									<span>商品介绍</span>
								</a>
							</li>
							<li>
								<a href="#two" data-toggle="tab">
									<span>规格与包装</span>
								</a>
							</li>
							<li>
								<a href="#three" data-toggle="tab">
									<span>售后保障</span>
								</a>
							</li>
							<li>
								<a href="#four" data-toggle="tab">
									<span>商品评价</span>
								</a>
							</li>
						</ul>
						<div class="clearfix"></div>
						<div class="tab-content tab-wraped">
							<div style="text-align: center;" id="one" class="tab-pane active">
								<?php echo $goods['goodsDesc']; ?>
							</div>
							<div id="two" class="tab-pane">
								<p>规格与包装</p>
							</div>
							<div id="three" class="tab-pane">
								<p>售后保障</p>
							</div>
							<div id="four" class="tab-pane">
								<div class="comment">
									<div class="com-tit">商品评价</div>
									<div class="com-percent">
										<p>好评度 <span class="percent">96%</span></p>
									</div>
									<div class="com-tab-type">
										<ul class="type">
											<li class="current"><a href="javascript:;">全部评价</a></li>
											<!--<li><a href="javascript:;">晒图(500)</a></li>
											<li><a href="javascript:;">追评(500)</a></li>
											<li><a href="javascript:;">好评(500)</a></li>
											<li><a href="javascript:;">中评(500)</a></li>
											<li><a href="javascript:;">差评(500)</a></li>-->
										</ul>
										<div class="content">
											<?php if(is_array($goods['score']['data']) || $goods['score']['data'] instanceof \think\Collection || $goods['score']['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $goods['score']['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
											<input type="hidden" id="scoreId" value="<?php echo htmlentities($vo['id']); ?>">
											<div class="com-item">
												<div class="user-column">
													<div class="username"><!-- <img src="../img/_/photo.jpg"/> --><?php echo htmlentities($vo['loginName']); ?></div>
													
												</div>
												<div class="user-info">
													商品评分 
											<?php if($vo['goodsScore'] == 1): ?>
											111
													<div class="stars"></div>
											<?php elseif($vo['goodsScore'] == 2): ?>
													<div class="stars1"></div>
											<?php elseif($vo['goodsScore'] == 3): ?>
													
													<div class="stars2"></div>
											<?php elseif($vo['goodsScore'] == 4): ?>
													<div class="stars3"></div>
											<?php elseif($vo['goodsScore'] == 5): ?>
													<div class="stars4"></div>
											<?php endif; ?>

											时效评分 
											<?php if($vo['timeScore'] == 1): ?>
											111
													<div class="stars"></div>
											<?php elseif($vo['timeScore'] == 2): ?>
													<div class="stars1"></div>
											<?php elseif($vo['timeScore'] == 3): ?>
													
													<div class="stars2"></div>
											<?php elseif($vo['timeScore'] == 4): ?>
													<div class="stars3"></div>
											<?php elseif($vo['timeScore'] == 5): ?>
													<div class="stars4"></div>
											<?php endif; ?>

											服务评分 
											<?php if($vo['serviceScore'] == 1): ?>
											111
													<div class="stars"></div>
											<?php elseif($vo['serviceScore'] == 2): ?>
													<div class="stars1"></div>
											<?php elseif($vo['serviceScore'] == 3): ?>
													
													<div class="stars2"></div>
											<?php elseif($vo['serviceScore'] == 4): ?>
													<div class="stars3"></div>
											<?php elseif($vo['serviceScore'] == 5): ?>
													<div class="stars4"></div>
											<?php endif; ?>
												
												
													<p><?php echo htmlentities($vo['content']); ?></p>
													<div class="guige">
														<ul class="mini">
															<li>玫瑰金</li>
															<!-- <li>标配版</li> -->
															<li><?php echo htmlentities($vo['createTime']); ?></li>
														</ul>
														
														<div class="clearfix"></div>
													</div>
												</div>
											</div>
											<?php endforeach; endif; else: echo "" ;endif; ?>
						
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--like-->
			<div class="clearfix"></div>
			<div class="like">
				<h4 class="kt">猜你喜欢</h4>
				<div class="like-list">
					<ul class="yui3-g">
						
						<?php $_result=PYGGetIndexLikeGoods();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li class="yui3-u-1-6">
							<div class="list-wrap">
								<div class="p-img">
									<a target="_blank" href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>" title="<?php echo htmlentities($vo['goodsName']); ?>">
									<img src="<?php echo htmlentities($vo['goodsImg']); ?>" /></a>
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