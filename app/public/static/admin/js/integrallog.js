var mmg;
function initGrid(p){
    var h = pageHeight();
    var cols = [
            {title:'ID', name:'billId', width: 100},
            {title:'标题', name:'title', width: 100},
            {title:'积分余量', name:'balance', width: 100},
            {title:'明细数字', name:'number', width: 100},
            {title:'备注', name:'mark', width: 100},
            {title:'添加时间', name:'add_time', width: 100},
            ];
    mmg = $('.mmg').mmGrid({height: h-80,indexCol: true, cols: cols,method:'POST',
        url: '/admin/Integrallog/pageQuery', fullWidthRows: true, autoLoad: false,
        plugins: [
            $('#pg').mmPaginator({})
        ]
    });
    loadGrid(p)
}

//全局加载
function loadGrid(p){
    p=(p<=1)?1:p;
    mmg.load({page:p});
}