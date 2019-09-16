//typ
function login(){
	var params = getParams('.ipt');
	if($('#loginName').val() == ''){
		layer.msg('手机号不能为空',{icon:2});
		return;
	} else if (!(/^1[3456789]\d{9}$/.test($('#loginName').val()))){
		layer.msg('手机号格式不正确!',{icon:2});
		return;
	} else if ($('#loginPwd').val() == ''){
		layer.msg('密码不能为空!',{icon:2});
		return;
	} else {
		$('#loginNameSpan').hide();
		$('#loginPwdSpan').hide();
	}
	$.post('/index/users/checkLogin',params,function(data,textStatus){
		var json = toJson(data);
		var url = json.url;
		if(json.status=='1'){
			layer.msg('登陆成功',{icon:1});
			if(url != undefined){
                location.href=url;
			}else{
				location.href='/';
			}
		} else {
			layer.msg(json.msg, {icon: 5});
		}
		
	});
	return true;
}

function showProtocol(){
	layer.open({
	    type: 2,
	    title: '用户注册协议',
	    shadeClose: true,
	    shade: 0.8,
	    area: ['1000px', ($(window).height() - 50) +'px'],
	    content: ['/index/users/protocol'],
	    btn: ['同意并注册'],
	    yes: function(index, layero){
	    	layer.close(index);
	    }
	});
}

function initRegist(){
	// 阻止按下回车键时触发短信验证码弹窗
	document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];        
             if(e && e.keyCode==13){ // enter 键
             	$('#reg_butt').submit();
             	return false;
            }
    }
	var params = getParams('.wst_ipt');
	if($('#loginName').val() == ''){
		$('#loginNameSpan').show();
		$('#loginNameSpan').html('手机号不能为空!')
		return;
	} else if (!(/^1[3456789]\d{9}$/.test($('#loginName').val()))){
		$('#loginNameSpan').show();
		$('#loginNameSpan').html('手机号格式错误!')
		return;
	} else if ($('#loginPwd').val() == ''){
		$('#loginPwdSpan').show();
		$('#loginNameSpan').hide();
		$('#loginPwdSpan').html('密码不能为空!')
		return;
	} else if ($('#reUserPwd').val() == ''){
		$('#reUserPwdSpan').show();
		$('#loginPwdSpan').hide();
		$('#reUserPwdSpan').html('确认密码不能为空!')
		return;
	} else if ($('#loginPwd').val() != $('#reUserPwd').val()){
		$('#reUserPwdSpan').show();
		$('#reUserPwdSpan').html('两次密码不一样!')
		return;
	} else {
		$('#loginNameSpan').hide();
		$('#loginPwdSpan').hide();
		$('#reUserPwdSpan').hide();
	}
	$("#reg_butt").css('color', '#999').text('正在提交..');
	$.post('/index/users/toRegist',params,function(data,textStatus){
		var json = toJson(data);
		if(json.status>0){
			layer.msg('注册成功，正在跳转登录!', {icon: 1}, function(){
	        		location.href='/';
				});
		} else {
			layer.msg(json.msg, {icon: 5});
		}
	});
}