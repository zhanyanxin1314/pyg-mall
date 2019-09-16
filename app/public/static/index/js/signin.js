//签到
$(function(){
	 $("#sign_area").hover(function() {
                if ($("#btn_not_sign").css("display") == 'none') {
                    $("#sign_box").show();
                }
            }, function() {
                $("#sign_box").hide();
            })
})

//开始签到
function sign_day() {

	$.post('/index/sign/userSign',function(data,textStatus){
		
		if(data.code == 2){
			layer.msg(data.result);
		} else {
			layer.msg(data.result);
			return;
		}
        $("#sign_days").text(data.days);
        $("#btn_not_sign").hide();
        $("#btn_has_sign").css({"display": "block"});
        $('.today').addClass("isSigned");
        $("#sign_tip").html(data.sign_tip);
        $("#sign_tip1").html(data.sign_tip1);
	});
}