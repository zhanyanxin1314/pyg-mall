var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'快递名称', name:'expressName', width: 160},
            {title:'快递代码', name:'expressCode' ,width:60},
            {title:'操作', name:'' ,width:150, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
			          h += "<a  class='btn btn-blue' onclick='javascript:getForEdit(" + item['expressId'] + ")'><i class='fa fa-pencil'></i>修改</a> ";
			          h += "<a  class='btn btn-red' onclick='javascript:toDel(" + item['expressId'] + ")'><i class='fa fa-trash-o'></i>删除</a> ";
			          return h;
            }}
            ];
 
    mmg = $('.mmg').mmGrid({height: (h-155),indexCol: true, cols: cols,method:'POST',
        url: '/admin/express/pageQuery', fullWidthRows: true, autoLoad: false,
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });  
    loadQuery(p);
}
function loadQuery(p){
    p=(p<=1)?1:p;
    mmg.load({page:p});
}

//删除银行信息
function toDel(id){
    layer.confirm('您确定要删除该数据吗', {icon: 3, title:'提示'}, function(index){
      var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      $.post('/admin/express/del',{id:id},function(data,textStatus){
              layer.close(loading);
              if(data.status==1){
                  layer.msg(data.msg,{icon:1});               
                      loadQuery(PYG_CURR_PAGE)
                    } else {
                      layer.msg(data.msg,{icon:2});
                    }
              });
      });
}

function getForEdit(id){
	 var loading = layer.msg('正在获取数据，请稍后...', {icon: 16,time:60000});
     $.post('/admin/express/get',{id:id},function(data,textStatus){
           layer.close(loading);
           var json = toAdminJson(data);
           if(json.expressId){
           		setValues(json);
           		toEdit(json.expressId);
           }else{
           		layer.msg(json.msg,{icon:2});
           }
    });
}

function toEdit(id){
	var title = "新增";
	if(id>0){
		title = "编辑";
	}else{
		$('#expressForm')[0].reset();
	}
	var box = open({title:title,type:1,content:$('#expressBox'),area: ['450px', '200px'],btn:['确定','取消'],
        end:function(){$('#expressBox').hide();},
		yes:function(){
		$('#expressForm').submit();
	}});
	$('#expressForm').validator({
        fields: {
            expressName: {
            	rule:"required;",
            	msg:{required:"快递名称不能为空"},
            	tip:"请输入快递名称",
            	ok:"",
            }
        },
       valid: function(form){
		        var params = getParams('.ipt');
	                params.expressId = id;
	                var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
	           		$.post('/admin/express/'+((id==0)?"add":"edit"),params,function(data,textStatus){
	           			  layer.close(loading);
	           			  var json = toAdminJson(data);
	           			  if(json.status=='1'){
	           			    	layer.msg("操作成功",{icon:1});
	           			    	$('#expressForm')[0].reset();
	           			    	layer.close(box);
                              loadQuery(PYG_CURR_PAGE);
	           			  }else{
	           			        layer.msg(json.msg,{icon:2});
	           			  }
	           		});

    	}

  });

}