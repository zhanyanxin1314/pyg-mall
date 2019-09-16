//对比商品
$(function(){
	var scoreId = $('#scoreId').val();
	var test1 = $('.test-'+ scoreId).text();

	layui.use(['rate'], function(){
	  var rate = layui.rate;
	  //基础效果
	  rate.render({
	    elem: '.test-'+scoreId,
	    value:test1,
	    readonly: true
	  }),
	   rate.render({
	    elem: '.test-'+scoreId,
	    readonly: true
	  }),
	    rate.render({
	    elem: '.test-'+scoreId,
	    readonly: true
	  })
    })
})
function contrastGoods(show,id,type){
	if(show==1){
		$.post('/index/goods/contrastGoods',{id:id},function(data,textStatus){
			var json = toJson(data);
			if(json.status==1){
				if(type==2 && json.data)$("#j-cont-frame").addClass('show');
				var gettpl = document.getElementById('colist').innerHTML;
				laytpl(gettpl).render(json, function(html){
					$('#contrastList').html(html);
				});
				$('.contImg').lazyload({ effect: "fadeIn",failurelimit : 10,skip_invisible : false,threshold: 200,placeholder:''});//商品默认图片
			}else{
				layer.msg(json.msg,{icon:2});
			}
			if(type==1)$("#j-cont-frame").addClass('show');
		});
	}else{
		$("#j-cont-frame").removeClass('show');
	}
}

//删除多个对比商品
function contrastDels(id){
	$.post('/index/goods/contrastDel',{id:id},function(data,textStatus){
		var json = toJson(data);
		if(json.status==1){
			contrastGoods(1,0,1);
		}
	});
}

//删除单个对比商品
function contrastDel(id){
	$.post('/index/goods/contrastDel',{id:id},function(data,textStatus){
		var json = toJson(data);
		if(json.status==1){
			location.href='/index/goods/contrast';
		}
	});
}

//添加购物车
function addCart(goodsId,iptId){
	if(window.conf.IS_LOGIN==0){
		loginWindow();
		return;
	}
	var buyNum = $(iptId)[0]?$(iptId).val():1;
	$.post('/index/carts/addCart',{goodsId:goodsId,buyNum:buyNum,rnd:Math.random()},function(data,textStatus){
	     var json = toJson(data);
	     if(json.status==1){
	    	 layer.msg(json.msg,{icon:1});
	     } else {
	    	 layer.msg(json.msg,{icon:2});
	     }
	});
}

//添加购物车 - 秒杀页面
function addSeckillCart(goodsId,iptId){
	if(window.conf.IS_LOGIN==0){
		loginWindow();
		return;
	}
	var buyNum = $(iptId)[0]?$(iptId).val():1;

	$.post('/index/carts/addSeckillCart',{goodsId:goodsId,buyNum:buyNum,rnd:Math.random()},function(data,textStatus){
	     var json = toJson(data);
	     
	     if(json.status==1){
	    	 layer.msg(json.msg,{icon:1});
	     } else {
	    	 layer.msg(json.msg,{icon:2});
	     }
	});
}

//删除购物车
delCart = function(id){

		    layer.confirm('您确定要删除该商品吗？', {icon: 3, title:'提示'}, function(index){
          	var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
          	$.post('/index/carts/delCart',{id:id,rnd:Math.random()},function(data,textStatus){
                layer.close(loading);
                 var json = toJson(data);
                if (json.status == 1) {
                    layer.msg(json.msg,{icon:1});
                    location.href='cart';
                } else {
                    layer.msg(json.msg,{icon:2});
                }
            });
        });

}

//添加/修改收货地址
function editAddress(){
	
	var params = getParams('.j-eipt');
	if(params.userName == ''){
		 layer.msg('收货人不能为空！',{icon:2});
		 return;
	}
	if(params.userAddress == ''){
		 layer.msg('收货人地址不能为空！',{icon:2});
		 return;
	}
	if(params.userPhone == ''){
		 layer.msg('收货人电话不能为空！',{icon:2});
		 return;
	}
	var load = layer.load({msg:'正在提交数据，请稍后...'});
	$.post('/index/useraddress/'+((params.addressId>0)?'toEdit':'add'),params,function(data,textStatus){
		layer.close(load);
		var json = toJson(data);
	     if(json.status==1){
	     	$('.modal-dialog').hide();
			layer.msg('新增成功',{icon:1});
			location.reload();
	    	if(params.addressId==0){
	    		$('#s_addressId').val(json.data.addressId);
	    	} else {
	    		$('#s_addressId').val(params.addressId);
	    	}
	     } else {
	    	 layer.msg(json.msg,{icon:2});
	     }
	});
}