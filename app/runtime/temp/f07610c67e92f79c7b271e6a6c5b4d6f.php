<?php /*a:2:{s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\config\index.html";i:1558003286;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>品优购后台管理系统</title>
    <link rel="stylesheet" href="/static/libs/mmgrid/mmGrid.css">
    <link rel="stylesheet" href="/static/libs/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/admin.css">
    <link rel="stylesheet" href="/static/admin/css/common.css">
    <link rel="stylesheet" href="/static/admin/css/base.css">
    <link rel="stylesheet" href="/static/common/font/iconfont.css">
    <link rel="stylesheet" href="/static/libs/font-awesome/css/font-awesome.min.css" type="text/css" />
    <script src="/static/libs/layui/layui.js"></script>
    <script src="/static/libs/layui/layui.all.js"></script>
    <script src="/static/libs/jquery/jquery.min.js"></script>
    <script src="/static/libs/validator/jquery.validator.min.js"></script>
    <script src="/static/admin/js/common.js"></script>
    <script src="/static/libs/echarts/echarts.min.js" type="text/javascript"></script>
    <script>
window.conf = {"DOMAIN":"<?php echo str_replace('index.php','',app('request')->root(true)); ?>","ROOT":"__ROOT__","APP":"__APP__","STATIC":"/static","SUFFIX":"<?php echo config('url_html_suffix'); ?>"}
</script>
</head>

<body class="childrenBody">
    
<div class="layui-card">
    <div class="layui-card-body">
        <div class="layui-tab layui-tab-card">
            <ul class="layui-tab-title">
                <?php if(is_array($groupArray) || $groupArray instanceof \think\Collection || $groupArray instanceof \think\Paginator): $i = 0; $__LIST__ = $groupArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="<?php if($key==$group): ?>layui-this<?php endif; ?>"><a href="<?php echo url('index',['group'=>$key]); ?>"><?php echo htmlentities($vo); ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="layui-tab-content">
                <table class="layui-hide" id="dataTable" lay-filter="dataTable"></table>
            </div>
        </div>
    </div>
</div>
<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container">
    <a class="layui-btn layui-btn-sm" href="<?php echo url('add'); ?>">新增配置项</a>
  </div>
</script>
<script type="text/html" id="barTool">
    <a href='<?php echo url("edit"); ?>?id={{ d.id }}' class="layui-btn layui-btn-xs">编辑</a>
    <a href='<?php echo url("del"); ?>?id={{ d.id }}' class="layui-btn layui-btn-danger layui-btn-xs layui-tr-del">删除</a>
</script>
<script type="text/html" id="switchTpl">
    <input type="checkbox" name="status" data-href="<?php echo url('setstate'); ?>?id={{d.id}}" value="{{d.id}}" lay-skin="switch" lay-text="开启|关闭" lay-filter="switchStatus" {{ d.status==1 ? 'checked' : '' }}>
</script>

    
<script type="text/javascript" src="/static/admin/js/common.js"></script>
<script>
layui.use('table', function() {
    var table = layui.table,
        $ = layui.$,
        form = layui.form;
    table.render({
        elem: '#dataTable',
        toolbar: '#toolbarDemo',
        url: '<?php echo url("index",["group"=>$group]); ?>',
        cols: [
            [
                { field: 'listorder', width: 70, title: '排序', edit: 'text' },
                { field: 'name', title: '名称' },
                { field: 'title', title: '标题' },
                { field: 'ftitle', width: 150, title: '类型' },
                { field: 'update_time', width: 200, title: '更新时间' },
                { field: 'status', title: '状态', width: 100, templet: '#switchTpl', unresize: true },
                { fixed: 'right', width: 120, title: '操作', toolbar: '#barTool' }
            ]
        ],
    });
    //监听单元格编辑
    table.on('edit(dataTable)', function(obj) {
        var value = obj.value,data = obj.data;
        $.post('<?php echo url("admin/config/listorder"); ?>', {'id': data.id,'value':value }, function(data) {
            if (data.code == 1) {
                layer.msg(data.msg);
            }else{
                layer.msg(data.msg);
            }

        })
    });
});
</script>

</body>
</html>