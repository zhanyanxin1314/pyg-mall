<?php

use \think\Request;

use \think\Db;

// +----------------------------------------------------------------------
// | 全局函数文件
// +----------------------------------------------------------------------



function insertlog($status=1){

    return Db::name("log_seckill")->insertGetId(["count"=>1,"status"=>$status,"addtime"=>date('Y-m-d H:i:s')]);

}


function is_in_array($str,$array,$rs){
    if(in_array($str,$array)){
        return $rs;
    }
}

function getCanlendar() {
    $canlendar = array();

    $year = date('Y');
//如果没有传入月份则获取当前系统月份
    $month = date('m');


//获取当前月有多少天
    $days = date('t', strtotime("" . $year . "-" . $month . "-1"));
//当前1号是星期几
    $week = date('w', strtotime("" . $year . "-" . $month . "-1"));
    for ($i = 1 - $week; $i <= $days;) {

        for ($j = 0; $j < 7; $j++) {
            $canlendar[] = $i;
            $i++;
        }
    }
    $canlendar_new = array();
//实现上一月和上一年
    if ($month == 1) {
        $premonth = 12;
        $preyear = $year - 1;
    } else {
        $premonth = $month - 1;
        $preyear = $year;
    }

//实现下一月和下一年
    if ($month == 12) {
        $nextmonth = 1;
        $nextyear = $year + 1;
    } else {
        $nextmonth = $month + 1;
        $nextyear = $year;
    }
//上月天数
    $premonth_days = date('t', strtotime("{$preyear}-{$premonth}-1"));

    $i = 0;
    foreach ($canlendar as $v) {
        if ($v <= 0) {
            $canlendar_new[$i]['day'] = $premonth_days - abs($v);
            $canlendar_new[$i]['date'] = $preyear . "-" . $premonth . "-" . $canlendar_new[$i]['day'];
        } elseif ($v > $days) {
            $canlendar_new[$i]['day'] = $v - $days;
            $canlendar_new[$i]['date'] = $nextyear . "-" . $nextmonth . "-" . $canlendar_new[$i]['day'];
        } else {
            $canlendar_new[$i]['day'] = $v;
            $canlendar_new[$i]['date'] = $year . "-" . $month . "-" . $canlendar_new[$i]['day'];
        }
        $canlendar_new[$i]['num'] = $v;
        $i++;
    }
    return $canlendar_new;
}

function getSignTip() {
    $userId = (int)session('PYG_USER.userId');
    $sign_tip = "";
    $today = strtotime(date("Y-m-d", time()));

    $where['uid'] = $where1['uid'] = $userId;
    $where['addtime'] = $today;
    $sign_info = model("userSign")->where($where)->find();

    if (empty($sign_info)) {  //判断是否今天已签到
        $yesterday = $today - 3600 * 24;
        $sign_tip = "今日还没签到";
    } else {
        $sign_tip = "今日签到已领取 ". $sign_info['points'] . " 积分";
    }
    $total_tip = Db::table('pyg_user_sign')->where($where1)->sum('points');
    $sign_tip1 = "签到共领取 ". $total_tip . " 积分";
    return array("num" => $sign_info['num'], "tip" => $sign_tip,"tip1" => $sign_tip1);
}

/**
 * 投诉状态
 */
function PYGLangComplainStatus($v){
    switch($v){
        case 0:return '等待处理';
        case 1:return '等待应诉人应诉';
        case 2:return '应诉人已应诉';
        case 3:return '等待仲裁';
        case 4:return '已仲裁';
    }
}

/**
 * 只允许一维数组里的某些key通过
 */
function PYGAllow(&$data,$keys){
    if($keys!='' && is_array($data)){
        $key = explode(',',$keys);
        foreach ($data as $vkeys =>$v)if(!in_array($vkeys,$key))unset($data[$vkeys]);
    }
}

/**
 * 获取广告-首页-有趣区-左侧
 */
function PYGGetIndexYqLeftAds(){
    $ads = cache('PYG_INDEXYQLEFTADS');
    if(!$ads){
        $ads = Db::name('ads')->alias('ad')->join('__AD_POSITIONS__ ap','ad.adPositionId=ap.positionId','inner')
                    ->where(['ap.positionCode'=>'index_youqu_left','ad.dataFlag'=>1])
                    ->field('ad.adFile,ad.adURL')
                    ->select();

        cache('PYG_INDEXYQLEFTADS',$ads);
    }
    return $ads;
}

/**
 * 获取广告-首页-有趣区-好东西
 */
function PYGGetIndexYqHdxAds(){
    $ads = cache('PYG_INDEXYQHDXADS');
    if(!$ads){
        $ads = Db::name('ads')->alias('ad')->join('__AD_POSITIONS__ ap','ad.adPositionId=ap.positionId','inner')
                    ->where(['ap.positionCode'=>'index_youqu_hdx','ad.dataFlag'=>1])
                    ->field('ad.adFile,ad.adURL')
                    ->select();

        cache('PYG_INDEXYQHDXADS',$ads);
    }
    return $ads;
}


/**
 * 获取广告位置
 */
function PYGGetPostionsDatas(){
    $adPositions = cache('PYG_POSITIONS');
    if(!$adPositions){
        $where['dataFlag'] = 1;
        $adPositions = Db::name('ad_positions')->where($where)->order('apSort asc')->select();
        cache('PYG_POSITIONS',$adPositions);
    }
    return $adPositions;
}

/**
 * 获取快递名称
 */
function PYGGetExpressDatas(){
    $express = cache('PYG_EXPRESS');
    if(!$express){
        $where['dataFlag'] = 1;
        $express = Db::name('express')->where($where)->select();
        cache('PYG_EXPRESS',$express);
    }
    return $express;
}

/**
 * 获取用户等级
 */
function PYGUserRank($userScore){
    $data = cache('PYG_USER_RANK');
    if(!$data){
        $data =  Db::name('user_ranks')->where('dataFlag',1)->order('startScore asc,rankId desc')->select();
        cache('PYG_USER_RANK',$data,2592000);
    }
    if(!$data)$data = [];
    foreach ($data as $key => $v) {
        if($userScore>=$v['startScore'] && $userScore<$v['endScore'])return $v;
    }
    return ['rankName'=>'','rankId'=>0,'userrankImg'=>''];
}

/**
 * 订单状态
 */
function PYGLangOrderStatus($v){
    switch($v){
        case -3:return '用户拒收';
        case -2:return '待支付';
        case -1:return '已取消';
        case 0:return '待发货';
        case 1:return '待收货';
        case 2:return '已收货';
    }
}

/**
 * 获取支付方式
 */
function PYGLangPayType($v){
    switch($v){
        case 0:return '货到付款';
        case 1:return '在线支付';
    }
}

/**
 * 支付来源
 */
function PYGLangPayFrom($pkey = '',$type = 0){
    $paySrc = cache('PYG_PAY_SRC');
    if(!$paySrc){
        $paySrc = Db::name('payment')->order('payOrder asc')->select();
        cache('PYG_PAY_SRC',$paySrc,31622400);
    }
    if($pkey=='' && $type == 1)return $paySrc;
    foreach($paySrc as $v){
       if($pkey==$v['payCode'])return $v['payName'];
    }
    return '其他';
}

/**
 * 生成订单号
 */
function PYGOrderNo(){
    $orderId = Db::name('orderids')->insertGetId(['rnd'=>time()]);
    return $orderId.(fmod($orderId,7));
}

/**
 * 获取订单统一流水号
 */
function PYGOrderQnique(){
    return (round(microtime(true),4)*10000).mt_rand(1000,9999);
}

/**
 * 将传过来的字符串格式化为数值字符串
 * @param string $split 要格式的字符串
 * @param string $str 字符串中的分隔符号
 */
function PYGFormatIn($split,$str){
    $strdatas = explode($split,$str);
    $data = array();
    for($i=0;$i<count($strdatas);$i++){
        $data[] = (int)$strdatas[$i];
    }
    $data = array_unique($data);
    return implode($split,$data);
}

/**
 * 分词
 */
function PYGAnalysis($str){
    $str = trim($str);
    $do_fork = true;
    $do_unit = true;//新词识别
    $do_multi = true;//多元切分
    $do_prop = false;//词性标注
    $pri_dict = false;//是否预载全部词条
    $pa = new \phpanalysis\phpanalysis('utf-8', 'utf-8', $pri_dict);
    //载入词典
    $pa->LoadDict();  
    //执行分词
    $pa->SetSource($str);
    $pa->differMax = $do_multi;
    $pa->unitWord = $do_unit;
    $pa->StartAnalysis( $do_fork );
    $str = $pa->GetFinallyResult(' ', $do_prop);
    $str = explode(' ',$str);
    $rs = array();
    foreach ($str as $key =>$v){
        if(trim($v)=='' || trim($v)==')' || trim($v)=='(')continue;
        $rs[] = $v;
    }
    return $rs;
}

/**
 * 头部-购物车数量
 */
function PYGCartsGoodsNum(){
    $userId = session('PYG_USER.userId');
    $total = Db::table('__CARTS__')->where(['userId'=>$userId])->sum('cartNum');
    return $total;
}

/**
 * 头部-我得购物车信息
 */
function PYGCartsGoods(){
    $userId = session('PYG_USER.userId');
    $rs = Db::table('__CARTS__')->where(['userId'=>$userId])->field("goodsId,userId,cartNum")->select();

    foreach ($rs as $key => $value) {
        $rs[$key]['goods'] = Db::table('__GOODS__')->where(['goodsId'=>$value['goodsId']])->field("goodsId,goodsName,marketPrice")->select();
    }
    return $rs;
}


/**
 * 商品详情页面-查询相关商品
 */
function PYGRelatedGoods($catId){
    $rs = Db::table('__GOODS__')->where(['isSale'=>1,'dataFlag'=>1,'goodsCatId'=>$catId])->field("goodsId,goodsName,goodsImg,marketPrice")->select();
    return $rs;
}

/**
 * 根据指定的商品分类获取其路径
 */
function PYGPathGoodsCat($catId,$data = array()){
    $rs = Db::table('__GOODS_CATS__')->where(['isShow'=>1,'dataFlag'=>1,'catId'=>$catId])->field("parentId,catName,catId")->find();
    $data[] = $rs;
    if($rs['parentId']==0){;
        krsort($data);
        return $data;
    } else {
        return PYGPathGoodsCat($rs['parentId'],$data);
    }
}

/**
 * 获取首页猜你喜欢商品
 */
function PYGGetIndexLikeGoods(){
    $goods = Db::table('__GOODS__')->where([['dataFlag','=',1,],['isSale','=',1]])->field("goodsId,goodsName,goodsImg,marketPrice")->orderRand()->limit(6)->select();
    return $goods;
}

/**
 * 获取首页广告信息
 */
function PYGGetIndexAds(){
    $data = cache('PYG_INDEX_ADS');
    if(!$data){
        $ads = Db::table('__ADS__')->where([['dataFlag','=',1,]])->field("adId,adName,adFile")->limit(1)->select();
        cache('PYG_INDEX_ADS',$ads);
        return $ads;
    }
    return $data;
}

/**
 * 获取首页今日推荐商品
 */
function PYGGetIndexRemendGoods(){
    $data = cache('PYG_INDEX_RECOM_GOODS');
    if(!$data){
        $goods = Db::table('__GOODS__')->where([['dataFlag','=',1,], ['isRecom','=',1],['isSale','=',1]])->field("goodsId,goodsName,goodsImg")->limit(4)->select();
        cache('PYG_INDEX_RECOM_GOODS',$goods);
        return $goods;
    }
    return $data;
}
/**
 * 获取首页热卖商品
 */
function PYGGetIndexHotGoods(){
    $data = cache('PYG_INDEX_HOT_GOODS');
    if(!$data){
        $goods = Db::table('__GOODS__')->where([['dataFlag','=',1,], ['isHot','=',1],['isSale','=',1]])->field("goodsId,goodsName,goodsImg,marketPrice")->limit(4)->select();
        cache('PYG_INDEX_HOT_GOODS',$goods);
        return $goods;
    }
    return $data;
}
/**
 * 获取首页特价商品
 */
function PYGGetIndexBestGoods(){
    $data = cache('PYG_INDEX_BEST_GOODS');
    if(!$data){
        $goods = Db::table('__GOODS__')->where([['dataFlag','=',1,], ['isBest','=',1],['isSale','=',1]])->field("goodsId,goodsName,goodsImg,marketPrice")->limit(4)->select();
        cache('PYG_INDEX_BEST_GOODS',$goods);
        return $goods;
    }
    return $data;
}
/**
 * 获取首页新品商品
 */
function PYGGetIndexNewGoods(){
    $data = cache('PYG_INDEX_NEW_GOODS');
    if(!$data){
        $goods = Db::table('__GOODS__')->where([['dataFlag','=',1,], ['isNew','=',1],['isSale','=',1]])->field("goodsId,goodsName,goodsImg,marketPrice")->limit(4)->select();
        cache('PYG_INDEX_NEW_GOODS',$goods);
        return $goods;
    }
    return $data;
}
/**
 * 获取首页左侧分类、推荐品牌和广告
 */
function PYGSideCategorys(){
    $data = cache('PYG_SIDE_CATS');
    if(!$data){
        $cats1 = Db::table('__GOODS_CATS__')->where([['dataFlag','=',1], ['isShow','=',1],['parentId','=',0]])->field("catName,catId")->order('catSort asc')->select();
        if(count($cats1)>0){
            $ids1 = [];$ids2 = [];$cats2 = [];$cats3 = [];$mcats3 = [];$mcats2 = [];
            foreach ($cats1 as $key =>$v){
                $ids1[] = $v['catId'];
            }
            $tmp2 = Db::table('__GOODS_CATS__')->where([['dataFlag','=',1], ['isShow','=',1],['parentId','in',$ids1]])->field("catName,catId,parentId")->order('catSort asc')->select();
            if(count($tmp2)>0){
                foreach ($tmp2 as $key =>$v){
                    $ids2[] = $v['catId'];
                }
                $tmp3 = Db::table('__GOODS_CATS__')->where([['dataFlag','=',1], ['isShow','=',1],['parentId','in',$ids2]])->field("catName,catId,parentId")->order('catSort asc')->select();
                if(count($tmp3)>0){
                    //组装第三级
                    foreach ($tmp3 as $key =>$v){
                        $mcats3[$v['parentId']][] = $v;
                    }
                }
                //组装第二级
                foreach ($tmp2 as $key =>$v){
                    if(isset($mcats3[$v['catId']]))$v['list'] = $mcats3[$v['catId']];
                    $mcats2[$v['parentId']][] = $v;
                }
                //组装第一级
                foreach ($cats1 as $key =>$v){
                    if(isset($mcats2[$v['catId']]))$cats1[$key]['list'] = $mcats2[$v['catId']];
                }
            }
            unset($ids1,$ids2,$cats2,$cats3,$mcats3,$mcats2);
        }
        cache('PYG_SIDE_CATS',$cats1);
        return $cats1;
    }
    return $data;
}

/**
 * 生成随机数账号
 */
function PYGRandomLoginName($loginName){
    $chars = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    //简单的派字母
    foreach ($chars as $key =>$c){
        $crs = PYGCheckLoginKey($loginName."_".$c);
        if($crs['status']==1)return $loginName."_".$c;
    }
    //随机派三位数值
    for($i=0;$i<1000;$i++){
        $crs = $this->PYGCheckLoginKey($loginName."_".$i);
        if($crs['status']==1)return $loginName."_".$i;
    }
    return '';
}

/**
 * 检测登录账号是否可用
 * @param $key 要检测的内容
 */
function PYGCheckLoginKey($val,$userId = 0){
    if($val=='')return PYGReturn("登录账号不能为空");
 
    $dbo = Db::name('users')->where([["loginName|userEmail|userPhone",'=',$val],['dataFlag','=',1]]);
    if($userId>0){
        $dbo->where("userId", "<>", $userId);
    }
    $rs = $dbo->count();
    if($rs==0){
        return PYGReturn("该登录账号可用",1);
    }
    return PYGReturn("对不起，登录账号已存在");
}

/**
* 编辑器上传图片
*/
function PYGEditUpload(){
    $root = str_replace('/index.php','',request()->root());
    //PHP上传失败
    if (!empty($_FILES['imgFile']['error'])) {
        switch($_FILES['imgFile']['error']){
            case '1':
                $error = '超过php.ini允许的大小。';
                break;
            case '2':
                $error = '超过表单允许的大小。';
                break;
            case '3':
                $error = '图片只有部分被上传。';
                break;
            case '4':
                $error = '请选择图片。';
                break;
            case '6':
                $error = '找不到临时目录。';
                break;
            case '7':
                $error = '写文件到硬盘出错。';
                break;
            case '8':
                $error = 'File upload stopped by extension。';
                break;
            case '999':
            default:
                $error = '未知错误。';
        }
        return PYGReturn(1,$error);
    }

    $fileKey = key($_FILES);
    $dir = 'image'; // 编辑器上传图片目录

    // 上传文件
    $file = request()->file($fileKey);
    if($file===null){
        return json_encode(["error"=>1,"message"=>'上传文件不存在或超过服务器限制']);
    }
    $rule = [
        'type'=>'image/png,image/gif,image/jpeg,image/x-ms-bmp',
        'ext'=>'jpg,jpeg,gif,png,bmp',
        'size'=>'2097152'
    ];
    $info = $file->validate($rule)->rule('uniqid')->move(Env::get('root_path').'/public/uploads/'.$dir."/".date('Y-m'));
    if($info){
        $filePath = $info->getPathname();
        $filePath = str_replace(Env::get('root_path'),'',$filePath);
        $filePath = str_replace('\\','/',$filePath);
        $name = $info->getFilename();
        $imageSrc = trim($filePath,'/');
        $filePath = str_replace($name,'',$filePath);
        $rdata = ['status'=>1,'name'=>$name,'savePath'=>ltrim($filePath,'/')];
        $info = null;
        return json(array('error' => 0, 'url' => '/uploads/image/'.date('Y-m').'/'.$name));
    }
}


/**
 * 检测字符串不否包含
 * @param $srcword 被检测的字符串
 * @param $filterWords 禁用使用的字符串列表
 * @return boolean true-检测到,false-未检测到
 */
function PYGCheckFilterWords($srcword,$filterWords){
    $flag = true;
    if($filterWords!=""){
        $filterWords = str_replace("，",",",$filterWords);
        $words = explode(",",$filterWords);
        for($i=0;$i<count($words);$i++){
            if($words[$i]=='')continue;
            if(strpos($srcword,$words[$i]) !== false){
                $flag = false;
                break;
            }
        }
    }
    return $flag;
}

/**
 * 生成默认商品编号/货号
 */
function PYGGoodsNo(){
    return 'PYG'.(round(microtime(true),4)*10000).mt_rand(0,9);
}

/**
 * 获取指定商品分类的子分类列表/获取指定的商品分类，靠$isSelf=-1判断
 */
function PYGGoodsCats($parentId = 0,$isFloor = -1,$isSelf = 0){
    
        $dbo = Db::name('goods_cats')->where(['dataFlag'=>1, 'isShow' => 1,'parentId'=>$parentId]);
        return $dbo->field("catName,catId")->order('catSort asc')->select();
    
}

/**
 * 适应mmgrid的表格返回结构
 */
function PYGGrid($page){
    if(!is_array($page))$page = $page->toArray();
    $rs = ['status'=>1,'msg'=>'','items'=>$page['data'],'totalCount'=>$page['total']];
    return $rs;
}
/**
 * 上传图片
 * 需要生成缩略图： isThumb=1
 * 需要加水印：isWatermark=1
 * pc版缩略图： width height
 * 手机版原图：mWidth mHeight
 * 缩略图：mTWidth mTHeight
 * 判断图片来源：  1：平台管理员
 */
function PYGUploadPic($fromType=0){
    $fileKey = key($_FILES);
    $dir = Input('param.dir');

    if($dir=='')return json_encode(['msg'=>'没有指定文件目录！','status'=>-1]);
    // 上传文件
    $file = request()->file($fileKey);
    if($file===null){
        return json_encode(['msg'=>'上传文件不存在或超过服务器限制','status'=>-1]);
    }
    $rule = [
        'type'=>'image/png,image/gif,image/jpeg,image/x-ms-bmp',
        'ext'=>'jpg,jpeg,gif,png,bmp',
        'size'=>'2097152'
    ];
    $info = $file->validate($rule)->rule('uniqid')->move(Env::get('root_path').'/public/uploads/'.$dir."/".date('Y-m'));
    if($info){
        $filePath = $info->getPathname();
        $filePath = str_replace(Env::get('root_path'),'',$filePath);
        $filePath = str_replace('\\','/',$filePath);
        $imgSrc = $info->getFilename();
        $filePath = str_replace($imgSrc,'',$filePath);
        //原图路径
        $imageSrc = trim($filePath.$imgSrc,'/');
    
        $rdata = ['status'=>1,'savePath'=>'/uploads/'.$dir.'/'.date('Y-m').'/'.$imgSrc,'name'=>$imgSrc];
      
        return json($rdata);
    } else {
        //上传失败获取错误信息
        return $file->getError();
    }    
}

/**
 * 清除整个所有缓存
 * 注意：此函数非迫不得己不要调用。能删除指定缓存的就尽量删除指定缓存。尽量只在后台管理员才做时调用，前台用户操作就不要调用了
 */
function PYGClearAllCache(){
    Cache::clear();
}

/**
 * 生成数据返回值
 */
function PYGReturn($msg,$status = -1,$data = []){
    $rs = ['status'=>$status,'msg'=>$msg];
    if(!empty($data))$rs['data'] = $data;
    return $rs;
}
/**
 * 生成数据返回值
 */
function jsonReturn($msg,$status = -1,$data = []){
    if(isset($data['status']))return json_encode($data);
    $rs = ['status'=>$status,'msg'=>$msg];
    if(!empty($data))$rs['data'] = $data;
    return json_encode($rs);
}


/**
 * 删除一维数组里的多个key
 */
function PYGUnset(&$data,$keys){
    if($keys!='' && is_array($data)){
        $key = explode(',',$keys);
        foreach ($key as $v)unset($data[$v]);
    }
}

/**
 * 系统缓存缓存管理
 * cache('model') 获取model缓存
 * cache('model',null) 删除model缓存
 * @param mixed $name 缓存名称
 * @param mixed $value 缓存值
 * @param mixed $options 缓存参数
 * @return mixed
 */
function cache($name, $value = '', $options = null)
{
    static $cache = '';
    if (empty($cache)) {
        $cache = \libs\Cache_factory::instance();
    }
    // 获取缓存
    if ('' === $value) {
        if (false !== strpos($name, '.')) {
            $vars = explode('.', $name);
            $data = $cache->get($vars[0]);
            return is_array($data) ? $data[$vars[1]] : $data;
        } else {
            return $cache->get($name);
        }
    } elseif (is_null($value)) {
//删除缓存
        return $cache->remove($name);
    } else {
//缓存数据
        if (is_array($options)) {
            $expire = isset($options['expire']) ? $options['expire'] : null;
        } else {
            $expire = is_numeric($options) ? $options : null;
        }
        return $cache->set($name, $value, $expire);
    }
}

/**
 * 获取插件类的类名
 * @param $name 插件名
 * @param string $type 返回命名空间类型
 * @param string $class 当前类名
 * @return string
 */
function get_addon_class($name, $type = 'hook', $class = null)
{
    $name = \think\Loader::parseName($name);
    // 处理多级控制器情况
    if (!is_null($class) && strpos($class, '.')) {
        $class = explode('.', $class);

        $class[count($class) - 1] = \think\Loader::parseName(end($class), 1);
        $class = implode('\\', $class);
    } else {
        $class = \think\Loader::parseName(is_null($class) ? $name : $class, 1);
    }

    switch ($type) {
        case 'controller':
            $namespace = "\\addons\\" . $name . "\\controller\\" . $class;
            break;
        default:
            $namespace = "\\addons\\" . $name . "\\" . $class;
    }
    return class_exists($namespace) ? $namespace : '';
}

/**
 * 检查模块是否已经安装
 * @param type $moduleName 模块名称
 * @return boolean
 */
function isModuleInstall($moduleName)
{
    $appCache = cache('Module');
    if (isset($appCache[$moduleName])) {
        return true;
    }
    return false;
}

/**
 * 处理插件钩子
 * @param string $hook 钩子名称
 * @param mixed $params 传入参数
 * @param  boolean $is_return 是否返回（true:返回值，false:直接输入）
 * @param  bool   $once   只获取一个有效返回值
 * @return void
 */
function hook($hook, $params = [], $is_return = false, $once = false)
{
    if ($is_return == true) {
        return \think\facade\Hook::listen($hook, $params, $once);
    }
    \think\facade\Hook::listen($hook, $params, $once);
}

/**
 * 获取插件类的配置值值
 * @param string $name 插件名
 * @return array
 */
function get_addon_config($name)
{
    $addon = get_addon_instance($name);
    if (!$addon) {
        return [];
    }
    return $addon->getAddonConfig();
}

/**
 * 获取插件的单例
 * @param $name
 * @return mixed|null
 */
function get_addon_instance($name)
{
    static $_addons = [];
    if (isset($_addons[$name])) {
        return $_addons[$name];
    }
    $class = get_addon_class($name);
    if (class_exists($class)) {
        $_addons[$name] = new $class();
        return $_addons[$name];
    } else {
        return null;
    }
}

/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data)
{
    //数据类型检测
    if (!is_array($data)) {
        $data = (array) $data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}

/**
 * select返回的数组进行整数映射转换
 *
 * @param array $map  映射关系二维数组  array(
 *                                          '字段名1'=>array(映射关系数组),
 *                                          '字段名2'=>array(映射关系数组),
 *                                           ......
 *                                       )
 * @author 朱亚杰 <zhuyajie@topthink.net>
 * @return array
 *
 *  array(
 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
 *      ....
 *  )
 *
 */
function int_to_string(&$data, $map = array('status' => array(1 => '正常', -1 => '删除', 0 => '禁用', 2 => '未审核', 3 => '草稿')))
{
    if ($data === false || $data === null) {
        return $data;
    }
    $data = (array) $data;
    foreach ($data as $key => $row) {
        foreach ($map as $col => $pair) {
            if (isset($row[$col]) && isset($pair[$row[$col]])) {
                $data[$key][$col . '_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}

/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 */
function str2arr($str, $glue = ',')
{
    return explode($glue, $str);
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 */
function arr2str($arr, $glue = ',')
{
    if (is_string($arr)) {
        return $arr;
    }

    return implode($glue, $arr);
}

/**
 * 时间转换
 * @param array $arr        传入数组
 * @param string $field     字段名
 * @param string $format    格式
 * @return mixed
 */
function to_time(&$arr, $field = 'time', $format = 'Y-m-d H:i:s')
{
    if (isset($arr[$field])) {
        $arr[$field] = date($format, $arr[$field]);
    }
    return $arr;
}

/**
 * ip转换
 * @param array $arr        传入数组
 * @param string $field     字段名
 * @return mixed
 */
function to_ip(&$arr, $field = 'ip')
{
    if (isset($arr[$field])) {
        $arr[$field] = long2ip($arr[$field]);
    }
    return $arr;
}

/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list, $field, $sortby = 'asc')
{
    if (is_array($list)) {
        $refer = $resultSet = array();
        foreach ($list as $i => $data) {
            $refer[$i] = &$data[$field];
        }

        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc': // 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ($refer as $key => $val) {
            $resultSet[] = &$list[$key];
        }

        return $resultSet;
    }
    return false;
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk = 'id', $pid = 'parentid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = &$refer[$parentId];
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 解析配置
 * @param string $value 配置值
 * @return array|string
 */
function parse_attr($value = '')
{
    $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
    if (strpos($value, ':')) {
        $value = array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k] = $v;
        }
    } else {
        $value = $array;
    }
    return $value;
}

/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 */
function time_format($time = null, $type = 0)
{
    $types = array('Y-m-d H:i:s', 'Y-m-d H:i', 'Y-m-d');
    $time = $time === null ? $_SERVER['REQUEST_TIME'] : intval($time);
    return date($types[$type], $time);
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '')
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }

    return round($size, 2) . $delimiter . $units[$i];
}

/**
 * 根据PHP各种类型变量生成唯一标识号
 * @param mixed $mix 变量
 * @return string
 */
function to_guid_string($mix)
{
    if (is_object($mix)) {
        return spl_object_hash($mix);
    } elseif (is_resource($mix)) {
        $mix = get_resource_type($mix) . strval($mix);
    } else {
        $mix = serialize($mix);
    }
    return md5($mix);
}

/**
 * 根据附件id获取文件名
 * @param string $id 附件id
 * @return string
 */
function get_file_name($id = '')
{
    $name = model('attachment/Attachment')->getFileName($id);
    return $name ? $name : '没有找到文件';
}

/**
 * 获取附件路径
 * @param int $id 附件id
 * @return string
 */
function get_file_path($id)
{
    $path = model('attachment/Attachment')->getFilePath($id);
    return $path ? $path : "";
}

/**
 * 对用户的密码进行加密
 * @param $password
 * @param $encrypt //传入加密串，在修改密码时做认证
 * @return array/password
 */
function encrypt_password($password, $encrypt = '')
{
    $pwd = array();
    $pwd['encrypt'] = $encrypt ? $encrypt : genRandomString();
    $pwd['password'] = md5(trim($password) . $pwd['encrypt']);
    return $encrypt ? $pwd['password'] : $pwd;
}

/**
 * 产生一个指定长度的随机字符串,并返回给用户
 * @param type $len 产生字符串的长度
 * @return string 随机字符串
 */
function genRandomString($len = 6)
{
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9",
    );
    $charsLen = count($chars) - 1;
    // 将数组打乱
    shuffle($chars);
    $output = "";
    for ($i = 0; $i < $len; $i++) {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}

/**
 * 生成缩略图
 * @param type $imgurl 图片地址
 * @param type $width 缩略图宽度
 * @param type $height 缩略图高度
 * @param type $thumbType 缩略图生成方式
 * @param type $smallpic 图片不存在时显示默认图片
 * @return type
 */
function thumb($imgurl, $width = 100, $height = 100, $thumbType = 1, $smallpic = 'none.png')
{
    static $_thumb_cache = array();
    $smallpic = config('public_url') . 'static/admin/img/' . $smallpic;
    if (empty($imgurl)) {
        return $smallpic;
    }
    //区分
    $key = md5($imgurl . $width . $height . $thumbType . $smallpic);
    if (isset($_thumb_cache[$key])) {
        return $_thumb_cache[$key];
    }
    if (!$width) {
        return $smallpic;
    }

    $uploadUrl = config('public_url') . 'uploads/';
    $uploadPath = config('upload_path');
    $imgurl_replace = str_replace($uploadUrl, '', $imgurl);

    $newimgname = 'thumb_' . $width . '_' . $height . '_' . basename($imgurl_replace);
    $newimgurl = dirname($imgurl_replace) . '/' . $newimgname;
    //检查生成的缩略图是否已经生成过
    if (is_file($uploadPath . DIRECTORY_SEPARATOR . $newimgurl)) {
        return $uploadUrl . $newimgurl;
    }
    //检查文件是否存在，如果是开启远程附件的，估计就通过不了，以后在考虑完善！
    if (!is_file($uploadPath . DIRECTORY_SEPARATOR . $imgurl_replace)) {
        return $imgurl;
    }
    //取得图片相关信息
    list($width_t, $height_t, $type, $attr) = getimagesize($uploadPath . DIRECTORY_SEPARATOR . $imgurl_replace);
    //如果高是0，自动计算高
    if ($height <= 0) {
        $height = round(($width / $width_t) * $height_t);
    }
    //判断生成的缩略图大小是否正常
    if ($width >= $width_t || $height >= $height_t) {
        return $imgurl;
    }
    model('attachment/Attachment')->create_thumb($uploadPath . DIRECTORY_SEPARATOR . $imgurl_replace, $uploadPath . DIRECTORY_SEPARATOR . dirname($imgurl_replace) . '/', $newimgname, "{$width},{$height}", $thumbType);
    $_thumb_cache[$key] = $uploadUrl . $newimgurl;
    return $_thumb_cache[$key];

}

/**
 * 下载远程文件，默认保存在temp下
 * @param  string  $url     网址
 * @param  string  $filename    保存文件名
 * @param  integer $timeout 过期时间
 * @param  bool $repalce 是否覆盖已存在文件
 * @return string 本地文件名
 */
function http_down($url, $filename = "", $timeout = 60)
{
    if (empty($filename)) {
        $filename = ROOT_PATH . 'public' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . pathinfo($url, PATHINFO_BASENAME);
    }
    $path = dirname($filename);
    if (!is_dir($path) && !mkdir($path, 0755, true)) {
        return false;
    }
    $url = str_replace(" ", "%20", $url);
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if ('https' == substr($url, 0, 5)) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        $temp = curl_exec($ch);
        if (file_put_contents($filename, $temp) && !curl_error($ch)) {
            return $filename;
        } else {
            return false;
        }
    } else {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "",
                "timeout" => $timeout,
            ],
        ];
        $context = stream_context_create($opts);
        if (@copy($url, $filename, $context)) {
            //$http_response_header
            return $filename;
        } else {
            return false;
        }
    }
}

/**
 * 安全过滤函数
 * @param $string
 * @return string
 */
function safe_replace($string)
{
    $string = str_replace('%20', '', $string);
    $string = str_replace('%27', '', $string);
    $string = str_replace('%2527', '', $string);
    $string = str_replace('*', '', $string);
    $string = str_replace('"', '&quot;', $string);
    $string = str_replace("'", '', $string);
    $string = str_replace('"', '', $string);
    $string = str_replace(';', '', $string);
    $string = str_replace('<', '&lt;', $string);
    $string = str_replace('>', '&gt;', $string);
    $string = str_replace("{", '', $string);
    $string = str_replace('}', '', $string);
    $string = str_replace('\\', '', $string);
    return $string;
}
