
layui.use('form', function(){
var form = layui.form;
form.render();
});

var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'商品主图', name:'goodsImg', width: 30, renderer: function(val,item,rowIndex){
	        	return "<span class='weixin'><img id='img' style='height:40px;width:40px;' src='"+item['goodsImg']
            	+"'></span>";
            }},
            {title:'订单号', name:'orderNo',sortable: true, width: 90},
            {title:'商品', name:'goodsName',sortable: true, width: 100,renderer: function(val,item,rowIndex){
                return "<span><p class='wst-nowrap'>"+item['goodsName']+"</p></span>";
            }},
            
            {title:'商品评分', name:'goodsScore',sortable: true, width: 80, renderer: function(val,item,rowIndex){
            	var s="<div style='line-height:28px;'>";
	        	for(var i=0;i<val;++i){
	        		s +="<img src='/static/admin/img/icon_score_yes.png'>";
	        	}
	        	s += "</div>";
	        	return s;
            }},
            {title:'时效评分', name:'timeScore',sortable: true, width: 80, renderer: function(val,item,rowIndex){
            	var s="<div style='line-height:28px;'>";
	        	for(var i=0;i<val;++i){
	        		s +="<img src='/static/admin/img/icon_score_yes.png'>";
	        	}
	        	s += "</div>";
	        	return s;
            }},
            {title:'服务评分', name:'serviceScore',sortable: true, width: 80, renderer: function(val,item,rowIndex){
            	var s="<div style='line-height:28px;'>";
	        	for(var i=0;i<val;++i){
	        		s +="<img src='/static/admin/img/icon_score_yes.png'>";
	        	}
	        	s += "</div>";
	        	return s;
            }},
            {title:'评价内容', name:'content', width: 155},
            {title:'状态', name:'isShow', width: 20,sortable: true, renderer: function(val,item,rowIndex){
            	return (val==0)?"<span class='statu-no'><i class='fa fa-ban'></i> 隐藏</span>":"<span class='statu-yes'><i class='fa fa-check-circle'></i> 显示</span></h3>";
            }},
            {title:'操作', name:'' ,width:95, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
	            h += "<a class='btn btn-blue' href='"+'/admin/goodsappraises/toEdit?id='+item['id']+'&p='+PYG_CURR_PAGE+"'><i class='fa fa-pencil'></i>修改</a> ";
	            h += "<a class='btn btn-red' href='javascript:toDel(" + item['id'] + ")'><i class='fa fa-trash-o'></i>删除</a> "; 
	            return h;
            }}
            ];
 
    mmg = $('.mmg').mmGrid({height: h-85,indexCol: true,indexColWidth:50, cols: cols,method:'POST',
        url: '/admin/goodsappraises/pageQuery', fullWidthRows: true, autoLoad: false,
        remoteSort:true ,
        sortName: 'orderNo',
        sortStatus: 'desc',
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });  
    loadGrid(p);
}

function loadGrid(p){
    p=(p<=1)?1:p;
	var query = getParams('.query');
    query.page = p;
	mmg.load(query);
}

function editInit(p){
/* 表单验证 */
    $('#goodsAppraisesForm').validator({
            fields: {
                content: {
                  rule:"required;length(3~50)",
                  msg:{length:"评价内容为3-50个字",required:"评价内容为3-50个字"},
                  tip:"评价内容为3-50个字",
                  ok:"",
                },
                score:  {
                  rule:"required",
                  msg:{required:"评分必须大于0"},
                  ok:"",
                  target:"#score_error",
                },  
            },
          valid: function(form){
            var params = getParams('.ipt');
                //获取修改的评分
                params.goodsScore = $('.goodsScore').find('[name=score]').val();
                params.timeScore = $('.timeScore').find('[name=score]').val();
                params.serviceScore = $('.serviceScore').find('[name=score]').val();
            var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
            $.post('/admin/goodsappraises/'+((params.id==0)?"add":"edit"),params,function(data,textStatus){
              layer.close(loading);
              var json = toAdminJson(data);
              if(json.status=='1'){
                  layer.msg("操作成功",{icon:1});
                  location.href='/admin/goodsappraises/index';
              }else{
                    layer.msg(json.msg,{icon:2});
              }
            });

      }

    });
}

//删除评论
function toDel(id){
        layer.confirm('您确定要删除该评论吗', {icon: 3, title:'提示'}, function(index){
          var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
          $.post('/admin/goodsappraises/del',{id:id},function(data,textStatus){
                layer.close(loading);
                var json = toAdminJson(data);
                if(json.status==1){
                        layer.msg(json.msg,{icon:1});
                        loadGrid(PYG_CURR_PAGE)
                        
                } else {
                     layer.msg(data.msg,{icon:2});
                }
              });
        });
}