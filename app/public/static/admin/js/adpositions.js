var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'位置名称', name:'positionName', width: 200},
            {title:'位置代码', name:'positionCode' ,width:40},
            {title:'操作', name:'' ,width:120, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
                h += "<a  class='btn btn-blue' href='javascript:toAds("+item['positionId']+")'><i class='fa fa-pencil'></i>广告管理</a> ";
                h += "<a  class='btn btn-blue' href='javascript:toEdit("+item['positionId']+")'><i class='fa fa-pencil'></i>修改</a> ";
                h += "<a  class='btn btn-red' href='javascript:toDel(" + item['positionId'] + ")'><i class='fa fa-trash-o'></i>删除</a> "; 
                return h;
            }}
            ];
 
    mmg = $('.mmg').mmGrid({height: h-175,indexCol: true, cols: cols,method:'POST',
        url: '/admin/adpositions/pageQuery', fullWidthRows: true, autoLoad: false,
        plugins: [
            $('#pg').mmPaginator({})
        ]
    }); 
    loadQuery(p);
}

//跳去编辑页面
function toEdit(id){
	location.href = '/admin/Adpositions/toEdit?id='+id+'&p='+PYG_CURR_PAGE;
}

//广告列表
function toAds(id){
	location.href = '/admin/ads/index2?id='+id+'&p='+PYG_CURR_PAGE;
}

//全局加载
function loadQuery(p){
    p=(p<=1)?1:p;
    var query = getParams('.query');
    query.page = p;
    mmg.load(query);
}

//删除位置
function toDel(id){
        layer.confirm('您确定要删除该位置吗', {icon: 3, title:'提示'}, function(index){
          var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
          $.post('/admin/AdPositions/del',{id:id},function(data,textStatus){
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

//编辑位置
function toEdits(id,p){
    var params = getParams('.ipt');
    var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
    $.post('/admin/Adpositions/'+((id>0)?"edit":"add"),params,function(data,textStatus){
          layer.close(loading);
          var json = toAdminJson(data);
          if(json.status=='1'){
              layer.msg(json.msg,{icon:1});
              setTimeout(function(){
                  location.href='/admin/Adpositions/index?p='+p;
              },1000);
          } else {
                  layer.msg(json.msg,{icon:2});
          }
    });
}