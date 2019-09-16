var mmg;
var mmg1;

/**初始化**/
function initEdit(){
	$('#tab').TabPanel({tab:0,callback:function(no){
		if(no==1){
			$('.j-specImg').children().each(function(){
				if(!$(this).hasClass('webuploader-pick'))$(this).css({width:'80px',height:'25px'});
			});
		}
		if(!initBatchUpload && no==2){
			initBatchUpload = true;
			var uploader = batchUpload({uploadPicker:'#batchUpload',uploadServer:'/admin/goods/uploadPic',formData:{dir:'goods',isWatermark:1,isThumb:1},uploadSuccess:function(file,response){
				var json = toJson(response);
				if(json.status==1){
					$li = $('#'+file.id);
					$li.append('<input type="hidden" class="j-gallery-img" iv="'+json.savePath + json.thumb+'" v="' +json.savePath + json.name+'"/>');
	                var delBtn = $('<span class="btn-del">删除</span>');
	                $li.append(delBtn);
	                delBtn.on('click',function(){
	                	delBatchUploadImg($(this),function(){
	                		if($('.filelist').find('li').length==0){
	                			$("#batchUpload").find('.placeholder').removeClass( 'element-invisible' );
						        $('.filelist').parent().removeClass('filled');
						        $('.filelist').hide();
						        $("#batchUpload").find('.statusBar').addClass( 'element-invisible' );
	                		}
	                		uploader.removeFile(file);
	        				uploader.refresh();
	                	});
	    			});
	                $('.filelist li').css('border','1px solid rgb(59, 114, 165)');
				}else{
					layer.msg(json.msg,{icon:2});
				}
			}});
		}
		$('.btn-del').click(function(){
			delBatchUploadImg($(this),function(){
				if($('.filelist').find('li').length==0){
        			$("#batchUpload").find('.placeholder').removeClass( 'element-invisible' );
			        $('.filelist').parent().removeClass('filled');
			        $('.filelist').hide();
			        $("#batchUpload").find('.statusBar').addClass( 'element-invisible' );
			        uploader.refresh();
        		}
        		$(this).parent().remove();
        	});
		})
	}});
	KindEditor.ready(function(K) {
		editor1 = K.create('textarea[name="goodsDesc"]', {
		  height:'350px',
		  width:'800px',
		  uploadJson : '/admin/goods/editorUpload',
		  allowFileManager : false,
		  allowImageUpload : true,
		  allowMediaUpload : false,
		  items:[
			          'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
			          'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
			          'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
			          'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
			          'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
			          'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|','image','multiimage','media','table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
			          'anchor', 'link', 'unlink', '|', 'about'
		  ],
		  afterBlur: function(){ this.sync(); }
		});
	});
	if(OBJ.goodsId>0){
		var goodsCatIds = OBJ.goodsCatIdPath.split('_');
		getBrands('brandId',goodsCatIds[0],OBJ.brandId);
		if(goodsCatIds.length>1){
			var objId = goodsCatIds[0];
			$('#cat_0').val(objId);
			var opts = {id:'cat_0',val:goodsCatIds[0],childIds:goodsCatIds,className:'j-goodsCats',afterFunc:'lastGoodsCatCallback'}
        	ITSetGoodsCats(opts);
	    }
		getShopsCats('shopCatId2',OBJ.shopCatId1,OBJ.shopCatId2);
	}	
}

/**获取品牌**/
function getBrands(objId,catId,objVal){
	$('#'+objId).empty();
	$.post('/admin/goods/listBrandQuery',{catId:catId},function(data,textStatus){
	     var json = toJson(data);
	     var html = [],cat;
	     html.push("<option value='' >-请选择-</option>");
	     if(json.status==1 && json.list){
	    	 json = json.list;
			 for(var i=0;i<json.length;i++){
			     cat = json[i];
			     html.push("<option value='"+cat.brandId+"' "+((objVal==cat.brandId)?"selected":"")+">"+cat.brandName+"</option>");
			 }
	     }
	     $('#'+objId).html(html.join(''));
	});
}

//跳去编辑页面
function toEdit(id,src) {
	location.href = '/admin/goods/editGoods?id='+id+'&p='+PYG_CURR_PAGE;
}

//跳去秒杀编辑页面
function toEdit1(id,src) {
	location.href = '/admin/seckill/editGoods?id='+id+'&p='+PYG_CURR_PAGE;
}

//跳去秒杀页面
function seckill(id,src) {
	location.href = '/admin/goods/seckillGoods?id='+id+'&p='+PYG_CURR_PAGE;
}

//跳去添加页面
function toAdd() {
    location.href = '/admin/goods/addGoods';
}

/**保存商品数据**/
function save(p) {
	var va = $("input[name='defaultSpec']:checked").val();
	if(va){
		$("#marketPrice").val($("#marketPrice_"+va).val());
	}
	$('#editform').isValid(function(v){
		if(v){
			var params = getParams('.j-ipt');
			var m1 = [];
			$("input[name^=gallery]").each(function(a_Idx, a_Elmt) { m1.push(a_Elmt.value); });
			params.goodsCatId = ITGetGoodsCatVal('j-goodsCats');
			params.gallery = m1;
			var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
		    $.post('/admin/goods/'+((params.goodsId==0)?"toAddGoods":"toEditGoods"),params,function(data,textStatus){
		    	layer.close(loading);
		    	var json = toJson(data);
		    	if(json.status=='1') {
		    		layer.msg(json.msg,{icon:1},function(){
						location.href='/admin/goods/index?p='+p;
					});
		    	} else {
		    		layer.msg(json.msg,{icon:2});
		    	}
		    });
		}
	});
}


//秒杀商品列表
function saleByPage1(p){
    var h = pageHeight();
    var cols = [

      {title:'商品图片', name:'image', width: 150, renderer: function(val,item,rowIndex){
                 return "<span class='weixin'><img  style='height:100px;width:100px;' src='"+item['image']
                 +"'></span>";
             }},
        {title:'商品名称', name:'title', width: 250, renderer: function(val,item,rowIndex){
        	return val;
        }},
        {title:'商品编号', name:'goods_sn', width: 100},
        {title:'原价', name:'ot_price', width: 50},
        {title:'秒杀价', name:'price', width: 50},
        {title:'库存', name:'stock', width: 40},
        {title:'秒杀状态', name:'status', width: 30, renderer:function(val,item,rowIndex){
            	 if(item['status']==1){
                     return "<span class='statu-yes'><i class='fa'></i>正在进行中</span>";
                 } else {
            	 	return "<span class='statu-no'><i class='fa'></i>已关闭</span>";
            	 }
        }},
        {title:'秒杀剩余时间', name:'stop_time', width: 50, renderer:function(val,item,rowIndex){
            	return '<div><strong id="'+item['seckillId']+'-DD"></strong>天 <strong id="'+item['seckillId']+'-HH"></strong>时 <strong id="'+item['seckillId']+'-MM"></strong>分 <strong id="'+item['seckillId']+'-SS"></strong>秒</div>';
            }},
        {title:'操作', name:'' ,width:200, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
                h += "<a class='btn btn-blue' href='javascript:toEdit1("+ item['seckillId']+",\"sale\")'><i class='fa fa-pencil'></i>修改</a> ";
                h += "<a class='btn btn-red' href='javascript:del1(" + item['seckillId'] + ",\"sale\")'><i class='fa fa-trash-o'></i>删除</a> ";
				h += "<a class='btn btn-red' href='javascript:showTime(" + item['seckillId'] + ",\"sale\")'><i class='fa'></i>查看剩余时间</a> ";
                
                return h;
            }}
    ];
    mmg1 = $('.mmg1').mmGrid({height: h-122,indexCol: true, cols: cols,method:'POST',
        url: '/admin/seckill/saleByPage', fullWidthRows: true, autoLoad: false,checkCol:true,multiSelect:true,
        plugins: [
            $('#pg1').mmPaginator({})
        ]
    });
   loadGrid1(p);
}

//商品列表
function saleByPage(p){
    var h = pageHeight();
    var cols = [

      {title:'商品图片', name:'img', width: 150, renderer: function(val,item,rowIndex){
                 return "<span class='weixin'><img  style='height:100px;width:100px;' src='"+item['goodsImg']
                 +"'></span>";
             }},
        {title:'商品名称', name:'goodsName', width: 250, renderer: function(val,item,rowIndex){
        	return val;
                
        }},
        {title:'商品编号', name:'goodsSn', width: 100},
        {title:'价格(￥)', name:'marketPrice', width: 50},
        {title:'售卖状态', name:'isSale', width: 30,renderer:function(val,item,rowIndex){
                if(item['isSale']==1) {
                    return "<span class='statu-yes'><i class='fa fa-check-circle'></i> 上架</span>";
                } else {
                    return "<span class='statu-wait'><i class='fa fa-clock-o'></i> 下架</span>";
                }
            }},
        {title:'推荐', name:'isRecom', width: 30,renderer:function(val,item,rowIndex){
                if(item['isRecom']==1) {
                    return "<span class='statu-yes'><i class='fa fa-check-circle'></i> 是</span>";
                } else {
                    return "<span class='statu-wait'><i class='fa fa-clock-o'></i> 否</span>";
                }
            }},
        {title:'特价', name:'isBest', width: 30,renderer:function(val,item,rowIndex){
                if(item['isBest']==1) {
                    return "<span class='statu-yes'><i class='fa fa-check-circle'></i> 是</span>";
                } else {
                    return "<span class='statu-wait'><i class='fa fa-clock-o'></i> 否</span>";
                }
            }},
        {title:'新品', name:'isNew', width: 30,renderer:function(val,item,rowIndex){
                if(item['isNew']==1) {
                    return "<span class='statu-yes'><i class='fa fa-check-circle'></i> 是</span>";
                } else {
                    return "<span class='statu-wait'><i class='fa fa-clock-o'></i> 否</span>";
                }
            }},
        {title:'热卖', name:'isHot', width: 30,renderer:function(val,item,rowIndex){
                if(item['isHot']==1) {
                    return "<span class='statu-yes'><i class='fa fa-check-circle'></i> 是</span>";
                } else {
                    return "<span class='statu-wait'><i class='fa fa-clock-o'></i> 否</span>";
                }
            }},
        {title:'库存', name:'goodsStock', width: 40},
        {title:'操作', name:'' ,width:200, align:'center', renderer: function(val,item,rowIndex){
                var h = "";
                h += "<a class='btn btn-blue' href='javascript:toEdit("+ item['goodsId']+",\"sale\")'><i class='fa fa-pencil'></i>修改</a> ";
                h += "<a class='btn btn-red' href='javascript:del(" + item['goodsId'] + ",\"sale\")'><i class='fa fa-trash-o'></i>删除</a> ";
                h += "<a class='btn btn-red' href='javascript:seckill(" + item['goodsId'] + ",\"sale\")'><i class='fa'></i>开启秒杀</a> ";
                return h;
            }}
    ];
    mmg = $('.mmg').mmGrid({height: h-122,indexCol: true, cols: cols,method:'POST',
        url: '/admin/goods/saleByPage', fullWidthRows: true, autoLoad: false,checkCol:true,multiSelect:true,
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });
    loadGrid(p);
}

//删除商品
function del(id,func){
    layer.confirm('您确定要删除商品吗', {icon: 3, title:'提示'}, function(index){
      	var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      	$.post('/admin/goods/delGoods',{id:id},function(data,textStatus){
            layer.close(loading);
            if (data.status == 1) {
                layer.msg(data.msg,{icon:1});
                loadGrid(PYG_CURR_PAGE)    
            } else {
                layer.msg(data.msg,{icon:2});
            }
        });
    });
}

//加载商品列表
function loadGrid(p){
    p = (p<=1)?1:p;
    mmg.load({cat1:$('#cat1').val(),cat2:$('#cat2').val(),goodsName:$('#goodsName').val(),page:p});
}

//加载秒杀产品
function loadGrid1(p){
    p = (p<=1)?1:p;
    mmg1.load({title:$('#title').val(),page:p});
}

//商品编辑页返回
function toBack(p,src){
    p = (p<=1)?1:p;
    if(src) {
        location.href = WST.U('shop/goods/'+src,'p='+p);
	} else {
        location.reload();
	}


}

//重置表单
function resetForm(){
	location.reload();
}


//查看倒计时时间
function showTime(id){
    $.post('/admin/seckill/showtime',{id:id},function(data,textStatus){
        var currentDate = new Date();
		var EndTime=new Date(data['stop_time']);  
		var days= EndTime - currentDate; 
		EndTimeMsg = parseInt(days / 1000);//精确到秒
		show(data['seckillId']);
    });
}

//显示剩余时间
function show(id) {
    h = Math.floor(EndTimeMsg / 60 / 60);
    m = Math.floor((EndTimeMsg - h * 60 * 60) / 60);
    s = Math.floor((EndTimeMsg - h * 60 * 60 - m * 60));
    document.getElementById(id+"-DD").innerHTML = parseInt(h/24);
    document.getElementById(id+"-HH").innerHTML = h;
    document.getElementById(id+"-MM").innerHTML = m;
    document.getElementById(id+"-SS").innerHTML = s;
    EndTimeMsg--;
    if (EndTimeMsg < 0)
    {
        document.getElementById(id+"-DD").innerHTML = "0";
        document.getElementById(id+"-HH").innerHTML = "00";
        document.getElementById(id+"-MM").innerHTML = "00";
        document.getElementById(id+"-SS").innerHTML = "00";;
    }
  }
  setInterval("show(id)", 1000)


/**添加秒杀商品数据**/
function saveSeckill(p) {
	
	$('#editseckillform').isValid(function(v){
		if(v){
			var params = getParams('.j-ipt');

			var m1 = [];
			$("input[name^=gallery]").each(function(a_Idx, a_Elmt) { m1.push(a_Elmt.value); });
			
			params.gallery = m1;

			var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
		    $.post('/admin/goods/toAddSeckillGoods',params,function(data,textStatus){
		    	layer.close(loading);
		    	var json = toJson(data);
		    	if(json.status=='1') {
		    		layer.msg(json.msg,{icon:1},function(){
						location.href='/admin/goods/index?p='+p;
					});
		    	} else {
		    		layer.msg(json.msg,{icon:2});
		    	}
		    });
		}
	});
}


/**编辑秒杀商品数据**/
function editSeckill(p) {
	
	$('#editseckillform1').isValid(function(v){
		if(v){
			var params = getParams('.j-ipt');
			var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
		    $.post('/admin/seckill/toEditGoods',params,function(data,textStatus){
		    	layer.close(loading);
		    	var json = toJson(data);
		    	if(json.status=='1') {
		    		layer.msg(json.msg,{icon:1},function(){
						location.href='/admin/seckill/index?p='+p;
					});
		    	} else {
		    		layer.msg(json.msg,{icon:2});
		    	}
		    });
		}
	});
}


/**删除秒杀商品数据**/
function del1(id,func){
    layer.confirm('您确定要删除商品吗', {icon: 3, title:'提示'}, function(index){
      	var loading = layer.msg('正在提交数据，请稍后...', {icon: 16,time:60000});
      	$.post('/admin/seckill/delGoods',{id:id},function(data,textStatus){
            layer.close(loading);
            if (data.status == 1) {
                layer.msg(data.msg,{icon:1});
                loadGrid1(PYG_CURR_PAGE)    
            } else {
                layer.msg(data.msg,{icon:2});
            }
        });
    });
}




