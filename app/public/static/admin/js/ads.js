var mmg;
function initGrid(p){
  var h = pageHeight();
  var adPositionId = $("#adPositionId").val();
  if(adPositionId>0){
      var cols = [
                  {title:'图标', name:'' ,width:50, align:'center', renderer: function(val,item,rowIndex){
                      return'<img src="'+item['adFile']+'" height="28px" width="100"/>';
                   }},
                  {title:'标题', name:'adName', width: 100},
                  {title:'广告网址', name:'adURL' ,width:200},
                  {title:'排序号', name:'adSort' ,width:15, renderer: function(val,item,rowIndex){
                     return '<span style="color:blue;cursor:pointer;" ondblclick="changeSort(this,'+item["adId"]+');">'+val+'</span>';
                  }},

      ];
  } else {


  var cols = [
            {title:'图标', name:'' ,width:50, align:'center', renderer: function(val,item,rowIndex){
                return'<img src="'+item['adFile']+'" height="28px" width="100"/>';
             }},
            {title:'标题', name:'adName', width: 100},
            {title:'广告位置', name:'positionName', width: 100},
            {title:'广告网址', name:'adURL' ,width:200},
            {title:'排序号', name:'adSort' ,width:15, renderer: function(val,item,rowIndex){
               return '<span style="color:blue;cursor:pointer;" ondblclick="changeSort(this,'+item["adId"]+');">'+val+'</span>';
            }},
            
            {title:'操作', name:'' ,width:80, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
          
                h += "<a  class='btn btn-blue' href='javascript:toEdit("+item['adId']+")'><i class='fa fa-pencil'></i>修改</a> ";
                h += "<a  class='btn btn-red' href='javascript:toDel(" + item['adId'] + ")'><i class='fa fa-trash-o'></i>删除</a> ";
                return h;
            }}
            ];
    }
    mmg = $('.mmg').mmGrid({height: h-155,indexCol: true, cols: cols,method:'POST',
        url: '/admin/ads/pageQuery?adPositionId='+adPositionId ,fullWidthRows: true, autoLoad: false,
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });  

    loadQuery(p);
}
//全局加载
function loadQuery(p){
  p=(p<=1)?1:p;
  mmg.load({page:p,key:$('#key').val()});
}

//跳去编辑页面
function toEdit(id){
    location.href = '/admin/ads/toedit?id='+id+'&p='+PYG_CURR_PAGE;
}

//删除
function toDel(id){

      layer.confirm('您确定要删除该广告吗', {icon: 3, title:'提示'}, function(index){
          var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
          $.post('/admin/ads/del',{id:id},function(data,textStatus){
                    layer.close(loading);
                    if(data.status==1){
                            layer.msg(data.msg,{icon:1});
                            loadQuery(PYG_CURR_PAGE);
                            
                    }else{
                         layer.msg(data.msg,{icon:2});
                    }
              });
        });
}

var oldSort;

//ajax 改变排序号
function changeSort(t,id){
   $(t).attr('ondblclick'," ");
var html = "<input type='text' id='sort-"+id+"' style='width:30px;padding:2px;' onblur='doneChange(this,"+id+")' value='"+$(t).html()+"' />";
 $(t).html(html);
 $('#sort-'+id).focus();
 $('#sort-'+id).select();
 oldSort = $(t).html();
}

//改变排序号
function doneChange(t,id){
  var sort = ($(t).val()=='')?0:$(t).val();
  if(sort==oldSort){
    $(t).parent().attr('ondblclick','changeSort(this,'+id+')');
    $(t).parent().html(parseInt(sort));
    return;
  }
  $.post('/admin/ads/changeSort',{id:id,adSort:sort},function(data){
    var json =  toAdminJson(data);
    if(json.status==1){
        $(t).parent().attr('ondblclick','changeSort(this,'+id+')');
        $(t).parent().html(parseInt(sort));
    }
  });
}

//编辑数据
function toEdits(id,p){
    var params = getParams('.ipt');
    var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
    $.post('/admin/ads/'+((id>0)?"edit":"add"),params,function(data,textStatus){
          layer.close(loading);
          var json = toAdminJson(data);
          if(json.status=='1'){
              layer.msg(json.msg,{icon:1});
              setTimeout(function(){
                  location.href='/admin/ads/index?p='+p;
              },1000);
          } else {
                  layer.msg(json.msg,{icon:2});
          }
    });
}
