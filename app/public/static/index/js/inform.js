var PYG_CURR_PAGE = 1;

function saveInforms(historyURL){
   /* 表单验证 */
  $('#informForm').validator({
              fields: {
                  informContent: {
                    rule:"required",
                    msg:{required:"清输入举报内容"},
                    tip:"请输入举报内容",
                  },
                  informType: {
                    rule:"checked;",
                    msg:{checked:"举报类型不能为空"},
                    tip:"请选择举报类型",
                  }
                  
              },
            valid: function(form){
              var params = getParams('.ipt');

              var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});  
                  $.post('/index/center/saveInform',params,function(data,textStatus){
                    layer.close(loading);
                    var json = toJson(data);
                    if(json.status=='1'){
                        layer.msg('您的举报已提交，请留意信息回复', {icon: 6},function(){
                        location.href = '/inform.html';
                       });
                    }else{
                          layer.msg(json.msg,{icon:2});
                    }
                  });
        }
  });
}

function toView(id){
  location.href='/index/center/informdetail?id='+id+'&p='+PYG_CURR_PAGE;
}
function informByPage(p){
  $('#list').html('<img src="'+WST.conf.ROOT+'/wstmart/home/view/default/img/loading.gif">正在加载数据...');
  var params = {};
  params = WST.getParams('.s-query');
  params.key = $.trim($('#key').val());
  params.page = p;
  $.post(WST.U('home/informs/queryUserInformPage'),params,function(data,textStatus){
      var json = WST.toJson(data);
      if(json.status==1){
          if(params.page>json.data.last_page && json.data.last_page >0){
              informByPage(json.data.last_page);
              return;
          }
          var gettpl = document.getElementById('tblist').innerHTML;
          laytpl(gettpl).render(json.data.data, function(html){
            $('#list').html(html);
          });
          if(json.data.last_page>1){
            laypage({
               cont: 'pager', 
               pages:json.data.last_page,
               curr: json.data.current_page,
               skin: '#e23e3d',
               groups: 3,
               jump: function(e, first){
                    if(!first){
                        informByPage(e.curr);
                    }
                  } 
            });


          }else{
            $('#pager').empty();
          }
        }  
  });
}