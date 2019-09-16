//取消订单记录
function cancelOrders(orderId){
      layer.confirm('您确定要取消该订单吗', {icon: 3, title:'提示'}, function(index){
      var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      $.post('/index/center/cancelOrders',{orderId:orderId},function(data,textStatus){
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

//订单发货
function takeOrders(orderId){
      layer.confirm('您确定要收货吗？请检查好物品！', {icon: 3, title:'提示'}, function(index){
      var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      $.post('/index/center/takeOrders',{orderId:orderId},function(data,textStatus){
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
//用户中心-用户永久删除订单
function toDel(orderId){
      layer.confirm('您确定要删除该订单吗？删除不能恢复', {icon: 3, title:'提示'}, function(index){
      var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      $.post('/index/center/delOrders',{orderId:orderId},function(data,textStatus){
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

//用户中心-用户恢复订单
function resumedOrders(orderId){
      layer.confirm('您确定要恢复该订单吗', {icon: 3, title:'提示'}, function(index){
      var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      $.post('/index/center/resumedOrders',{orderId:orderId},function(data,textStatus){
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

//用户中心-跳到订单投诉页面
function complain(id,src){
  location.href='/index/center/ordercomplains?orderId='+id+'&src='+src;
}

