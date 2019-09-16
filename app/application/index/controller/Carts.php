<?php
namespace app\index\controller;
use app\common\model\Carts as M;
use app\common\controller\Base;
use app\common\model\Payment as PM;

/**
 * 购物车控制器
 */
class Carts extends Base{
	protected $beforeActionList = ['checkAuth'];

    /**
    * 加入购物车
    */
	public function addCart(){
		$m = new M();
		$rs = $m->addCart();
		return $rs;
	}

	/**
    * 加入购物车--秒杀功能
    */
	public function addSeckillCart(){
		$m = new M();
		$rs = $m->addSeckillCart();
		return $rs;
	}

	/**
	 * 查看购物车列表
	 */
	public function index(){
		$m = new M();
		//查询购物车里的商品，普通商品和秒杀商品
		$carts = $m->getCarts(false);
		//print_r($carts);die;
		$this->assign('carts',$carts);
		return $this->fetch();
	}

	/**
	 * 删除购物车里的商品
	 */
	public function delCart(){
		$m = new M();
		$rs= $m->delCart();
		return $rs;
	}

	/**
	 * 跳去购物车结算页面
	 */
    public function settlement(){
    	
		$m = new M();
		//获取一个用户地址
		$userAddress = model('UserAddress')->getDefaultAddress();
		$this->assign('userAddress',$userAddress);
		//获取支付方式
		$pm = new PM();
		$payments = $pm->getByGroup('1');
		$carts = $m->getCarts(true);
		if(empty($carts['carts'])){
     	$this->assign('message','Sorry~您还未选择商品。。。');
			return $this->fetch('error_msg');
  		}
		$this->assign('carts',$carts);
		$this->assign('payments',$payments);
		return $this->fetch('settlement');
	}

	/**
     * 提交订单
     */
    public function submit(){
        $userId = ($uId>0)?$uId:(int)session('PYG_USER.userId');
        if($userId<=0){
            return json_encode(PYGReturn('您还未登录~',-999));
        }
        $m = new M();   
        $rs = $m->submit($userId);
        return json_encode($rs);
    }
}
