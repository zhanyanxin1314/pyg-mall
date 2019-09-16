<?php
namespace app\common\model;
use think\Db;
use think\Model;

/**
 * 订单评价
 */
class GoodsAppraises extends Model{
	protected $pk = 'id';

	/**
	* 对订单进行评价操作
	*/
	public function addAppra(){
		$data = input('post.');
		
		$userId = (int)session('PYG_USER.userId');
		if($userId==0)return PYGReturn('评价失败，请先登录',-2);
		//判断记录是否存在
		$isFind = false;
		$c = Db::name('goods')->where(['dataFlag'=>1,'goodsId'=>$data['goodsId']])->count();
		$isFind = ($c>0);
		
		if(!$isFind)return PYGReturn("评价失败，无效的数据", -1);
		
		$data['userId'] = $userId;

		$data['createTime'] = date('Y-m-d H:i:s');
		$rs = $this->save($data);
		if(false !== $rs){
		db('orders')->where('orderId', $data['orderId'])->update(['isAppraise' => 1]);
			return PYGReturn("评价成功",1);
		} else {
			return PYGReturn($this->getError(),-1);
		}
	
	}

	/**
	* 会员中心-订单评价-展示
	*/
	public function getGoodsAppraise()
	{
		$userId = (int)session('PYG_USER.userId');
		$list = Db::name('goods_appraises')->alias('ga')
		->join('__ORDER_GOODS__ og','ga.orderId = og.orderId','left')
		->join('__ORDERS__ O','og.orderId = o.orderId','left')
	    ->where(['ga.dataFlag'=>1,'ga.userId'=>$userId])
		->field('O.orderNo,O.createTime,og.goodsNum,og.goodsId,og.goodsName,og.goodsImg,og.goodsPrice,ga.goodsScore,ga.timeScore,ga.serviceScore,ga.id,ga.content')
		->paginate((input('pagesize/d')>0)?input('pagesize/d'):16)->toArray();
		return $list;
	}
	
}
