var mmg;
$(function(){
    var laydate = layui.laydate;
    laydate.render({
        elem: '#startDate'
    });
    laydate.render({
        elem: '#endDate'
    });
})
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'投诉人', name:'userName', width: 30,sortable: true, renderer: function(val,item,rowIndex){
            	return item['loginName'];
            }},
            {title:'投诉订单号', name:'orderNo',sortable: true, renderer: function(val,item,rowIndex){
            	var h = "";
	            
              h += "<a style='cursor:pointer' onclick='javascript:showDetail("+ item['complainId'] +");'>"+item['orderNo']+"</a>";
	            return h;
            }},
            {title:'投诉人', name:'shopName', width: 30,sortable: true, renderer: function(val,item,rowIndex){
              return '品优购商城';
            }},
            
            {title:'投诉类型',width: 120,sortable: true, name:'complainName'},
            {title:'投诉时间',width: 80,sortable: true, name:'complainTime'},
            {title:'状态', name:'complainStatus', width: 60,renderer: function(val,item,rowIndex){
              var html='23123213';
	        	if(val==0)
	        		return '新投诉';
	        	else if(val==3)
	        		return '等待仲裁';
	        	else if(val==4)
	        		return '已仲裁';
            }},
            {title:'操作', name:'op' ,width:180, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
		            h += "<a class='btn btn-blue' href='javascript:toView(" + item['complainId'] + ")'><i class='fa fa-search'></i>查看</a> ";
		            if(item['complainStatus']!=4)
		            h += "<a class='btn btn-blue' href='javascript:toHandle(" + item['complainId'] + ")'><i class='fa fa-pencil'></i>处理</a> ";
		            return h;
	            }}
            ];
 
    mmg = $('.mmg').mmGrid({height: (h-85),indexCol: true, indexColWidth:50, cols: cols,method:'POST',
        url: '/admin/orderComplains/pageQuery', fullWidthRows: true, autoLoad: false,nowrap:true,
        remoteSort:true ,
        sortName: 'complainTime',
        sortStatus: 'desc',
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });
    loadGrid(p);
}
function toView(id){
	location.href='/admin/orderComplains/view?cid='+id;
}
function toHandle(id){
	location.href='/admin/orderComplains/toHandle?cid='+id;
}
function loadGrid(page){
	var p = getParams('.j-ipt');
	page=(page<=1)?1:page;
	p.page = page;
	mmg.load(p);
}



function finalHandle(id){

   var params = {};
   params.cid = id;
   params.finalResult = $.trim($('#finalResult').val());
   if(params.finalResult==''){
     layer.msg('请输入仲裁结果!',{icon:2});
     return;
   }


  layer.confirm('您确定仲裁该订单投诉吗', {icon: 3, title:'提示'}, function(index){
      var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      $.post('/admin/OrderComplains/finalHandle',params,function(data,textStatus){
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
  
