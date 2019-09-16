<?php
namespace app\common\model;
use think\Db;
use think\Model;
use Env;
use think\Loader;

/**

 * 订单业务处理类
 */
class Orders extends Model{
	protected $pk = 'orderId';

	/**
	 * 获取用户全部订单
	*/
	public function getAllOrders($uId=0){
		$userId = ($uId==0)?(int)session('PYG_USER.userId'):$uId;

		//查询全部订单
		$orders['orders'] = $this->where(['userId'=>$userId,'isCancel'=>0])->field('orderId,orderNo,payType,totalMoney,orderunique,userName,userPhone,userAddress,createTime,orderStatus,isAppraise,isComplains')->select()->toArray();

		//查询待付款订单
		$orders['waitPayOrders'] = $this->where(['userId'=>$userId,'isPay'=>0,'orderStatus'=>-2,'isCancel'=>0])->field('orderId,orderNo,payType,totalMoney,orderunique,userName,userPhone,userAddress,createTime,orderStatus')->select()->toArray();

		//查询待收货订单
		$orders['receveOrders'] = $this->where(['userId'=>$userId,'orderStatus'=>1,'isCancel'=>0])->field('orderId,orderNo,payType,totalMoney,orderunique,userName,userPhone,userAddress,createTime,orderStatus')->select()->toArray();

		//查询取消订单记录
		$orders['cancelOrders'] = $this->where(['userId'=>$userId,'isCancel'=>1,'orderStatus'=>-1])->field('orderId,orderNo,payType,totalMoney,orderunique,userName,userPhone,userAddress,createTime,orderStatus,isCancel')->select()->toArray();

		$total = $this->where(['userId'=>$userId,'isCancel'=>0])->count();

		//待付款数量
		$waitTotal = $this->where(['userId'=>$userId,'orderStatus'=>-2,'isPay'=>0,'isCancel'=>0])->count();

		//待收货数量
		$receveTotal = $this->where(['userId'=>$userId,'orderStatus'=>1,'isCancel'=>0])->count();

		//待评价数量
		$appraiseTotal = $this->where(['userId'=>$userId,'isAppraise'=>0,'orderStatus'=>2])->count();

		//查询全部订单
		foreach ($orders['orders'] as $key => $value) {
			//查询订单商品
			$orders['orders'][$key]['goods']['list'] = Db::name('order_goods')->where(['orderId'=>$value['orderId']])->select();

			$orders['orders'][$key]['goods']['totalk'] = Db::name('order_goods')->where(['orderId'=>$value['orderId']])->count();		
		}

		//查询待付款订单
		foreach ($orders['waitPayOrders'] as $key => $value) {
			//查询订单商品
			$orders['waitPayOrders'][$key]['goods']['list'] = Db::name('order_goods')->where(['orderId'=>$value['orderId']])->select();

			$orders['waitPayOrders'][$key]['goods']['totalk'] = Db::name('order_goods')->where(['orderId'=>$value['orderId']])->count();		
		}

		//查询待收货订单
		foreach ($orders['receveOrders'] as $key => $value) {
			//查询订单商品
			$orders['receveOrders'][$key]['goods']['list'] = Db::name('order_goods')->where(['orderId'=>$value['orderId']])->select();

			$orders['receveOrders'][$key]['goods']['totalk'] = Db::name('order_goods')->where(['orderId'=>$value['orderId']])->count();		
		}

		//查询取消订单记录
		foreach ($orders['cancelOrders'] as $key => $value) {
			//查询订单商品
			$orders['cancelOrders'][$key]['goods']['list'] = Db::name('order_goods')->where(['orderId'=>$value['orderId']])->select();
			$orders['cancelOrders'][$key]['goods']['totalk'] = Db::name('order_goods')->where(['orderId'=>$value['orderId']])->count();		
		}
		//全部订单数量
		$orders['totalOrders'] = $total;
		$orders['waitTotal'] = $waitTotal;
		$orders['receveTotal'] = $receveTotal;
		$orders['appraiseTotal'] = $appraiseTotal;
		return $orders;
	}

	/**
	 * 根据订单唯一流水获取订单信息
	 */
	public function getByUnique($uId=0){
		$orderNo = input('orderNo');
		$isBatch = (int)input('isBatch/d',1);
		$userId = ($uId==0)?(int)session('PYG_USER.userId'):$uId;
		if($isBatch==1){
			$rs = $this->where(['userId'=>$userId,'orderunique'=>$orderNo])->field('orderId,orderNo,payType,totalMoney,needPay,orderunique,userName,userPhone,userAddress')->select();
		} else {
			$rs = $this->where(['userId'=>$userId,'orderNo'=>$orderNo])->field('orderId,orderNo,payType,needPay,totalMoney,orderunique,userName,userPhone,userAddress')->select();
		}
		$data = [];
		$data['orderunique'] = $orderNo;
		$data['list'] = [];
		$payType = 0;
		$totalMoney = 0;
		$orderIds = [0];
		foreach ($rs as $key =>$v){
			if($v['payType']==1)$payType = 1;
			$totalMoney = $totalMoney + $v['totalMoney'];
			$orderIds[] = $v['orderId'];
			$data['list'][] = $v;
		}
		$data['totalMoney'] = $totalMoney;
		$data['payType'] = $payType;
		//获取商品信息
		$goods = Db::name('order_goods')->where([['orderId','in',$orderIds]])->select();
		foreach ($goods as $key =>$v){
			if($v['goodsSpecNames']!=''){
				$v['goodsSpecNames'] = explode('@@_@@',$v['goodsSpecNames']);
			}else{
				$v['goodsSpecNames'] = [];
			}
			$data['goods'][$v['orderId']][] = $v;
		}
		//如果是在线支付的话就要加载支付信息
		if($data['payType']==1){
			//获取支付信息
			$payments = model('payment')->where(['isOnline'=>1,'enabled'=>1])->order('payOrder asc')->select();
			$data['payments'] = $payments;
		}
		return $data;
	}

	/**
	 * 根据订单号获取订单详细信息
	*/
	public function getOrderDetail($orderNo){

		//查询订单
		$orders = $this->where(['orderNo'=>$orderNo])->field('orderId,orderNo,payType,totalMoney,orderunique,userName,userPhone,userAddress,createTime,orderStatus,expressCode,tracking,receiveTime,takeTime')->select()->toArray();

		foreach ($orders as $key => $value) {
			//查询订单商品
			$orders[$key]['goods'] = Db::name('order_goods')->where(['orderId'=>$value['orderId']])->select();		
		}
		return $orders;
	}

	/**
	 * 取消订单-操作
	*/
	public function cancelOrders($orderId)
	{
		$userId = (int)session('PYG_USER.userId');	
		if(empty($orderId))return PYGReturn("取消失败", -1);
		$rs = $this->where(['orderId'=>$orderId,'userId'=>$userId])->update(['isCancel' => 1,'orderStatus'=>-1]);
		if(false !== $rs){
			return PYGReturn("订单取消成功", 1);
		}else{
			return PYGReturn($this->getError(),-1);
		}
	}

	/**
	 * 用户-确认收货-操作
	*/
	public function takeOrders($orderId)
	{
		$userId = (int)session('PYG_USER.userId');	
		if(empty($orderId))return PYGReturn("收货失败", -1);
		$rs = $this->where(['orderId'=>$orderId,'userId'=>$userId])->update(['orderStatus'=>2,'takeTime'=> date('Y-m-d H:i:s')]);
		if(false !== $rs){
			return PYGReturn("确认收货成功", 1);
		} else {
			return PYGReturn($this->getError(),-1);
		}
	}

	/**
	 * 恢复订单 - 操作
	*/
	public function resumedOrders($orderId)
	{
		$userId = (int)session('PYG_USER.userId');
		if(empty($orderId))return PYGReturn("恢复失败", -1);
		$rs = $this->where(['orderId'=>$orderId,'userId'=>$userId])->update(['isCancel' => 0,'orderStatus'=>0]);
		if(false !== $rs){
			return PYGReturn("订单恢复成功", 1);
		}else{
			return PYGReturn($this->getError(),-1);
		}
	}

	/**
	 * 删除订单 - 操作
	 */
	public function delOrders($orderId){
		$userId = (int)session('PYG_USER.userId');
		if(empty($orderId))return PYGReturn("取消失败", -1);
		$rs = $this->where([['orderId','=',$orderId],['userId','=',$userId]])->delete();
		if(false !== $rs){
			return PYGReturn("订单删除成功", 1);
		} else {
			return PYGReturn($this->getError(),-1);
		}
	}

	/**
	* 根据订单id获取 商品信息跟商品评价
	*/
	public function getOrderInfoAndAppr($uId=0){
		$orderId = (int)input('orderId');
		$userId = ($uId==0)?(int)session('PYG_USER.userId'):$uId;

		$goodsInfo = Db::name('order_goods')
					->field('id,orderId,goodsName,goodsId,goodsImg,goodsPrice')
					->where(['orderId'=>$orderId])
					->select();

		$orderNo = Db::name('orders')
					->field('orderNo,createTime')
					->where(['orderId'=>$orderId])
					->find();
					
		//根据商品id 与 订单id 取评价
		$alreadys = 0;// 已评价商品数
		$count = count($goodsInfo);//订单下总商品数
		if($count>0){
			foreach($goodsInfo as $k=>$v){
				
				$appraise = Db::name('goods_appraises')
							->field('goodsScore,serviceScore,timeScore,content,createTime')
							->where(['goodsId'=>$v['goodsId'],
							         
									 'orderId'=>$orderId,
									 'dataFlag'=>1,
									 'userId'=>$userId,
									 'orderGoodsId'=>$v['id'],
									 ])->find();
			
				$goodsInfo[$k]['appraise'] = $appraise;
			}
		}
		return ['count'=>$count,'orderNo'=>$orderNo,'data'=>$goodsInfo];

	}
}