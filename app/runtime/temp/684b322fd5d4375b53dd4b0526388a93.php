<?php /*a:3:{s:76:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\users\login.html";i:1560911439;s:71:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\layout.html";i:1563936177;s:68:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\top.html";i:1563935465;}*/ ?>
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
	
	
<link rel="stylesheet" type="text/css" href="/static/index/css/pages-login.css" />
<link rel="stylesheet" type="text/css" href="/static/index/css/captcha.css" />

	
<script src="/static/libs/validator/jquery.validator.min.js"></script>
<script  src="/static/index/js/login.js"></script>
<script  src="/static/index/js/clicaptcha.js"></script>

	
	<div class="login-box">
		<!--loginArea-->
		<div class="loginArea">
			<div class="py-container login">
				<div class="loginform">
					<ul class="sui-nav nav-tabs tab-wraped">
						<li>
							<a href="#index" data-toggle="tab">
								<h3>扫描登录</h3>
							</a>
						</li>
						<li class="active">
							<a href="#profile" data-toggle="tab">
								<h3>账户登录</h3>
							</a>
						</li>
					</ul>
					<div class="tab-content tab-wraped">
						<div id="index" class="tab-pane">
							<p>暂未开通</p>
						</div>
						<div id="profile" class="tab-pane  active">
							<form class="sui-form" method="post">
								<div class="input-prepend"><span class="add-on loginname"></span>
									<input id="loginName" name="loginName" type="text" required  lay-verify="required" placeholder="邮箱/用户名/手机号" value="<?php echo htmlentities($loginName); ?>" class="ipt span2 input-xfat">
								</div>
								<span style="display:none;color:red;" id="loginNameSpan"></span>
								<div class="input-prepend"><span class="add-on loginpwd"></span>
									<input id="loginPwd" name="loginPwd" type="password" data-rule="密码: required;" data-msg-required="请填写密码" data-tip="请输入密码" placeholder="密码" class="ipt span2 input-xfat">
								</div>
								<span style="display:none;color:red;" id="loginPwdSpan"></span>

								<input type="hidden" id="clicaptcha-submit-info" name="clicaptcha-submit-info">
								<div class="setting">
									<label class="checkbox inline">
							          <input name="m1" type="checkbox" value="2" checked=""> 
							          自动登录
							        </label>
									<span class="forget">忘记密码？</span>
								</div>
								<div class="logined">
									<a class="sui-btn btn-block btn-xlarge btn-danger" href="javascript:void(0);" onclick='javascript:login()'>登&nbsp;&nbsp;录</a>
								</div>
							</form>
							<div class="otherlogin">
								<div class="types">
									<ul>
										<li><img src="/static/index/img/qq.png" width="35px" height="35px" /></li>
										<li><img src="/static/index/img/sina.png" /></li>
										<li><img src="/static/index/img/ali.png" /></li>
										<li><img src="/static/index/img/weixin.png" /></li>
									</ul>
								</div>
								<span class="register"><a href="<?php echo Url('index/users/regist'); ?>">立即注册</a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--foot-->
		<div class="py-container copyright">
			<ul>
				<li>关于我们</li>
				<li>联系我们</li>
				<li>联系客服</li>
				<li>商家入驻</li>
				<li>营销中心</li>
				<li>手机品优购</li>
				<li>销售联盟</li>
				<li>品优购社区</li>
			</ul>
			<div class="address">地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</div>
			<div class="beian">京ICP备08001421号京公网安备110108007702
			</div>
		</div>
	</div>


</body>
</html>