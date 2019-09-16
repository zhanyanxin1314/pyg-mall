<?php /*a:1:{s:80:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\index\view\users\box_login.html";i:1559532156;}*/ ?>


<style type="text/css">
	.ui-dialog{ 
		width: 532px;height: auto;
		position: absolute;z-index: 9000;
		top: 0px;left: 0px;
		
	}

	.ui-dialog a{text-decoration: none;}

	.ui-dialog-title{
		height: 48px;line-height: 48px; padding:0px 20px;color: #535353;font-size: 16px;
		border-bottom: 1px solid #efefef;background: #f5f5f5;
		cursor: move;
		user-select:none;
	}
	.ui-dialog-closebutton{
		width: 16px;height: 16px;display: block;
		position: absolute;top: 12px;right: 20px;
		background: url(images/close_def.png) no-repeat;cursor: pointer;

	}
	.ui-dialog-closebutton:hover{background:url(images/close_hov.png);}

	.ui-dialog-content{
		padding: 15px 20px;
	}
	.ui-dialog-pt15{
		padding-top: 15px;
	}
	.ui-dialog-l40{
		height: 40px;line-height: 40px;
		text-align: right;
	}

	.ui-dialog-input{
		width: 100%;height: 40px;
		margin: 0px;padding:0px;
		border: 1px solid #d5d5d5;
		font-size: 16px;color: #c1c1c1;
		text-indent: 25px;
		outline: none;
	}
	.ui-dialog-input-username{
		background: url(images/input_username.png) no-repeat 2px ;
	}

	.ui-dialog-input-password{
		background: url(images/input_password.png) no-repeat 2px ;
	}
	.ui-dialog-submit{
		width: 100%;height: 50px;background: #3b7ae3;border:none;font-size: 16px;color: #fff;
		outline: none;text-decoration: none;
		display: block;text-align: center;line-height: 50px;
	}
	.ui-dialog-submit:hover{
		background: #3f81b0;
	}

	.ui-mask{ 
		width: 100%;height:100%;background: #000;
		position: absolute;top: 0px;height: 0px;z-index: 8000;
		opacity:0.4; filter: Alpha(opacity=40);
	}
</style>


<script  src="/static/index/js/login.js"></script>

<div class="ui-dialog" id="dialogMove" onselectstart='return false;'>
<form class="sui-form" method="post">
	<div class="ui-dialog-content">
		<div class="ui-dialog-l40 ui-dialog-pt15">
			<input class="ipt ui-dialog-input ui-dialog-input-username" id="loginName" name="loginName" type="input" placeholder="手机/邮箱/用户名" />
		</div>
		<span style="color:red;display: none;" id="loginNameSpan"></span>
		<div class="ui-dialog-l40 ui-dialog-pt15">
			<input class="ipt ui-dialog-input ui-dialog-input-password" id="loginPwd" name="loginPwd" type="input" placeholder="密码" />
		</div>
		<span style="color:red;display: none;" id="loginPwdSpan"></span>
		<div style="margin-top: 10px;">
			<a class="ui-dialog-submit" href="javascript:void(0);" onclick='javascript:login()' >登录</a>
		</div>
		<div class="ui-dialog-l40">
			<a href="<?php echo Url('index/users/regist'); ?>" target="_blank">立即注册</a>
		</div>
	</div>
</div>
</form>