var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'&nbsp;', name:'goodsImg', width: 30, renderer: function(val,item,rowIndex){
              var thumb = item['goodsImg'];
              return "<span class='weixin'><img  style='height:80px;width:80px;' src='"+item['goodsImg']+"'></span></span>";
            }},
            {title:'举报商品',sortable: true, name:'goodsName',renderer: function(val,item,rowIndex){
                return "<span title='"+item['goodsName']+"'><p class='wst-nowrap'>"+item['goodsName']+"</p></span>";
            }},
            {title:'举报人', name:'userName', width: 30,sortable: true, renderer: function(val,item,rowIndex){
              return item['userName'],item['loginName'];
            }},
            {title:'举报类型', name:'informType', renderer: function(val,item,rowIndex){
            if(val==1)
              return "<span class='statu-wait'><i class='fa fa-clock-o'></i> 产品质量问题</span>";
            else if(val==2)
              return "<span class='statu-no'><i class='fa fa-ban'></i> 出售禁售品</span>";
            }},
            {title:'举报时间',sortable: true, name:'informTime'},
            {title:'状态', name:'informStatus', renderer: function(val,item,rowIndex){
            if(val==0)
              return "<span class='statu-wait'><i class='fa fa-clock-o'></i> 等待处理</span>";
            else if(val==1)
              return "<span class='statu-no'><i class='fa fa-ban'></i> 无效举报</span>";
            else if(val==2)
              return "<span class='statu-yes'><i class='fa fa-check-circle'></i> 有效举报</span>";
            else if(val==3)
              return "<span class='statu-no'><i class='fa fa-exclamation-triangle'></i> 恶意举报</span>";
            }},
            {title:'操作', name:'op' ,width:80, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
                if(item['informStatus']==0)
                h += "<a class='btn btn-blue' href='javascript:toHandle(" + item['informId'] + ")'><i class='fa fa-pencil'></i>处理</a> ";
                return h;
              }}
            ];
    mmg = $('.mmg').mmGrid({height: (h-85),indexCol: true, indexColWidth:50, cols: cols,method:'POST',
        url: '/admin/Inform/pageQuery', fullWidthRows: true, autoLoad: false,
        remoteSort:true ,
        sortName: 'informTime',
        sortStatus: 'desc',
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });
    loadGrid(p);
}

//处理违规商品
function toHandle(id){
  location.href='/admin/inform/toHandle?cid='+id+'&p='+PYG_CURR_PAGE;
}
//全局加载
function loadGrid(page){
  var p = getParams('.j-ipt');
  page=(page<=1)?1:page;
    p.page = page;
  mmg.load(p);
}



function finalHandle(id,p){
   var params = {};
   params.cid = id;
   params.finalResult = $.trim($('#finalResult').val());
   params.informStatus = $('input:radio:checked').val();
   if(params.finalResult==''){
     layer.msg('请输入处理信息!',{icon:2});
     return;
   }
   if(typeof(params.informStatus)=='undefined'){
    layer.msg('请选择处理结果',{icon:2});
    return;
  }
  layer.confirm('您确定要处理该举报商品吗', {icon: 3, title:'提示'}, function(index){
     $.post('/admin/inform/finalHandle',params,function(data,textStatus){
        var json = toAdminJson(data);
        if(json.status=='1'){
          layer.msg(json.msg,{icon:1});
          location.reload();
        }else if(json.status == '2'){
          location.href='/admin/inform/index';
        }else{
          layer.msg(json.msg,{icon:2});
        }
      });
   });
}

  
