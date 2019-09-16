var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
                 {title:'品牌图标', name:'img', width: 103, renderer: function(val,item,rowIndex){
                     return "<span><img id='img' style='height:52px;width:103px;' src='"+item['brandImg']
                     +"'></span>";
                 }},
                {title:'品牌名称', name:'brandName', width: 100},
                {title:'品牌介绍', name:'brandDesc', width: 100,renderer: function(val,item,rowIndex){
                    return "<span  ><p class='wst-nowrap'>"+item['brandDesc']+"</p></span>";
                }},
                {title:'操作', name:'' ,width:70, align:'center', renderer: function(val,item,rowIndex){
                    var h1 = "";
    		        h1 += "<a class='btn btn-blue' href='javascript:toEdit("+item["brandId"]+")'><i class='fa fa-pencil'></i>修改</a> ";
    		        h1 += "<a class='btn btn-red' href='javascript:toDel("+item["brandId"]+")'><i class='fa fa-trash-o'></i>删除</a> "; 
    		        return h1;
                }}
            ];
 
    mmg = $('.mmg').mmGrid({height: h-85,indexCol: true,indexColWidth:50, cols: cols,method:'POST',
        url: '/admin/goods/pageBrandQuery', fullWidthRows: true, autoLoad: false,
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });
    loadGrid(p);
}
//全局加载
function loadGrid(p){
    p=(p<=1)?1:p;
	mmg.load({page:p,key:$('#key').val(),id:$('#catId').val()});
}

//跳去编辑页面
function toEdit(id){    
	location.href='/admin/goods/toEditBrand?id='+id+'&p='+PYG_CURR_PAGE;
}

//编辑品牌
function toEdits(id,p){
    
    var params = getParams('.ipt');
    params.id = id;
    var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
	$.post('/admin/goods/'+((id>0)?"editBrand":"addBrand"),params,function(data,textStatus){
		  layer.close(loading);
		  var json = toAdminJson(data);
		  if(json.status=='1'){
		    	layer.msg(json.msg,{icon:1});
		        setTimeout(function(){
			    	location.href='/admin/goods/brand?p='+p;
		        },1000);
		  }else{
		        layer.msg(json.msg,{icon:2});
		  }
	});
}

//删除品牌
function toDel(id){
        layer.confirm('您确定要删除该品牌吗', {icon: 3, title:'提示'}, function(index){
          var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
          $.post('/admin/goods/delBrand',{id:id},function(data,textStatus){
                layer.close(loading);
                if(data.status==1){
                        layer.msg(data.msg,{icon:1});
                        loadGrid(PYG_CURR_PAGE)
                        
                } else {
                     layer.msg(data.msg,{icon:2});
                }
              });
        });
}
