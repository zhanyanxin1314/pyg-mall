$(function(){
	// select 元素
		var $selectorProvince = $("#province");
		var $selectorCity = $("#city");
		var $selectorDistrict = $("#district");
		// 地区的默认值，通过select的default-data获取
		var defaultProvince = $selectorProvince.attr('data-default');
		var defaultCity = $selectorCity.attr('data-default');
		var defaultDistrict= $selectorDistrict.attr('data-default');
		if(!defaultProvince) defaultProvince = currentProvince;
		if(!defaultCity) defaultCity = currentCity;
		// 初始化
		initSelector($selectorProvince,provinces);
		initSelector($selectorCity,getCities(defaultProvince));
		initSelector($selectorDistrict,getDistricts(defaultProvince,defaultCity));

		// 选择省份
		$selectorProvince.change(function(){
			currentProvince = $(this).val();
			initSelector($selectorCity,getCities(currentProvince));
			$selectorCity.trigger('change');
		})

		// 选择城市
		$selectorCity.change(function(){
			currentCity = $(this).val();
			initSelector($selectorDistrict,getDistricts(currentProvince,currentCity));
		})

		// 初始化选择框 其中 data 表示包含所有选择项的数组
		function initSelector(selectObj,data){
			// 空的数据直接隐藏select元素
			if(data == ""){
				selectObj.hide();
				selectObj.html("");
			}else{
				selectObj.show();
			}
			var str = "";
			var selected = selectObj.attr('data-default');
			for (var i = 0; i < data.length; i++) {
				var _data = data[i];
				if(_data === selected){
					str += '<option selected="selected" value="'+_data+'">'+_data+'</option>';
				} else {
					str += '<option value="'+_data+'">'+_data+'</option>';
				}
			}
			selectObj.html(str);
		}
})

//修改收货人姓名
function editAddressUserName(obj){
	var userName = $('#userName').val();
	var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      $.post('/index/center/editAddressUserName',{addressId:obj,userName:userName},function(data,textStatus){
                layer.close(loading);
                if(data.status==1){
                    layer.msg(data.msg,{icon:1});
                    location.reload();
                } else {
                    layer.msg(data.msg,{icon:2});
                }
          });
}

//添加/修改收货地址
function editUserAddress(){
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
		if(json == 3){
			layer.msg('收货地址不能多于5个！请先删除无用地址！',{icon:2});
			return;
		}
	    if(json.status==1){
	     	$('.modal-dialog').hide();
			layer.msg('操作成功',{icon:1});
			location.reload();
	    } else {
	    	 layer.msg(json.msg,{icon:2});
	    }
	});
}

//获取收货地址信息
function getForEdit(addressId){
	 var loading = layer.msg('正在获取数据，请稍后...', {icon: 16,time:60000});
     $.post('/index/useraddress/getById',{addressId:addressId},function(data,textStatus){
           layer.close(loading);
           var json = toAdminJson(data);
           if(json.addressId){
           		setValues(json);
           		$('#addressId').val(json.addressId);
           } else {
           		layer.msg(json.msg,{icon:2});
           }
    });
}

//删除收货地址信息
function toDel(addresssId){
    layer.confirm('您确定要删除该收货地址吗', {icon: 3, title:'提示'}, function(index){
      var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      $.post('/index/useraddress/del',{id:addresssId},function(data,textStatus){
              layer.close(loading);
              if(data.status==1){
                  	  layer.msg(data.msg,{icon:1});               
                      location.reload();
                    } else {
                      layer.msg(data.msg,{icon:2});
                    }
              });
      });
}
