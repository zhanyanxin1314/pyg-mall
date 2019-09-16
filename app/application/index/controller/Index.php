<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\UserSign as M;
use think\Request;
use think\Db;
class Index extends Base
{
    public function index()
    {
        $m = new M();
        $sign_info = getSignTip();
        $sign_tip = $sign_info['tip'];
        $sign_tip1 = $sign_info['tip1'];
        $canlendars = getCanlendar();
        $start_time = date("Y-m-01");
        $end_time = time();
        $where['uid'] = (int)session('PYG_USER.userId');
        $where['addtime'] = ['between time', $start_time, $end_time];
        $signs = $m->field("addtime")->where($where)->select();
        $signs_dates = array();
        foreach ($signs as $v) {
            $signs_dates[] = date("Y-m-d", $v['addtime']);
        }
        $this->assign("canlendars", $canlendars);
        $this->assign("days", date('t', strtotime("Y-m-1")));
        $this->assign("today", date("Y-m-d"));
        $this->assign("signs_dates", $signs_dates);
        $this->assign("sign_info", $sign_info);
        $this->assign('sign_tip',$sign_tip);
        $this->assign('sign_tip1',$sign_tip1);
    	return $this->fetch();
    }

    //首页-猜你喜欢商品
    public function getLikeGoods()
    {
    	return PYGGetIndexLikeGoods();
    }

    /**
     * 保存url
     */
    public function currenturl(){
    	session('PYG_HO_CURRENTURL',input('url'));
    	return PYGReturn("", 1);
    }

    /**
     * 查询购物车
    */

    public function getCart(){
        $rs = PYGCartsGoods();
        $rs['shopnum'] = PYGCartsGoodsNum();
        return $rs;
    }
}
