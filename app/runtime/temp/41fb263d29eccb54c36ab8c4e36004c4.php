<?php /*a:4:{s:76:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\index\index.html";i:1564448309;s:71:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\layout.html";i:1563936177;s:68:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\top.html";i:1563935465;s:73:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\sign_box.html";i:1563952034;}*/ ?>
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
	
	

<style type="text/css">

    .vad { margin: 120px 0 5px; font-family: Consolas,arial,宋体,sans-serif; text-align:center;}
    .vad a { display: inline-block; height: 36px; line-height: 36px; margin: 0 5px; padding: 0 50px; font-size: 14px; text-align:center; color:#eee; text-decoration: none; background-color: #222;}
    .vad a:hover { color: #fff; background-color: #000;}
    .thead { width: 728px; height: 90px; margin: 0 auto; border-bottom: 40px solid #fff;}

</style>
<link rel="stylesheet" href="/static/index/css/public.css" />
<link rel="stylesheet" href="/static/index/css/signin.css" />

	
<script src="/static/index/js/signin.js"></script>

	
</body>
	<div class="sort">
		<div class="py-container">
			<div class="yui3-g SortList ">
				<div class="yui3-u Left all-sort-list">
					<div class="all-sort-list2">
					<?php $_result=PYGSideCategorys();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
						<div class="item bo">
							<h3><a href="<?php echo Url('index/goods/lists','cat='.$vo['catId']); ?>" target="_blank"><?php echo htmlentities($vo['catName']); ?></a></h3>
							<div class="item-list clearfix">
								<div class="subitem">
									<?php if(is_array($vo['list']) || $vo['list'] instanceof \think\Collection || $vo['list'] instanceof \think\Paginator): $k1 = 0; $__LIST__ = $vo['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k1 % 2 );++$k1;?>
									<dl class="fore1">
										<dt><a href="<?php echo Url('index/goods/lists','cat='.$vo1['catId']); ?>" target="_blank"><?php echo htmlentities($vo1['catName']); ?></a></dt>
										<dd>
											<?php if(is_array($vo1['list']) || $vo1['list'] instanceof \think\Collection || $vo1['list'] instanceof \think\Paginator): $k2 = 0; $__LIST__ = $vo1['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2;?>
											<em><a href="<?php echo Url('index/goods/lists','cat='.$vo2['catId']); ?>" target="_blank"><?php echo htmlentities($vo2['catName']); ?></a></em>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</dd>
									</dl>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									
								</div>
							</div>
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				<div class="yui3-u Center banerArea" style="z-index: 1">
				
					<!--banner轮播-->
					<div id="myCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
						</ol>
							
						<div class="carousel-inner">
					
							<div class="active item">
								<?php $_result=PYGGetIndexAds();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
									<a href="<?php echo htmlentities($vo['adURL']); ?>">
							    	<img src="<?php echo htmlentities($vo['adFile']); ?>"  />
							      	</a>
						      	<?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						
						</div>

						<a href="#myCarousel" data-slide="prev" class="carousel-control left">‹</a><a href="#myCarousel" data-slide="next"
						 class="carousel-control right">›</a>
						 
					</div>

				</div>
				<div class="yui3-u Right">
					<div class="news">
					   <div class="sign_area">
					        <div class="info">
					            <div class="m-checkin-btn-box" id='sign_area'>

					                <a href="javascript:;"<?php if($sign_info['num'] > 0): ?>style='display:block'<?php endif; ?> class="u-btn u-btn-checkin-end" id="btn_has_sign"><span class="u-icon u-icon-succ1 f-vam"></span>&nbsp;已连续签到<span id="sign_days"><?php echo htmlentities($sign_info['num']); ?></span>天</a>

					                <a href="javascript:;" <?php if($sign_info['num'] == 0): ?>style='display:block'<?php endif; ?> class="u-btn  u-btn-checkin" id="btn_not_sign" onclick="sign_day($(this))">签到领取积分</a>
									<div class="m-checkinCalendarPrompt-box" id="sign_box" style='display: none'>
    <div class="m-checkinCalendarPrompt">
        <span class="u-icon u-icon-arrowup"></span>
        <div class="m-checkinCalendarPrompt-tip">
            <span>连续签到有更多惊喜哦</span>
        </div>
        <div class="m-checkinCalendar">
            <div class="calendar-hd">
                <span class="before"></span>
                <span><?php echo htmlentities($today); ?></span>
            </div>
            <div class="calendar-bd">
                <div class="calendar-week-box">
                    <span class="calendar-week">日</span>
                    <span class="calendar-week">一</span>
                    <span class="calendar-week">二</span>
                    <span class="calendar-week">三</span>
                    <span class="calendar-week">四</span>
                    <span class="calendar-week">五</span>
                    <span class="calendar-week last">六</span>
                </div>
                <div class="calendar-days">
                    <?php if(is_array($canlendars) || $canlendars instanceof \think\Collection || $canlendars instanceof \think\Paginator): if( count($canlendars)==0 ) : echo "" ;else: foreach($canlendars as $key=>$row): ?>
                        <div class="calendar-day-box <?php echo htmlentities(is_in_array($row['date'],$signs_dates,'isSigned')); if($row['date'] == $today): ?>today<?php endif; if($row['num'] <= 0 or $row['num'] > $days): ?>no-nowMonth-day<?php endif; ?>">
                            <span class="before"></span>
                            <p class="calendar-day"><?php echo htmlentities($row['day']); ?></p>
                            <span class="after"></span>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

					       
					            </div>
					            <p class="m-checkin-tip-box" style="margin:4px 0 0" id='sign_tip'><?php echo htmlentities($sign_tip); ?></p>
					             <p class="m-checkin-tip-box" style="margin:4px 0 0" id='sign_tip1'><?php echo htmlentities($sign_tip1); ?></p>
					        </div>
					    </div> 
					</div>
					<ul class="yui3-g Lifeservice">
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-5"></i>
							<span class="service-intro"></span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-5"></i>
							<span class="service-intro">彩票</span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-5"></i>
							<span class="service-intro">彩票</span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-5"></i>
							<span class="service-intro">彩票</span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-5"></i>
							<span class="service-intro">彩票</span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-6"></i>
							<span class="service-intro">加油站</span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-7"></i>
							<span class="service-intro">酒店</span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-8"></i>
							<span class="service-intro">火车票</span>
						</li>
						<li class="yui3-u-1-4 life-item  notab-item">
							<i class="list-item list-item-9"></i>
							<span class="service-intro">众筹</span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-10"></i>
							<span class="service-intro">理财</span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-11"></i>
							<span class="service-intro">礼品卡</span>
						</li>
						<li class="yui3-u-1-4 life-item notab-item">
							<i class="list-item list-item-12"></i>
							<span class="service-intro">白条</span>
						</li>
					</ul>
					<div class="life-item-content">
						<div class="life-detail">
							<i class="close">关闭</i>
							<p>话费充值</p>
							<form action="" class="sui-form form-horizontal">
								号码：<input type="text" id="inputphoneNumber" placeholder="输入你的号码" />
							</form>
							<button class="sui-btn btn-danger">快速充值</button>
						</div>
					
					</div>
					<div class="ads">
						<img src="/static/index/img/ad1.png" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--推荐-->
	<div class="show">
		<div class="py-container">
			<ul class="yui3-g Recommend">
				<li class="yui3-u-1-6  clock">
					<div class="time">
						<img src="/static/index/img/clock.png" />
						<h3>今日推荐</h3>
					</div>
				</li>
				<?php $_result=PYGGetIndexRemendGoods();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
				<li class="yui3-u-5-24">
					<a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>" title="<?php echo htmlentities($vo['goodsName']); ?>" target="_blank"><img style="width: 248px;height: 163px;" src="<?php echo htmlentities($vo['goodsImg']); ?>" /></a>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div>
	<!-- 商品排行 -->
	<div class="py-container tabbox">
		<div class="py-container tab">
			<div class="tab-tit" style="text-align:center">
					<a href="javascript:;" class="on">
							<p class="img"><i></i></p>
							<p class="text">热卖排行</p>
						</a>
						<a href="javascript:;">
							<p class="img"><i></i></p>
							<p class="text">特价排行</p>
						</a>
						<a href="javascript:;">
							<p class="img"><i></i></p>
							<p class="text">新品排行</p>
						</a>
			</div>
		</div>
		<div class="content">
			<ul>
				<li style="display:block;">
					<?php $_result=PYGGetIndexHotGoods();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
					<div class="img-item">
						<p class="tab-pic">
							<span><a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>"><img src="<?php echo htmlentities($vo['goodsImg']); ?>"/></a></span>
						</p>
						<div class="tab-info">
							<div class="info-title">
								<span><a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>"><?php echo htmlentities($vo['goodsName']); ?></a></span>
							</div>
							<p class="info-price">定金：¥<?php echo htmlentities($vo['marketPrice']); ?></p>
						</div>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</li>
				<li>
					<?php $_result=PYGGetIndexBestGoods();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
					<div class="img-item">
						<p class="tab-pic">
							<span><a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>"><img src="<?php echo htmlentities($vo['goodsImg']); ?>"/></a></span>
						</p>
						<div class="tab-info">
							<div class="info-title">
								<span><a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>"><?php echo htmlentities($vo['goodsName']); ?></a></span>
							</div>
							<p class="info-price">定金：¥<?php echo htmlentities($vo['marketPrice']); ?></p>
						</div>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</li>
				<li>
					<?php $_result=PYGGetIndexNewGoods();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
					<div class="img-item">
						<p class="tab-pic">
							<span><a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>"><img src="<?php echo htmlentities($vo['goodsImg']); ?>"/></a></span>
						</p>
						<div class="tab-info">
							<div class="info-title">
								<span><a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>"><?php echo htmlentities($vo['goodsName']); ?></a></span>
							</div>
							<p class="info-price">定金：¥<?php echo htmlentities($vo['marketPrice']); ?></p>
						</div>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</li>
			</ul>
		</div>
	</div>
	<!--喜欢-->
	<div class="like">
		<div class="py-container">
			<div class="title">
				<h3 class="fl">猜你喜欢</h3>
				<b class="border"></b>
				<a href="javascript:;" class="fr tip changeBnt" onclick="like();"><i></i>换一换</a>
			</div>
			<div class="bd">
				<ul class="clearfix yui3-g Favourate picLB"  id="picLBxxl">
					<?php $_result=PYGGetIndexLikeGoods();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
					<li class="yui3-u-1-6">
						<dl class="picDl huozhe">
							<dd>
								<a href="<?php echo Url('index/goods/detail','goodsId='.$vo['goodsId']); ?>" class="pic" title="<?php echo htmlentities($vo['goodsName']); ?>"><img src="<?php echo htmlentities($vo['goodsImg']); ?>" alt="" /></a>
								<div class="like-text" >
									<p style="height:50px"><?php echo htmlentities(mb_substr($vo['goodsName'],0,35,'utf-8')); ?></p>
									<h3>¥<?php echo htmlentities($vo['marketPrice']); ?></h3>
								</div>
							</dd>
						</dl>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<!--有趣-->
	<div class="fun">
		<div class="py-container">
			<div class="title">
				<h3 class="fl">传智播客.有趣区</h3>
			</div>
			<div class="clearfix yui3-g Interest">
				<span class="x-line"></span>
				<div class="yui3-u row-405 Interest-conver">
					<?php $_result=PYGGetIndexYqLeftAds();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
					<a href="<?php echo htmlentities($vo['adURL']); ?>" target="_blank"><img style="width: <?php echo htmlentities($vo['positionWidth']); ?>;height: <?php echo htmlentities($vo['positionHeight']); ?>" src="<?php echo htmlentities($vo['adFile']); ?>" /></a>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="yui3-u row-225 Interest-conver-split">
					<h5>好东西</h5>
					<?php $_result=PYGGetIndexYqHdxAds();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
					<a href="<?php echo htmlentities($vo['adURL']); ?>" target="_blank"><img src="<?php echo htmlentities($vo['adFile']); ?>" /></a>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="yui3-u row-405 Interest-conver-split blockgary">
					<h5>品牌街</h5>
					<div class="split-bt">
						<img src="/static/index/img/interest04.png" />
					</div>
					<div class="x-img fl">
						<img src="/static/index/img/interest05.png" />
					</div>
					<div class="x-img fr">
						<img src="/static/index/img/interest06.png" />
					</div>
				</div>
				<div class="yui3-u row-165 brandArea">
					<span class="brand-yline"></span>
					<ul class="yui3-g brand-list">
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand01.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand02.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand03.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand04.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand05.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand06.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand07.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand08.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand09.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand10.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand11.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand12.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand13.png" /></li>
						<li class="yui3-u-1-2 brand-pit"><img src="/static/index/img/brand03.png" /></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--楼层-->
	<div id="floor-1" class="floor">
		<div class="py-container">
			<div class="title floors">
				<h3 class="fl">家用电器</h3>
				<div class="fr">
					<ul class="sui-nav nav-tabs">
						<li class="active">
							<a href="#tab1" data-toggle="tab">热门</a>
						</li>
						<li>
							<a href="#tab2" data-toggle="tab">大家电</a>
						</li>
						<li>
							<a href="#tab3" data-toggle="tab">生活电器</a>
						</li>
						<li>
							<a href="#tab4" data-toggle="tab">厨房电器</a>
						</li>
						<li>
							<a href="#tab5" data-toggle="tab">应季电器</a>
						</li>
						<li>
							<a href="#tab6" data-toggle="tab">空气/净水</a>
						</li>
						<li>
							<a href="#tab7" data-toggle="tab">高端电器</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="clearfix  tab-content floor-content">
				<div id="tab1" class="tab-pane active">
					<div class="yui3-g Floor-1">
						<div class="yui3-u Left blockgary">
							<ul class="jd-list">
								<li>节能补贴</li>
								<li>4K电视</li>
								<li>空气净化器</li>
								<li>IH电饭煲</li>
								<li>滚筒洗衣机</li>
								<li>电热水器</li>
							</ul>
							<img src="/static/index/img/floor-1-1.png" />
						</div>
						<div class="yui3-u row-330 floorBanner">
							<div id="floorCarousel" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
								<ol class="carousel-indicators">
									<li data-target="#floorCarousel" data-slide-to="0" class="active"></li>
									<li data-target="#floorCarousel" data-slide-to="1"></li>
									<li data-target="#floorCarousel" data-slide-to="2"></li>
								</ol>
								<div class="carousel-inner">
									<div class="active item">
										<img src="/static/index/img/floor-1-b01.png">
									</div>
									<div class="item">
										<img src="/static/index/img/floor-1-b02.png">
									</div>
									<div class="item">
										<img src="/static/index/img/floor-1-b03.png">
									</div>
								</div>
								<a href="#floorCarousel" data-slide="prev" class="carousel-control left">‹</a>
								<a href="#floorCarousel" data-slide="next" class="carousel-control right">›</a>
							</div>
						</div>
						<div class="yui3-u row-220 split">
							<span class="floor-x-line"></span>
							<div class="floor-conver-pit">
								<img src="/static/index/img/floor-1-2.png" />
							</div>
							<div class="floor-conver-pit">
								<img src="/static/index/img/floor-1-3.png" />
							</div>
						</div>
						<div class="yui3-u row-218 split">
							<img src="/static/index/img/floor-1-4.png" />
						</div>
						<div class="yui3-u row-220 split">
							<span class="floor-x-line"></span>
							<div class="floor-conver-pit">
								<img src="/static/index/img/floor-1-5.png" />
							</div>
							<div class="floor-conver-pit">
								<img src="/static/index/img/floor-1-6.png" />
							</div>
						</div>
					</div>
				</div>
				<div id="tab2" class="tab-pane">
					<p>第二个</p>
				</div>
				<div id="tab3" class="tab-pane">
					<p>第三个</p>
				</div>
				<div id="tab4" class="tab-pane">
					<p>第4个</p>
				</div>
				<div id="tab5" class="tab-pane">
					<p>第5个</p>
				</div>
				<div id="tab6" class="tab-pane">
					<p>第6个</p>
				</div>
				<div id="tab7" class="tab-pane">
					<p>第7个</p>
				</div>
			</div>
		</div>
	</div>
	<div id="floor-2" class="floor">
		<div class="py-container">
			<div class="title floors">
				<h3 class="fl">手机通讯</h3>
				<div class="fr">
					<ul class="sui-nav nav-tabs">
						<li class="active">
							<a href="#tab8" data-toggle="tab">热门</a>
						</li>
						<li>
							<a href="#tab9" data-toggle="tab">品质优选</a>
						</li>
						<li>
							<a href="#tab10" data-toggle="tab">新机尝鲜</a>
						</li>
						<li>
							<a href="#tab11" data-toggle="tab">高性价比</a>
						</li>
						<li>
							<a href="#tab12" data-toggle="tab">合约机</a>
						</li>
						<li>
							<a href="#tab13" data-toggle="tab">手机卡</a>
						</li>
						<li>
							<a href="#tab14" data-toggle="tab">手机配件</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="clearfix  tab-content floor-content">
				<div id="tab8" class="tab-pane active">
					<div class="yui3-g Floor-1">
						<div class="yui3-u Left blockgary">
							<ul class="jd-list">
								<li>节能补贴</li>
								<li>4K电视</li>
								<li>空气净化器</li>
								<li>IH电饭煲</li>
								<li>滚筒洗衣机</li>
								<li>电热水器</li>
							</ul>
							<img src="/static/index/img/floor-1-1.png" />
						</div>
						<div class="yui3-u row-330 floorBanner">
							<div id="floorCarousell" data-ride="carousel" data-interval="4000" class="sui-carousel slide">
								<ol class="carousel-indicators">
									<li data-target="#floorCarousell" data-slide-to="0" class="active"></li>
									<li data-target="#floorCarousell" data-slide-to="1"></li>
									<li data-target="#floorCarousell" data-slide-to="2"></li>
								</ol>
								<div class="carousel-inner">
									<div class="active item">
										<img src="/static/index/img/floor-1-b01.png">
									</div>
									<div class="item">
										<img src="/static/index/img/floor-1-b02.png">
									</div>
									<div class="item">
										<img src="/static/index/img/floor-1-b03.png">
									</div>
								</div>
								<a href="#floorCarousell" data-slide="prev" class="carousel-control left">‹</a>
								<a href="#floorCarousell" data-slide="next" class="carousel-control right">›</a>
							</div>
						</div>
						<div class="yui3-u row-220 split">
							<span class="floor-x-line"></span>
							<div class="floor-conver-pit">
								<img src="/static/index/img/floor-1-2.png" />
							</div>
							<div class="floor-conver-pit">
								<img src="/static/index/img/floor-1-3.png" />
							</div>
						</div>
						<div class="yui3-u row-218 split">
							<img src="/static/index/img/floor-1-4.png" />
						</div>
						<div class="yui3-u row-220 split">
							<span class="floor-x-line"></span>
							<div class="floor-conver-pit">
								<img src="/static/index/img/floor-1-5.png" />
							</div>
							<div class="floor-conver-pit">
								<img src="/static/index/img/floor-1-6.png" />
							</div>
						</div>
					</div>
				</div>
				<div id="tab2" class="tab-pane">
					<p>第二个</p>
				</div>
				<div id="tab9" class="tab-pane">
					<p>第三个</p>
				</div>
				<div id="tab10" class="tab-pane">
					<p>第4个</p>
				</div>
				<div id="tab11" class="tab-pane">
					<p>第5个</p>
				</div>
				<div id="tab12" class="tab-pane">
					<p>第6个</p>
				</div>
				<div id="tab13" class="tab-pane">
					<p>第7个</p>
				</div>
				<div id="tab14" class="tab-pane">
					<p>第8个</p>
				</div>
			</div>
		</div>
	</div>
	<!--商标-->
	<div class="brand">
		<div class="py-container">
			<ul class="Brand-list blockgary">
				<li class="Brand-item">
					<img src="/static/index/img/brand_21.png" />
				</li>
				<li class="Brand-item"><img src="/static/index/img/brand_03.png" /></li>
				<li class="Brand-item"><img src="/static/index/img/brand_05.png" /></li>
				<li class="Brand-item"><img src="/static/index/img/brand_07.png" /></li>
				<li class="Brand-item"><img src="/static/index/img/brand_09.png" /></li>
				<li class="Brand-item"><img src="/static/index/img/brand_11.png" /></li>
				<li class="Brand-item"><img src="/static/index/img/brand_13.png" /></li>
				<li class="Brand-item"><img src="/static/index/img/brand_15.png" /></li>
				<li class="Brand-item"><img src="/static/index/img/brand_17.png" /></li>
				<li class="Brand-item"><img src="/static/index/img/brand_19.png" /></li>
			</ul>
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