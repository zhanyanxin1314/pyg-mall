<?php /*a:2:{s:75:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\main\index.html";i:1559178720;s:77:"E:\phpStudy\PHPTutorial\WWW\mall\app\application\admin\view\index_layout.html";i:1564040800;}*/ ?>
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
    
<style>
body{background:#f5f5f5;}
.small-box{margin-right: 5%;border-radius: 2px;position: relative;display: block; margin-bottom: 20px;box-shadow: 0 1px 1px rgba(0,0,0,0.1);}
.small-box>.inner {padding: 10px;color: #fff !important;}
.small-box h3, .small-box p {z-index: 5;}
.small-box h3 {font-size: 38px; font-weight: bold;margin: 0 0 10px 0;white-space: nowrap;padding: 0;}
.small-box h3, .small-box p {z-index: 5;}
.small-box p {font-size: 15px;}
.small-box .icon {-webkit-transition: all .3s linear;-o-transition: all .3s linear;transition: all .3s linear;position: absolute;top: 10px;right: 20px;z-index: 0;font-size: 60px;color: rgba(0,0,0,0.15);}
.small-box:hover .icon {font-size: 70px;}
.wst-strip .progress{height:25px;width:70%;float:left}
</style>
<div class="layui-card">
    <div class="layui-card-header">控制台</div>
    <div class="layui-card-body">
        <blockquote class="layui-elem-quote layui-bg-green">
            <div id="nowTime"></div>
        </blockquote>
        <div class="layui-row layui-col-space10 panel_box">

            <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
                <a href="javascript:;">
                    <div class="panel_icon layui-bg-blue">
                        <i class="icon iconfont icon-time layui-anim"></i>
                    </div>
                    <div class="panel_word">
                        <span class="loginTime"><?php if($userInfo['last_login_time'] > 0) { echo $userInfo['last_login_time'];} else { echo '--';}?></span>
                        <cite>上次登录时间</cite>
                    </div>
                </a>
            </div>
        </div>
        <div class="layui-row layui-col-space10">
            <div class="layui-col-lg6 layui-col-md12">
                <blockquote class="layui-elem-quote title">系统基本参数</blockquote>
                <table class="layui-table magt0">
                    <colgroup>
                        <col width="150">
                        <col>
                    </colgroup>
                    <tbody>
                        <tr>
                            <td>PHP 版本</td>
                            <td class="phpv"><?php echo htmlentities($sys_info['phpv']); ?></td>
                        </tr>
                        <tr>
                            <td>服务器域名/IP</td>
                            <td class="domains"><?php echo htmlentities($sys_info['domain']); ?> [ <?php echo htmlentities($sys_info['ip']); ?> ]</td>
                        </tr>
                        <tr>
                            <td>服务器环境</td>
                            <td class="server"><?php echo htmlentities($sys_info['web_server']); ?></td>
                        </tr>
                        <tr>
                            <td>数据库版本</td>
                            <td class="dataBase"><?php echo htmlentities($sys_info['mysql_version']); ?></td>
                        </tr>
                        <tr>
                            <td>最大上传限制</td>
                            <td class="maxUpload"><?php echo htmlentities($sys_info['fileupload']); ?></td>
                        </tr>
                        <tr>
                            <td>服务器时间</td>
                            <td class="time"><?php echo htmlentities($sys_info['time']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div width='100%' border='0' class="layui-row">
    <div class="layui-col-md9">
        <div class="wst-total wst-summary" style='margin-bottom:10px'>
            <div class='wst-summary-head layui-col-md12'>
                <span class="content">商城统计</span>
            </div>
            <div class="wst-summary-content2 layui-col-md6">
                <div class="wst-strip">
                    <div class="wst-title">会员总数</div>
                    <div class="progress">
                       <div class="progress-bar progress-bar-striped" style="width: 100%;background-color:#00c0ef"></div>
                    </div>
                    <span class="wst-num"><?php echo htmlentities($object['mall']['userType0']); ?>个</span>
                </div>
                <div class="wst-strip">
                    <div class="wst-title">上架商品总数/待审核数</div>
                    <div class="progress">
                       <?php 
                       $w = 0;
                       $w = ($object['mall']['saleGoods']>0)?((1-$object['mall']['auditGoods']/$object['mall']['saleGoods'])*100):0;
                        ?>
                       <div class="progress-bar progress-bar-striped" style="width:<?php echo htmlentities($w); ?>%;background-color:#f39c12"></div>
                    </div>
                    <span class="wst-num"><?php echo htmlentities($object['mall']['saleGoods']); ?>/<?php echo htmlentities($object['mall']['auditGoods']); ?>个</span>
                </div>
                <div class="wst-strip">
                    <div class="wst-title">品牌总数</div>
                    <div class="progress">
                       <div class="progress-bar progress-bar-striped" style="width: 100%;background-color:#00ca6d"></div>
                    </div>
                    <span class="wst-num"><?php echo htmlentities($object['mall']['brands']); ?>个</span>
                </div>
            </div>
            <div class="wst-summary-content2 layui-col-md6">
                <div class="wst-strip">
                    <div class="wst-title">商家总数</div>
                    <div class="progress">
                       <div class="progress-bar progress-bar-striped" style="width: 100%;background-color:#605ca8"></div>
                    </div>
                    <span class="wst-num"><?php echo htmlentities($object['mall']['userType1']); ?>个</span>
                </div>
                <div class="wst-strip">
                    <div class="wst-title">订单总数</div>
                    <div class="progress">
                       <div class="progress-bar progress-bar-striped" style="width: 100%;background-color:#4ED1D1"></div>
                    </div>
                  <span class="wst-num">0个</span>
                </div>
                <div class="wst-strip">
                    <div class="wst-title">评价总数</div>
                    <div class="progress">
                       <div class="progress-bar progress-bar-striped" style="width: 100%;"></div>
                    </div>
                  <span class="wst-num"><?php echo htmlentities($object['mall']['appraise']); ?>个</span>
                </div>
            </div>
        </div>
    </div>
</div>

    

<script type="text/javascript">
//获取系统时间
var newDate = '';
getLangDate();
//值小于10时，在前面补0
function dateFilter(date) {
    if (date < 10) { return "0" + date; }
    return date;
}

function getLangDate() {
    var dateObj = new Date(); //表示当前系统时间的Date对象
    var year = dateObj.getFullYear(); //当前系统时间的完整年份值
    var month = dateObj.getMonth() + 1; //当前系统时间的月份值
    var date = dateObj.getDate(); //当前系统时间的月份中的日
    var day = dateObj.getDay(); //当前系统时间中的星期值
    var weeks = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
    var week = weeks[day]; //根据星期值，从数组中获取对应的星期字符串
    var hour = dateObj.getHours(); //当前系统时间的小时值
    var minute = dateObj.getMinutes(); //当前系统时间的分钟值
    var second = dateObj.getSeconds(); //当前系统时间的秒钟值
    var timeValue = "" + ((hour >= 12) ? (hour >= 18) ? "晚上" : "下午" : "上午"); //当前时间属于上午、晚上还是下午
    newDate = dateFilter(year) + "年" + dateFilter(month) + "月" + dateFilter(date) + "日 " + " " + dateFilter(hour) + ":" + dateFilter(minute) + ":" + dateFilter(second);
    document.getElementById("nowTime").innerHTML = "亲爱的<?php echo htmlentities($userInfo['username']); ?>，" + timeValue + "好！ 欢迎使品优购 v<?php echo htmlentities(app('config')->get('version.pyg_version')); ?>,当前时间为： " + newDate + "　" + week;
    setTimeout("getLangDate()", 1000);
}

layui.use(['jquery'], function() {
    var $ = layui.jquery;
    //icon动画
    $(".panel a").hover(function() {
        $(this).find(".layui-anim").addClass("layui-anim-scaleSpring");
    }, function() {
        $(this).find(".layui-anim").removeClass("layui-anim-scaleSpring");
    })
    $(".panel a").click(function() {
        parent.addTab($(this));
    })
})
</script>


</body>
</html>