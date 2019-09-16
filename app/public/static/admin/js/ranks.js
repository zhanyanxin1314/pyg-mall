var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'会员等级图标', name:'rankImg', width: 30,renderer:function(val,item,rowIndex){
            return '<img src="'+item['rankImg']+'" height="28px" />';
          }},
            {title:'会员等级名称', name:'rankName' ,width:100},
            {title:'积分下限', name:'startScore' ,width:100},
            {title:'积分上限', name:'endScore' ,width:60},
            {title:'操作', name:'' ,width:180, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
                h += "<a  class='btn btn-blue' onclick='javascript:toEdit("+item['rankId']+")'><i class='fa fa-pencil'></i>修改</a> ";
                h += "<a  class='btn btn-red' onclick='javascript:toDel(" + item['rankId'] + ")'><i class='fa fa-trash-o'></i>删除</a> ";
                return h;
            }}
            ];
 
    mmg = $('.mmg').mmGrid({height: h-80,indexCol: true, cols: cols,method:'POST',
        url: '/admin/user/pageRanksQuery', fullWidthRows: true, autoLoad: false,
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });
    loadGrid(p);
}

//全局加载
function loadGrid(p){
    p=(p<=1)?1:p;
    mmg.load({page:p});
}

//跳转编辑页面
function toEdit(id){
    location.href = '/admin/user/toEditRanks?id='+id+'&p='+PYG_CURR_PAGE;
}

//删除会员等级
function toDel(id){
     layer.confirm('您确定要删除该会员等级吗', {icon: 3, title:'提示'}, function(index){
          var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
          $.post('/admin/user/delRanks',{id:id},function(data,textStatus){
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

//编辑会员等级
function toEdits(id,p){
    var params = getParams('.ipt');
    var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
    $.post('/admin/user/'+((params.rankId==0)?"addRanks":"editRanks"),params,function(data,textStatus){
      layer.close(loading);
      var json = toAdminJson(data);
      if(json.status=='1') {
          layer.msg(json.msg,{icon:1});
          location.href='/admin/user/ranks?p='+p;
      } else {
            layer.msg(json.msg,{icon:2});
      }
    });
}




		