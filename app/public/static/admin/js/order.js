var mmg;
function initGrid(page){
	var p = arrayParams('.j-ipt');
	var h = pageHeight();
    var cols = [
            {title:'订单编号', name:'orderNo', width: 50,sortable:true, renderer:function(val,item,rowIndex){
                var h = "";
	            h += "<a style='cursor:pointer' onclick='javascript:showDetail("+ item['orderId'] +");'>"+item['orderNo']+"</a>";
	            return h;
            }},
            {title:'收货人', name:'userName', width: 120,sortable:true},
            {title:'实收金额', name:'totalMoney', width: 30,sortable:true, renderer:function(val,item,rowIndex){return '￥'+val;}},
            {title:'支付方式', name:'payType' , width: 30,sortable:true},
            {title:'下单时间', name:'createTime', width: 100,sortable:true},
            {title:'订单状态', name:'orderStatus', width: 30,sortable:true, renderer:function(val,item,rowIndex){
            	 if(item['orderStatus']==-1 || item['orderStatus']==-3){
                     return "<span class='statu-no'><i class='fa fa-ban'></i> "+item.status+"</span>";
                 }else if(item['orderStatus']==2){
                     return "<span class='statu-yes'><i class='fa fa-check-circle'></i> "+item.status+"</span>";
            	 }else{
            	 	return "<span class='statu-wait'><i class='fa fa-clock-o'></i> "+item.status+"</span>";
            	 }
            }},
            {title:'操作' , width: 30,name:'orderStatus', renderer:function(val,item,rowIndex){
            	var h = "";
	            h += "<a class='btn btn-blue' href='javascript:toView(" + item['orderId'] + ")'><i class='fa fa-search'></i>详情</a> ";
                if(item['orderStatus']==0){
                     h += "<a class='btn btn-blue' href='javascript:toShipments(" + item['orderId'] + ")'><i class='fa fa-search'></i>发货</a> ";
                }
	            return h;
            }}
            ];
    mmg = $('.mmg').mmGrid({height: (h-84),indexCol: true,indexColWidth:50, cols: cols,method:'POST',nowrap:true,
        url: '/admin/order/pageQuery', fullWidthRows: true, autoLoad: false,remoteSort: true,sortName:'createTime',sortStatus:'desc',
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });
    loadGrid(page);
}

//查看订单详情
function toView(id){
	location.href='/admin/order/view?id='+id+'&src=orders&p='+PYG_CURR_PAGE;
}
function toBack(p,src){
    if(src=='orders'){
        location.href=WST.U('admin/orders/index','p='+p);
    }else{
        location.href=WST.U('admin/orderrefunds/refund','p='+p);
    }
}
function loadGrid(page){
	var p = getParams('.j-ipt');
    page=(page<=1)?1:page;
    p.page = page;
	mmg.load(p);
}

function toExport(){
	var params = {};
	params = WST.getParams('.j-ipt');
	var box = WST.confirm({content:"您确定要导出订单吗?",yes:function(){
		layer.close(box);
		location.href=WST.U('admin/orders/toExport',params);
    }});
}

//订单发货
function toShipments(id){
     layer.open({
        type : 2,
        title : '订单发货',
        area : [ '500px', '500px' ],
        fix : false,
        content : '/admin/order/Shipments?id='+id,
        end : function() {
            dataTable.reloadTable();
        }
    });    
}

function loadMore(){
    var h = pageHeight();
    if($('#moreItem').hasClass('hide')){
        $('#moreItem').removeClass('hide');
        mmg.resize({height:h-115});
    }else{
        $('#moreItem').addClass('hide');
        mmg.resize({height:h-85});
    }
}


//编辑数据
function toEditsExpress(id,p){

    var params = getParams('.ipt');
    var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
    $.post('/admin/order/editExpress?id='+id,params,function(data,textStatus){
          layer.close(loading);
          var json = toAdminJson(data);
          if(json.status=='1'){
              layer.msg(json.msg,{icon:1});
              setTimeout(function(){
                  parent.location.href='/admin/order/index?p='+p;
              },1000);
          } else {
              layer.msg(json.msg,{icon:2});
          }
    });
}