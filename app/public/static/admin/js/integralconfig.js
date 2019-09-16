var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'积分抵用比例', name:'integralProportion', width: 100},
            {title:'签到奖励最低积分', name:'minimumPoints', width: 100},
            {title:'签到奖励最高积分', name:'highestPoints', width: 100},
            {title:'操作', name:'' ,width:70, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
                h += "<a  class='btn btn-blue' onclick='javascript:getForEdit("+item['configId']+")'><i class='fa fa-pencil'></i>修改</a> ";
                
                return h;
            }}
            ];
    mmg = $('.mmg').mmGrid({height: h-80,indexCol: true, cols: cols,method:'POST',
        url: '/admin/Integralconfig/pageQuery', fullWidthRows: true, autoLoad: false,
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

//修改积分配置信息
function getForEdit(id){
	 var loading = layer.msg('正在获取数据，请稍后...', {icon: 16,time:60000});
     $.post('/admin/integralconfig/get',{id:id},function(data,textStatus){
           layer.close(loading);
           var json = toAdminJson(data);
           if(json.configId){
           		setValues(json);
           		toEdit(json.configId);
           }else{
           		layer.msg(json.msg,{icon:2});
           }
    });
}

//跳去编辑页面
function toEdit(id){
	var title =(id==0)?"新增":"编辑";
	var box = layer.open({title:title,type:1,content:$('#integralBox'),area: ['500px', '300px'],
		btn:['确定','取消'],end:function(){$('#integralBox').hide();},yes:function(){
		$('#integralForm').submit();
	},cancel:function () {
            $("#bankName").val("");
        },btn2: function() {
            $("#bankName").val("");
        },});
	$('#integralForm').validator({
        fields: {
            integralProportion: {
            	rule:"required;",
            	msg:{required:"积分抵用比例不能为空"},
            	tip:"请输入积分抵用比例",
            	ok:"",
            },
             minimumPoints: {
              rule:"required;",
              msg:{required:"签到奖励最低积分不能为空"},
              tip:"请输入签到奖励最低积分",
              ok:"",
            },
             highestPoints: {
              rule:"required;",
              msg:{required:"积分抵用比例不能为空"},
              tip:"请输入积分抵用比例",
              ok:"",
            }
        },
        valid: function(form){
		        var params = getParams('.ipt');
	          params.configId = id;
	          var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
	           		$.post('/admin/integralconfig/'+((id==0)?"add":"edit"),params,function(data,textStatus){
	           			  layer.close(loading);
	           			  var json = toAdminJson(data);
	           			  if(json.status=='1'){
	           			    	layer.msg(json.msg,{icon:1});
	           			    	$('#integralBox').hide();
	           			    	$('#integralForm')[0].reset();
	           			    	layer.close(box);
                            loadGrid(PYG_CURR_PAGE);
	           			  } else {
	           			        layer.msg(json.msg,{icon:2});
	           			  }
	           });
    	  }
  });
}