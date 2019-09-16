//列表数据加载
$(function () {
     $('.item-time').click(function () {
            $(this).addClass('act').siblings().removeClass('act')
            $('.listBox > .goods-list').eq($(this).index()).addClass('active').siblings().removeClass('active')
        })
        // 鼠标经过增加边框
        $(".seckill-item").hover(function () {
            $(this).css("border-color","#b1191a");
        },function(){
            $(this).css("border-color","transparent");
        })
})