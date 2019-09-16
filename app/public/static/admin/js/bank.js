var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'银行名称', name:'bankName', width: 100},
            {title:'操作', name:'' ,width:70, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
                h += "<a  class='btn btn-blue' onclick='javascript:getForEdit("+item['bankId']+")'><i class='fa fa-pencil'></i>修改</a> ";
                h += "<a  class='btn btn-red' onclick='javascript:toDel(" + item['bankId'] + ")'><i class='fa fa-trash-o'></i>删除</a> ";
                return h;
            }}
            ];
    mmg = $('.mmg').mmGrid({height: h-80,indexCol: true, cols: cols,method:'POST',
        url: '/admin/bank/pageQuery', fullWidthRows: true, autoLoad: false,
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });
    loadGrid(p)
}

//全局加载
function loadGrid(p){
    p=(p<=1)?1:p;
    mmg.load({page:p});
}

//删除银行信息
function toDel(id){
    layer.confirm('您确定要删除该数据吗', {icon: 3, title:'提示'}, function(index){
      var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      $.post('/admin/bank/del',{id:id},function(data,textStatus){
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

//修改银行信息
function getForEdit(id){
	 var loading = layer.msg('正在获取数据，请稍后...', {icon: 16,time:60000});
     $.post('/admin/bank/get',{id:id},function(data,textStatus){
           layer.close(loading);
           var json = toAdminJson(data);
           if(json.bankId){
           		setValues(json);
           		toEdit(json.bankId);
           }else{
           		layer.msg(json.msg,{icon:2});
           }
    });
}

//跳去编辑页面
function toEdit(id){
	var title =(id==0)?"新增":"编辑";
	var box = layer.open({title:title,type:1,content:$('#bankBox'),area: ['450px', '160px'],
		btn:['确定','取消'],end:function(){$('#bankBox').hide();},yes:function(){
		$('#bankForm').submit();
	},cancel:function () {
            $("#bankName").val("");
        },btn2: function() {
            $("#bankName").val("");
        },});
	$('#bankForm').validator({
        fields: {
            bankName: {
            	rule:"required;",
            	msg:{required:"银行名称不能为空"},
            	tip:"请输入银行名称",
            	ok:"",
            },
        },
        valid: function(form){
		        var params = getParams('.ipt');
	          params.bankId = id;
	          var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
	           		$.post('/admin/bank/'+((id==0)?"add":"edit"),params,function(data,textStatus){
	           			  layer.close(loading);
	           			  var json = toAdminJson(data);
	           			  if(json.status=='1'){
	           			    	layer.msg(json.msg,{icon:1});
	           			    	$('#bankBox').hide();
	           			    	$('#bankForm')[0].reset();
	           			    	layer.close(box);
                            loadGrid(PYG_CURR_PAGE);
	           			  } else {
	           			        layer.msg(json.msg,{icon:2});
	           			  }
	           });
    	  }
  });
}