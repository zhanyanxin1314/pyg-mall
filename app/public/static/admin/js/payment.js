var mmg;
function initGrid(){
	var h = pageHeight();
    var cols = [
            {title:'名称', name:'payName', width: 30},
            {title:'描述', name:'payDesc' },
            {title:'状态', name:'enabled', renderer: function(val,item,rowIndex){
            	return (val==1)?"<span class='statu-yes'><i class='fa fa-check-circle'></i> 开启</span>":"<span class='statu-no'><i class='fa fa-ban'></i> 关闭</span>";
            }},
            {title:'排序号', name:'payOrder' },
            {title:'操作', name:'op' ,width:80, align:'center', renderer: function(val,item,rowIndex){
                var h1 = "";
	            if(item['enabled']==1){
		            h1 += "<a  class='btn btn-blue' href='/admin/payment/toEdit?id="+item['id']+"&payCode="+item['payCode']+"'><i class='fa fa-pencil'></i>编辑</a> ";
		            h1 += "<a  class='btn btn-red' href='javascript:toDel(" + item['id'] + ")'><i class='fa fa-trash-o'></i>卸载</a> ";
	            }
	            else{
	            	h1 += "<a class='btn btn-blue' href='/admin/payment/toEdit?id="+item['id']+"&payCode="+item['payCode']+"'><i class='fa fa-gear'></i>安装</a> ";
	            }
	            return h1;
            }}
            ];
 
    mmg = $('.mmg').mmGrid({height: (h-40),indexCol: true, cols: cols,method:'POST',
        url: '/admin/payment/pageQuery', fullWidthRows: true, autoLoad: true,
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });      
}
function toDel(id){
        layer.confirm('您确定卸载吗', {icon: 3, title:'提示'}, function(index){
          var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
          $.post('/admin/payment/del',{id:id},function(data,textStatus){
                    layer.close(loading);
                    if(data.status==1){
                            layer.msg('操作成功',{icon:1});
	           		        mmg.load();
                    } else {
                         layer.msg(data.msg,{icon:2});
                    }
              });
        });
}


function edit(id){
	//获取所有参数
	var params = getParams('.ipt');
	//接收配置信息并转成JSON
	var configs = getParams('.cfg');
	//保存配置信息
	params.payConfig = configs;
	params.id = id;
	var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
	$.post('/admin/payment/'+((id==0)?"add":"edit"),params,function(data,textStatus){
	  layer.close(loading);
	  var json = toAdminJson(data);
	  if(json.status=='1'){
	      layer.msg('操作成功',{icon:1});
	      location.href='/admin/payment/index';
	  }else{
	        layer.msg(json.msg,{icon:2});
	  }
	});
}


$(function(){
	$('#payForm').validator({
      fields: {
      		/*默认验证*/
            payName: {rule:"required;",msg:{required:"请输入支付名称"},tip:"请输入支付名称",ok:"",},
            payDesc: {rule:"required;",msg:{required:"请输入支付描述"},tip:"请输入支付描述",ok:"",},
            payOrder: {rule:"required;",msg:{required:"请输入排序号"},tip:"请输入排序号",ok:"",},
            /*微信验证*/
            appId: {rule:"required;",msg:{required:"请输入APPID"},tip:"请输入APPID",ok:"",},
            mchId: {rule:"required;",msg:{required:"请输入微信支付商户号(mch_id)"},tip:"请输入微信支付商户号(mch_id)",ok:"",},
            apiKey: {rule:"required;",msg:{required:"请输入API密钥(key)"},tip:"请输入API密钥(key)",ok:"",},
            appsecret: {rule:"required;",msg:{required:"请输入Appsecret"},tip:"请输入Appsecret",ok:"",},
            /*支付宝验证*/
            payAccount: {rule:"required;",msg:{required:"请输入支付宝账户"},tip:"请输入支付宝账户",ok:"",},
            parterID: {rule:"required;",msg:{required:"请输入合作者身份(parterID)"},tip:"请输入合作者身份(parterID)",ok:"",},
            parterKey: {rule:"required;",msg:{required:"请输入交易安全校验码(key"},tip:"请输入交易安全校验码(key",ok:"",},
            /*银联支付验证*/
            unionAccount: {rule:"required;",msg:{required:"请输入银联商户账号"},tip:"请输入银联商户账号",ok:"",},
            unionSignCertPwd: {rule:"required;",msg:{required:"请输入签名证书密码"},tip:"请输入签名证书密码",ok:"",},
            /*APP支付宝支付*/
            rsaPrivateKey: {rule:"required;",msg:{required:"请输入应用私钥"},tip:"请输入应用私钥",ok:"",},
            alipayrsaPublicKey: {rule:"required;",msg:{required:"请输入支付宝公钥"},tip:"请输入支付宝公钥",ok:"",}  
        },
        valid:function(form){
          edit($('#id').val())
        },
  });

});