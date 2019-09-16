layui.use(['table', 'element', 'layer', 'form'], function() {
    var element = layui.element,
        table = layui.table,
        layer = layui.layer,
        $ = layui.jquery,
        form = layui.form;

    /**
     * iframe弹窗
     * @href 弹窗地址
     * @title 弹窗标题
     * @lay-data {width: '弹窗宽度', height: '弹窗高度', idSync: '是否同步ID', table: '数据表ID(同步ID时必须)', type: '弹窗类型'}
     */
    $(document).on('click', '.layui-iframe', function() {
        var that = $(this),
            query = '';
        var def = { width: '750px', height: '500px', idSync: false, table: 'dataTable', type: 2, url: that.attr('href'), title: that.attr('title') };
        var opt = new Function('return ' + that.attr('lay-data'))() || {};

        opt.url = opt.url || def.url;
        opt.title = opt.title || def.title;
        opt.width = opt.width || def.width;
        opt.height = opt.height || def.height;
        opt.type = opt.type || def.type;
        opt.table = opt.table || def.table;
        opt.idSync = opt.idSync || def.idSync;

        if (!opt.url) {
            layer.msg('请设置href参数');
            return false;
        }

        if (opt.idSync) { // ID 同步
            if ($('.checkbox-ids:checked').length <= 0) {
                var checkStatus = table.checkStatus(opt.table);
                if (checkStatus.data.length <= 0) {
                    layer.msg('请选择要操作的数据');
                    return false;
                }

                for (var i in checkStatus.data) {
                    query += '&id[]=' + checkStatus.data[i].id;
                }
            } else {
                $('.checkbox-ids:checked').each(function() {
                    query += '&id[]=' + $(this).val();
                })
            }
        }

        if (opt.url.indexOf('?') >= 0) {
            opt.url += '&iframe=yes' + query;
        } else {
            opt.url += '?iframe=yes' + query;
        }

        layer.open({ type: opt.type, title: opt.title, content: opt.url, area: [opt.width, opt.height] });
        return false;

    });

    /**
     * 通用表格行数据行删除
     * @attr href或data-href 请求地址
     * @attr refresh 操作完成后是否自动刷新
     */
    $(document).on('click', '.layui-tr-del', function() {
        var that = $(this),
            href = !that.attr('data-href') ? that.attr('href') : that.attr('data-href');
        layer.confirm('删除之后无法恢复，您确定要删除吗？', { icon: 3, title: '提示信息' }, function(index) {
            if (!href) {
                layer.msg('请设置data-href参数');
                return false;
            }
            $.get(href, function(res) {
                if (res.code == 0) {
                    layer.msg(res.msg);
                } else {
                    that.parents('tr').remove();
                }
            });
            layer.close(index);
        });
        return false;
    });

    /**
     * 列表页批量操作按钮组
     * @attr href 操作地址
     * @attr data-table table容器ID
     * @class confirm 类似系统confirm
     * @attr tips confirm提示内容
     */
    $(document).on('click', '.layui-batch-all', function() {
        var that = $(this),
            query = '',
            code = function(that) {
                var href = that.attr('href') ? that.attr('href') : that.attr('data-href');
                var tableObj = that.attr('data-table') ? that.attr('data-table') : 'dataTable';
                if (!href) {
                    layer.msg('请设置data-href参数');
                    return false;
                }

                if ($('.checkbox-ids:checked').length <= 0) {
                    var checkStatus = table.checkStatus(tableObj);
                    if (checkStatus.data.length <= 0) {
                        layer.msg('请选择要操作的数据');
                        return false;
                    }
                    for (var i in checkStatus.data) {
                        if (i > 0) {
                            query += '&';
                        }
                        query += 'ids[]=' + checkStatus.data[i].id;
                    }
                } else {
                    if (that.parents('form')[0]) {
                        query = that.parents('form').serialize();
                    } else {
                        query = $('#pageListForm').serialize();
                    }
                }

                layer.msg('数据提交中...', { time: 500000 });
                $.post(href, query, function(res) {
                    layer.msg(res.msg, {}, function() {
                        if (res.code != 0) {
                            location.reload();
                        }
                    });
                });
            };
        if (that.hasClass('confirm')) {
            var tips = that.attr('tips') ? that.attr('tips') : '您确定要执行此操作吗？';
            layer.confirm(tips, { icon: 3, title: '提示信息' }, function(index) {
                code(that);
                layer.close(index);
            });
        } else {
            code(that);
        }
        return false;
    });

    /*$('[title]').hover(function() {
        var title = $(this).attr('title');
        layer.tips(title, $(this))
    }, function() {
        layer.closeAll('tips')
    })*/

    /**
     * 通用状态设置开关
     * @attr data-href 请求地址
     */
    form.on('switch(switchStatus)', function(data) {
        var that = $(this),
            status = 0;
        if (!that.attr('data-href')) {
            layer.msg('请设置data-href参数');
            return false;
        }
        if (this.checked) {
            status = 1;
        }
        $.get(that.attr('data-href'), { status: status }, function(res) {
            layer.msg(res.msg);
            if (res.code == 0) {
                that.trigger('click');
                form.render('checkbox');
            }
        });
    });

    //ajax get请求
    $(document).on('click', '.ajax-get', function() {
        var that = $(this),
            href = !that.attr('data-href') ? that.attr('href') : that.attr('data-href'),
            refresh = !that.attr('refresh') ? 'true' : that.attr('refresh');
        if (!href) {
            layer.msg('请设置data-href参数');
            return false;
        }
        if ($(this).hasClass('confirm')) {
            layer.confirm('确认要执行该操作吗?', { icon: 3, title: '提示' }, function(index) {
                $.get(href, {}, function(res) {
                    layer.msg(res.msg, {}, function() {
                        if (refresh == 'true' || refresh == 'yes') {
                            if (typeof(res.url) != 'undefined' && res.url != null && res.url != '') {
                                location.href = res.url;
                            } else {
                                location.reload();
                            }
                        }
                    });
                });
            });
        } else {
            $.get(href, {}, function(res) {
                layer.msg(res.msg, {}, function() {
                    if (refresh == 'true') {
                        if (typeof(res.url) != 'undefined' && res.url != null && res.url != '') {
                            location.href = res.url;
                        } else {
                            location.reload();
                        }
                    }
                });
            });
        };
        return false;
    });

    /**
     * 监听表单提交
     * @attr action 请求地址
     * @attr data-form 表单DOM
     */
    form.on('submit(formSubmit)', function(data) {
        var _form = '',
            that = $(this),
            text = that.text(),
            options = { pop: false, refresh: true, jump: false, callback: null };
        if ($(this).attr('data-form')) {
            _form = $(that.attr('data-form'));
        } else {
            _form = that.parents('form');
        }

        if (that.attr('lay-data')) {
            options = new Function('return ' + that.attr('lay-data'))();
        }

        that.prop('disabled', true).text('提交中...');
        $.ajax({
            type: "POST",
            url: _form.attr('action'),
            data: _form.serialize(),
            success: function(res) {
                that.text(res.msg);
                if (res.code == 0) {
                    that.prop('disabled', true).removeClass('layui-btn-normal').addClass('layui-btn-danger');
                    setTimeout(function() {
                        that.prop('disabled', false).removeClass('layui-btn-danger').addClass('layui-btn-normal').text(text);
                    }, 3000);
                } else {
                    setTimeout(function() {
                        that.text(text).prop('disabled', false);
                        if (options.callback) {
                            options.callback(that, res);
                        }
                        if (options.pop == true) {
                            if (options.refresh == true) {
                                parent.location.reload();
                            } else if (options.jump == true && res.url != '') {
                                parent.location.href = res.url;
                            }
                            parent.layui.layer.closeAll();
                        } else if (options.refresh == true) {
                            if (res.url != '') {
                                location.href = res.url;
                            } else {
                                location.reload();
                            }
                        }
                    }, 3000);
                }
            }
        });
        return false;
    });

    //通用表单post提交
    $('.ajax-post').on('click', function(e) {
        var target, query, _form,
            target_form = $(this).attr('target-form'),
            that = this,
            nead_confirm = false;

        _form = $('.' + target_form);
        if ($(this).attr('hide-data') === 'true') {
            _form = $('.hide-data');
            query = _form.serialize();
        } else if (_form.get(0) == undefined) {
            return false;
        } else if (_form.get(0).nodeName == 'FORM') {
            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }
            if ($(this).attr('url') !== undefined) {
                target = $(this).attr('url');
            } else {
                target = _form.attr("action");
            }
            query = _form.serialize();
        } else if (_form.get(0).nodeName == 'INPUT' || _form.get(0).nodeName == 'SELECT' || _form.get(0).nodeName == 'TEXTAREA') {
            _form.each(function(k, v) {
                if (v.type == 'checkbox' && v.checked == true) {
                    nead_confirm = true;
                }
            })
            if (nead_confirm && $(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }
            query = _form.serialize();
        } else {
            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }
            query = _form.find('input,select,textarea').serialize();
        }

        $.post(target, query).success(function(data) {
            if (data.code == 1) {
                parent.layui.layer.closeAll();
                if (data.url) {
                    layer.msg(data.msg + ' 页面即将自动跳转~');
                } else {
                    layer.msg(data.msg);
                }
                setTimeout(function() {
                    if (data.url) {
                        location.href = data.url;
                    } else {
                        location.reload();
                    }
                }, 1500);
            } else {
                layer.msg(data.msg);
                setTimeout(function() {
                    if (data.url) {
                        location.href = data.url;
                    }
                }, 1500);
            }
        });
        return false;
    });

});


upload = function(opts){
    var _opts = {};
    _opts = $.extend(_opts,{duplicate:true,auto: true,swf: '__STATIC__/libs/plugins/webuploader/Uploader.swf',server:'/admin/goods/uploadPic'},opts);
    var uploader = WebUploader.create(_opts);
    uploader.on('uploadSuccess', function( file,response ) {
        
        //var json = this.toAdminJson(response._raw);

        if(_opts.callback)_opts.callback(response._raw,file);
    });
    uploader.on('uploadError', function( file ) {
        if(_opts.uploadError)_opts.uploadError();
    });
    uploader.on( 'uploadProgress', function( file, percentage ) {
        percentage = percentage.toFixed(2)*100;
        if(_opts.progress)_opts.progress(percentage);
    });
    return uploader;
}

toAdminJson = function(str){
    var json = {};
    try{
        if(typeof(str )=="object"){
            json = str;
        }else{
            json = eval("("+str+")");
        }
        if(json.status && json.status=='-999'){
            layer.msg('对不起，您已经退出系统！请重新登录',{icon:5},function(){
                if(window.parent){
                    window.parent.location.reload();
                }else{
                    location.reload();
                }
            });
        }else if(json.status && json.status=='-998'){
            layer.msg('对不起，您没有操作权限，请与管理员联系');
            return;
        }
    }catch(e){
        layer.msg("系统发生错误:"+e.getMessage,{icon:5});
        json = {};
    }
    return json;
}


pageHeight = function(){
    if(checkBrowser().msie){ 
        return document.compatMode == "CSS1Compat"? document.documentElement.clientHeight : 
        document.body.clientHeight; 
    }else{ 
        return self.innerHeight; 
    } 
};

 function setValues(obj){

    var input,value,val;
    for(var key in obj){
        if($('#'+key)[0]){
            setValue('#'+key,obj[key]);
        }else if($("[name='" + key + "']")[0]){
            setValue(key,obj[key]);
        }
    }
}

function setValue(name, value){
    var first = name.substr(0,1), input, i = 0, val;
    if("#" === first || "." === first){
        input = $(name);
    } else {
        input = $("[name='" + name + "']");
    }

    if(input.eq(0).is(":radio")) { //单选按钮
        input.filter("[value='" + value + "']").each(function(){this.checked = true});
    } else if(input.eq(0).is(":checkbox")) { //复选框
        if(!$.isArray(value)){
            val = new Array();
            val[0] = value;
        } else {
            val = value;
        }
        for(i = 0, len = val.length; i < len; i++){
            input.filter("[value='" + val[i] + "']").each(function(){this.checked = true});
        }
    } else {  //其他表单选项直接设置值
        input.val(value);
    }
}


checkBrowser = function(){
    return {
        mozilla : /firefox/.test(navigator.userAgent.toLowerCase()),
        webkit : /webkit/.test(navigator.userAgent.toLowerCase()), 
        opera : /opera/.test(navigator.userAgent.toLowerCase()), 
        msie : /msie/.test(navigator.userAgent.toLowerCase())
    }
}

getParams = function(obj){
    var params = {};
    var chk = {},s;
    $(obj).each(function(){
        if($(this)[0].type=='hidden' || $(this)[0].type=='number' || $(this)[0].type=='tel' || $(this)[0].type=='password' || $(this)[0].type=='select-one' || $(this)[0].type=='textarea' || $(this)[0].type=='text'){
            params[$(this).attr('id')] = $.trim($(this).val());
        }else if($(this)[0].type=='radio'){
            if($(this).attr('name')){
                params[$(this).attr('name')] = $('input[name='+$(this).attr('name')+']:checked').val();
            }
        }else if($(this)[0].type=='checkbox'){
            if($(this).attr('name') && !chk[$(this).attr('name')]){
                s = [];
                chk[$(this).attr('name')] = 1;
                $('input[name='+$(this).attr('name')+']:checked').each(function(){
                    s.push($(this).val());
                });
                params[$(this).attr('name')] = s.join(',');
            }
        }
    });
    chk=null,s=null;
    return params;
}


/**
 * 循环创建商品分类
 * @param id            当前分类ID
 * @param val           当前分类值
 * @param className     样式，方便将来获取值
 * @param isRequire     是否要求必填
 * @param beforeFunc    运行前回调函数
 * @param afterFunc     运行后回调函数
 */
ITGoodsCats = function(opts){

    opts.className = opts.className?opts.className:"j-goodsCats";
    var obj = $('#'+opts.id);
    obj.attr('lastgoodscat',1);
    var level = parseInt(obj.attr('level'),10)+1;
    $("select[id^='"+opts.id+"_']").remove();
    if(opts.isRequire)$('.msg-box[for^="'+opts.id+'_"]').remove();
    if(opts.beforeFunc){
        if(typeof(opts.beforeFunc)=='function'){
            opts.beforeFunc({id:opts.id,val:opts.val});
        }else{
           var fn = window[opts.beforeFunc];
           fn({id:opts.id,val:opts.val});
        }
    }
    opts.lastVal = opts.val;
    if(opts.val==''){
        obj.removeAttr('lastgoodscat');
        var lastId = 0,level = 0,tmpLevel = 0,lasObjId;
        $('.'+opts.className).each(function(){
            tmpLevel = parseInt($(this).attr('level'),10);
            if(level <= tmpLevel && $(this).val()!=''){
                level = tmpLevel;
                lastId = $(this).val();
                lasObjId = $(this).attr('id');
            }
        })
        $('#'+lasObjId).attr('lastgoodscat',1);
        opts.id = lasObjId;
        opts.val = $('#'+lasObjId).val();
        opts.isLast = true;
        opts.lastVal = opts.val;
        if(opts.afterFunc){
            if(typeof(opts.afterFunc)=='function'){
                opts.afterFunc(opts);
            }else{
                var fn = window[opts.afterFunc];
                fn(opts);
            }
        }
        return;
    }
    $.post('/admin/goods/listQuery',{parentId:opts.val},function(data,textStatus){
         var json = toAdminJson(data);
         if(json.data && json.data.length>0){
            json = json.data;
            var html = [];
            var tid = opts.id+"_"+opts.val;
            html.push("<select id='"+tid+"' level='"+level+"' class='"+opts.className+"' "+(opts.isRequire?" data-rule='required;' ":"")+">");
            html.push("<option value='' >-请选择-</option>");
            for(var i=0;i<json.length;i++){
                 var cat = json[i];
                 html.push("<option value='"+cat.catId+"'>"+cat.catName+"</option>");
            }
            html.push('</select>');
            $(html.join('')).insertAfter(obj);
            $("#"+tid).change(function(){
                opts.id = tid;
                opts.val = $(this).val();
                if(opts.val!=''){
                    obj.removeAttr('lastgoodscat');
                }
                ITGoodsCats(opts);
            })
         }else{
             opts.isLast = true;
             opts.lastVal = opts.val;
         }
         if(opts.afterFunc){
             if(typeof(opts.afterFunc)=='function'){
                 opts.afterFunc(opts);
             }else{
                 var fn = window[opts.afterFunc];
                 fn(opts);
             }
         }
    });
}

$.fn.TabPanel = function(options){
    var defaults = {tab: 0}; 
    var opts = $.extend(defaults, options);
    var t = this;
    
    $(t).find('.pyg-tab-nav li').click(function(){
        $(this).addClass("on").siblings().removeClass();
        var index = $(this).index();
        $(t).find('.pyg-tab-content .pyg-tab-item').eq(index).show().siblings().hide();
        if(opts.callback)opts.callback(index);
    });
    $(t).find('.pyg-tab-nav li').eq(opts.tab).click();
}

toJson = function(str){
    var json = {};
    try{
        if(typeof(str )=="object"){
            json = str;
        }else{
            json = eval("("+str+")");
        }
        if(json.status && json.status=='-999'){
            alert('对不起，您已经退出系统！请重新登录');
            if(window.parent){
                window.parent.location.reload();
            }else{
                location.reload();
            }
        }else if(json.status && json.status=='-998'){
            alert('对不起，您没有操作权限，请与管理员联系');
            return;
        }
    }catch(e){
        alert("系统发生错误:"+e.getMessage,{icon:5});
        json = {};
    }
    return json;
}

 //只能輸入數字和小數點
 isNumberdoteKey = function(evt){
    var e = evt || window.event; 
    var srcElement = e.srcElement || e.target;
    
    var charCode = (evt.which) ? evt.which : event.keyCode;         
    if (charCode > 31 && ((charCode < 48 || charCode > 57) && charCode!=46)){
        return false;
    }else{
        if(charCode==46){
            var s = srcElement.value;           
            if(s.length==0 || s.indexOf(".")!=-1){
                return false;
            }           
        }       
        return true;
    }
 }

 //只能輸入數字和字母
 isNumberCharKey = function(evt){
    var e = evt || window.event; 
    var srcElement = e.srcElement || e.target;  
    var charCode = (evt.which) ? evt.which : event.keyCode;

    if((charCode>=48 && charCode<=57) || (charCode>=65 && charCode<=90) || (charCode>=97 && charCode<=122) || charCode==8){
        return true;
    }else{      
        return false;
    }
 }

isChinese = function(obj,isReplace){
    var pattern = /[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/i
    if(pattern.test(obj.value)){
        if(isReplace)obj.value=obj.value.replace(/[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/ig,"");
        return true;
    }
    return false;
 }   

 limitDecimal = function(obj,len){
    var s = obj.value;
    if(s.indexOf(".")>-1){
        if((s.length - s.indexOf(".")-1)>len){
            obj.value = s.substring(0,s.indexOf(".")+len+1);
        }
    }
    s = null;
}

isNumberKey = function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }else{      
        return true;
    }
 }

 /**
 * 获取最后分类值
 */
ITGetGoodsCatVal = function(className){
    var goodsCatId = '';
    $('.'+className).each(function(){
        if($(this).attr('lastgoodscat')=='1')goodsCatId = $(this).val();
    });
    return goodsCatId;
}

//退出
logout = function(){
    $.post('index/users/logout',{},function(data,textStatus){
        var json = toJson(data);
        layer.msg(json.msg,{icon:1});
        location.href='/';
    });
}

//搜索
search = function(){
    goodsSearch($.trim($('#search-ipt').val()));
}

//商品搜索
goodsSearch = function(v){

    location.href = 'search?keyword='+v;
}

//登陆弹出框

loginWindow = function(){
    currentUrl();
    $.post('index/users/toLoginBox',{},function(data){
        open({type:1,area:['550px','340px'],offset:'auto',title:'用户登录',content:data});
    });
}

currentUrl = function(url){
    if(!url)var url = window.location.href;

    $.post('index/index/currenturl',{url:url},function(data){});
}

open = function(options){
    var opts = {};
    opts = $.extend(opts, {offset:'100px'}, options);
    return layer.open(opts);
}

like = function(){
            var str1 = '';
            $.post("index/index/getLikeGoods",function(data){
                    $.each(data,function(i,subobj) {

                        str1 += '<li class="yui3-u-1-6">';
                        str1 += '<dl class="picDl huozhe">';
                        str1 += '<dd>';
                        str1 += '<a href="" class="pic" title="'+ subobj.goodsName +'"><img src="'+ subobj.goodsImg +'" alt="" /></a>';
                        str1 += '<div class="like-text">';
                        str1 += '<p style="height:50px">'+ subobj.goodsName.substr(1,35)+'</p>';
                        str1 += '<h3>¥'+ subobj.marketPrice+'</h3>';
                        str1 += '</div>';
                        str1 += '</dd>';
                        str1 += '</dl>';
                        str1 += '</li>';

                        $("#picLBxxl").html(str1);
    
                }); 
            });
}

//收藏商品
addFavorite = function(obj,type,id,fId){
    if(window.conf.IS_LOGIN==0){
        this.loginWindow();
        return;
    }
    $.post('index/favorites/add',{type:type,id:id},function(data,textStatus){
         var json = toJson(data);
         if(json.status==1){
             layer.msg(json.msg,{icon:1});
            location.reload();
         } else {
             layer.msg(json.msg,{icon:2});
         }
    });
}

//取消收藏
cancelFavorite = function(obj,type,id){
    if(window.conf.IS_LOGIN==0){
        this.loginWindow();
        return;
    }
    var param = {};
    param.id = id;
    $.post('index/favorites/cancel',param,function(data,textStatus){
        var json = toJson(data);
        if(json.status=='1'){
            layer.msg(json.msg,{icon:1});
            location.reload();
        } else {
           layer.msg(json.msg,{icon:5});
        }
    });
}







