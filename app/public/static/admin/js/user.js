var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'账号', name:'loginName', width: 130,sortable:true},
            {title:'用户名', name:'userName' ,width:100,sortable:true},
            {title:'手机号码', name:'userPhone' ,width:100,sortable:true},
            {title:'电子邮箱', name:'userEmail' ,width:60,sortable:true},
            {title:'积分', name:'userScore' ,width:50,sortable:true},
            {title:'等级', name:'rank' ,width:60,sortable:true},
            {title:'注册时间', name:'createTime' ,width:120,sortable:true},
            {title:'状态', name:'userStatus' ,width:60,sortable:true, renderer:function(val,item,rowIndex){
                return (val==1)?"<span class='statu-yes'><i class='fa fa-check-circle'></i> 启用&nbsp;</span>":"<span class='statu-no'><i class='fa fa-ban'></i> 停用&nbsp;</span>";
            }},
            {title:'操作', name:'' ,width:150, align:'center', renderer: function(val,rowdata,rowIndex){
                var h = "";
               // h += "<a  class='btn btn-blue' href='"+WST.U('admin/Users/toEdit','id='+rowdata['userId'])+'&p='+WST_CURR_PAGE+"'><i class='fa fa-pencil'></i>修改</a> ";
                h += "<a  class='btn btn-red' href='javascript:toDel(" + rowdata['userId'] + ","+rowdata['userType']+")'><i class='fa fa-trash-o'></i>删除</a> ";
                //h += "<br/><a href='"+WST.U('admin/userscores/touserscores','id='+rowdata['userId'])+'&p='+WST_CURR_PAGE+"'>积分</a> ";
                //h += "<a href='"+WST.U('admin/logmoneys/tologmoneys','id='+rowdata['userId']+'&src=users')+'&p='+WST_CURR_PAGE+"&type=0'>用户资金</a> ";
                //h += "<a href='admin/orders/index&userId='+rowdata['userId'])+'&p='+WST_CURR_PAGE+"&type=0'>消费信息</a> ";
                return h;
            }}
            ];
 
    mmg = $('.mmg').mmGrid({height: h-173,indexCol: true,indexColWidth:50, cols: cols,method:'POST',nowrap:true,
        url: '/admin/user/pageQuery', fullWidthRows: true, autoLoad: false,remoteSort: true,sortName:'createTime',sortStatus:'desc',
        plugins: [
            $('#pg').mmPaginator({})
        ]
    }); 
  
    loadGrid(p);
}
function loadGrid(p){
    p=(p<=1)?1:p;
    mmg.load({page:p});
}

function userQuery(p){
    p=(p<=1)?1:p;
		var query = getParams('.query');
    query.page = p;
    mmg.load(query);
}