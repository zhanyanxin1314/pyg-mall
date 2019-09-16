//支付方式
function changeSelected(n,index,obj){

	$('#'+index).val(n);
	inEffect(obj,2);
}

//支付方式切换
function inEffect(obj,n){
	$(obj).addClass('j-selected').siblings('.pyg-frame'+n).removeClass('j-selected');
}

//购物车提交订单
function submitOrder(){
	var params = getParams('.j-ipt');
	var load = layer.load({msg:'正在提交，请稍后...'});
	$.post('/index/carts/submit',params,function(data,textStatus){
		layer.close(load);   
		var json = toJson(data);
	    if(json.status==1){
	    	 layer.msg(json.msg,{icon:1},function(){
	    		 location.href='/index/orders/succeed?orderNo='+json.data;
	    	 });
	    }else{
	    	layer.msg(json.msg,{icon:2});
	    }
	});
}

// //用户中心-用户永久删除订单
// function toDel(id){

//       layer.confirm('您确定要删除该订单吗11', {icon: 3, title:'提示'}, function(index){
//       var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
//       $.post('/index/center/delOrder',{id:id},function(data,textStatus){
//                 layer.close(loading);
//                 if(data.status==1){
//                     layer.msg(data.msg,{icon:1});
//                 } else {
//                     layer.msg(data.msg,{icon:2});
//                 }
//           });
//     });
// }