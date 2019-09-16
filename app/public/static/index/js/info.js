$(function(){
   layui.use('laydate', function(){
  var laydate = layui.laydate;
  //常规用法
  laydate.render({
    elem: '#brithday'
  });
});

  /* 表单验证 */
  $('#userEditForm').validator({
          fields: {
              nickName: {rule:"required",msg:{required:"请输入昵称"},tip:"请输入昵称"},
              userSex:  {rule:"checked;",msg:{checked:"至少选择一项"},tip:"请选择您的性别"},
              trueName:  {rule:"required;",msg:{required:"请输入真实姓名"},tip:"请输入真实姓名"},
              userEmail:  {rule:"required;",msg:{required:"请输入Email"},tip:"请输入Email"}
          },
        valid: function(form){
          var params = getParams('.ipt');
          
          //if(!userPic){
            //userPic = $('#userPic').val();
          //}
          //接收上传的头像路径
          //params.userPhoto = userPic;
          var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
          $.post('/index/center/toEditInfo',params,function(data,textStatus){
            layer.close(loading);
            var json = toJson(data);
            if(json.status=='1'){
                layer.msg("操作成功",{icon:1});
                location.reload();
                return;
            }else{
                  layer.msg(json.msg,{icon:2});
            }
          });
      },
  });
});