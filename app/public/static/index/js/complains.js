
//提交投诉
function saveComplain(historyURL){
   /* 表单验证 */
  $('#complainForm').validator({
              fields: {
                  complainContent: {
                    rule:"required",
                    msg:{required:"清输入投诉内容"},
                    tip:"清输入投诉内容",
                  },
                  complainType: {
                    rule:"checked;",
                    msg:{checked:"投诉类型不能为空"},
                    tip:"请选择投诉类型",
                  }
                  
              },
            valid: function(form){
              	var params = getParams('.ipt');
              	var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
                $.post('/index/center/saveComplain',params,function(data,textStatus){
                    layer.close(loading);
                    var json = toJson(data);
                    if(json.status=='1'){
                        layer.msg('您的投诉已提交，请留意信息回复', {icon: 6},function(){
                        location.href = '/complains.html';
                       });
                    } else {
                        layer.msg(json.msg,{icon:2});
                    }
                });
        	}
  		});
	}

//用户查投诉详情
function toView(id){
  location.href='index/center/getUserComplainDetail?id='+id;
}