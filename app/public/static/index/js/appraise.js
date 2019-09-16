$(function(){
	layui.use(['rate'], function(){
	var rate = layui.rate;
	
	//商品评分
	rate.render({
	    elem: '#goodsScore1'
	    ,value: 3
	    ,text: true
	    ,setText: function(value){ //自定义文本的回调
	      var arrs = {
	         '1': '极差'
	        ,'2': '差'
	        ,'3': '中等'
	        ,'4': '好'
	        ,'5': '极好'
	      };
	      $('#goodsScore').val(value);
	      this.span.text(arrs[value] || ( value + "中等"));
	    }
	})

	//时效评分
	rate.render({
	    elem: '#timeScore1'
	    ,value: 3
	    ,text: true
	    ,setText: function(value){ //自定义文本的回调
	      var arrs = {
	        '1': '极差'
	        ,'2': '差'
	        ,'3': '中等'
	        ,'4': '好'
	        ,'5': '极好'
	      };
	      $('#timeScore').val(value);
	      this.span.text(arrs[value] || ( value + "中等"));
	    }
	})

	//服务评分
	rate.render({
	    elem: '#serviceScore1'
	    ,value: 3
	    ,text: true
	    ,setText: function(value){
	      var arrs = {
	        '1': '极差'
	        ,'2': '差'
	        ,'3': '中等'
	        ,'4': '好'
	        ,'5': '极好'
	      };
	      $('#serviceScore').val(value);
	      this.span.text(arrs[value] || ( value + "中等"));
	    }
	})
  })
})

//订单评价提交
function editAppraise(){
	var params = getParams('.ipt');
	if(params.content == ''){
		 layer.msg('评论内容不能为空！',{icon:2});
		 return;
	}
	var load = layer.load({msg:'正在提交数据，请稍后...'});
	$.post('/index/center/addAppraise',params,function(data,textStatus){
		layer.close(load);
		var json = toJson(data);
	     if(json.status==1){
			layer.msg('评价成功',{icon:1});
			location.href='/appraise.html';
	     } else {
	    	 layer.msg(json.msg,{icon:2});
	     }
	});
}

//展示评价内容
function showAppraise(){
	 layui.use('layer',function(){
        var layer=layui.layer;
        layer.open({
            type:1,
            title:'评价内容',
            content:$("#content1"),
            cancel:function(){
            	$('#content1').hide();
       		}
        })
	})
}

