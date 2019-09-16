var grid,oldData = {},oldorderData = {};
function initGrid(){	
	grid = $('#maingrid').GridTree({
		url:'/admin/goods/pageQuery',
		pageSize:10000,
		pageSizeOptions:[10000],
		height:'99%',
        width:'100%',
        minColToggle:6,
        delayLoad :true,
        rownumbers:true,
        columns: [
	        { display: '分类名称', width: 230,name: 'catName', id:'catId', align: 'left',isSort: false,render: function (item)
                {
                	oldData[item.catId] = item.catName;
                    return '<input type="text"  size="40" value="'+item.catName+'" onblur="javascript:editName('+item.catId+',this)" style="width:200px;height:10px;"/>';
            }},
            { display: '是否显示', width: 70, name: 'isShow',isSort: false,
                render: function (item)
                {
                    return '<input type="checkbox" '+((item.isShow==1)?"checked":"")+' class="ipt" lay-skin="switch" lay-filter="isShow" data="'+item.catId+'" lay-text="显示|隐藏">';
                }
            },
            { display: '排序号', name: 'catSort',width: 50,isSort: false,render: function (item)
                {
                	oldorderData[item.catId] = item.catSort;
                    return '<input type="text" style="width:50px;height:10px;" value="'+item.catSort+'" onblur="javascript:editOrder('+item.catId+',this)"/>';
            }},
	        { display: '操作', name: 'op',width: 170,isSort: false,
	        	render: function (rowdata){
		            var h = "";
			        h += "<a class='btn btn-blue' href='javascript:toEdit("+rowdata["catId"]+",0)'><i class='fa fa-plus'></i>新增子分类</a> ";
		            h += "<a class='btn btn-blue' href='javascript:toEdit("+rowdata["parentId"]+","+rowdata["catId"]+")'><i class='fa fa-pencil'></i>修改</a> ";
		            h += "<a class='btn btn-red' href='javascript:toDel("+rowdata["parentId"]+","+rowdata["catId"]+")'><i class='fa fa-trash-o'></i>删除</a> "; 
		            return h;
	        	}}
        ],
        callback:function(){
		    layui.form.render();
	    }
    });
    layui.form.on('switch(isShow)', function(data){
        var id = $(this).attr("data");
        if(this.checked){
            toggleIsShow(id, 1);
        }else{
            toggleIsShow(id, 0);
        }
   });
}


function toggleIsShow(id,isShow){
	if(isShow==0){
		layer.confirm('您确定要隐藏该商品分类并下架该分类下的所有商品吗', {icon: 3, title:'提示'}, function(index){
		  var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
		  $.post('/admin/goods/editiIsShow',{id:id,isShow:isShow},function(data,textStatus){
					layer.close(loading);
					if(data.status==1){
						 layer.msg(data.msg,{icon:1});
						 grid.reload(id);
					}else{
						 layer.msg(data.msg,{icon:2});
					}
			  });
		});

	} else {

		var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
	    $.post('/admin/goods/editiIsShow',{id:id,isShow:isShow},function(data,textStatus){
			layer.close(loading);
			if(data.status=='1'){
				 layer.msg(data.msg,{icon:1});
				 grid.reload(id);
			}else{
				 layer.msg(data.msg,{icon:2});
			}
		});
	}
}

function toEdit(pid,id){
    window.location.href='/admin/goods/toEdit?id='+id+'&pid='+pid;
}

function toEdits(){
    var id = $('#catId').val();
    var params = getParams('.ipt');
    params.id = id;
    var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
    $.post('/admin/goods/'+((id>0)?"edit":"add"),params,function(data,textStatus){
        layer.close(loading);
        var json = toAdminJson(data);
        if(json.status== 1){
            layer.msg(json.msg,{icon:1},function(){
                location.href="/admin/goods/cats"
            });
        }else{
            layer.msg(json.msg,{icon:2});
        }
    });
}

function toDel(pid,id){

		layer.confirm('您确定要删除该商品分类并下架该分类下的所有商品吗', {icon: 3, title:'提示'}, function(index){
		  var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
		  $.post('/admin/goods/del',{id:id},function(data,textStatus){
					layer.close(loading);
					if(data.status==1){
						    layer.msg(data.msg,{icon:1});
	           		        grid.reload(pid);
					}else{
						 layer.msg(data.msg,{icon:2});
					}
			  });
		});
}

function editName(id,obj){
	if($.trim(obj.value)=='' || $.trim(obj.value)==oldData[id]){
		obj.value = oldData[id];
		return;
	}
	$.post('/admin/goods/editName',{id:id,catName:obj.value},function(data,textStatus){
	    if(data.status==1){
	    	oldData[id] = $.trim(obj.value);
	        layer.msg(data.msg,{icon:1});
	    }else{
	        layer.msg(data.msg,{icon:2});
	    }
	});
}

function editOrder(id,obj){
	if($.trim(obj.value)=='' || $.trim(obj.value)==editOrder[id]){
		obj.value = editOrder[id];
		return;
	}
	$.post('/admin/goods/editOrder',{id:id,catSort:obj.value},function(data,textStatus){
	    if(data.status=='1'){
	    	editOrder[id] = $.trim(obj.value);
	        layer.msg(data.msg,{icon:1});
	    }else{
	        layer.msg(data.msg,{icon:2});
	    }
	});
}