<?php
namespace app\common\model;
use think\Db;
use think\Model;
use think\Facade\Cache;
use app\common\model\Orders as O;

/**
 * 购物车业务处理类
 */

class Carts extends Model{
	protected $pk = 'cartId';

	/**
	 * 加入购物车 - 秒杀功能
	 */
	public function addSeckillCart($uId = 0){

		$userId = ($uId>0)?$uId:(int)session('PYG_USER.userId');
		$goodsId = (int)input('post.goodsId');
		$cartNum = (int)input('post.buyNum',1);
		$cartNum = ($cartNum>0)?$cartNum:1;
		//$type = (int)input('post.type');
		if(!$goodsId){
			insertlog(0);
		}
		if($userId==0)return PYGReturn('加入购物车失败，请先登录',-2);
		$chk = $this->checkSeckillGoodsSaleSpec($goodsId);
		if($chk['status']==1)return $chk;
		$goods = $this->where(['userId'=>$userId,'goodsId'=>$goodsId])->select();
		if(count($goods)==0){
			$data = array();
			$data['userId'] = $userId;
			$data['goodsId'] = $goodsId;
			$data['isCheck'] = 1;
            $data['isPro'] = 2;
			$data['cartNum'] = $cartNum;
			$rs = $this->save($data);
			Db::name("goods_seckill")->where("product_id",$goodsId)->setDec("stock");
		}else {
			$rs = $this->where(['userId'=>$userId,'goodsId'=>$goodsId])->setInc('cartNum',$cartNum);
			Db::name("goods_seckill")->where("product_id",$goodsId)->setDec("stock");
		}
		if(false !==$rs){
			if($type==1){
				$cartId = $this->where(['userId'=>$userId,'goodsId'=>$goodsId])->value('cartId');
				$this->where("cartId = ".$cartId." and userId=".$userId)->setField('isCheck',1);
				$this->where("cartId != ".$cartId." and userId=".$userId)->setField('isCheck',0);
				$this->where(['cartId' =>$cartId,'userId'=>$userId])->setField('cartNum',$cartNum);
			}
			return PYGReturn("成功加入购物车", 1);
		}
	
		return PYGReturn("加入购物车失败", -1);
	}

	/**
	 * 加入购物车
	 */
	public function addCart($uId = 0){
		$userId = ($uId>0)?$uId:(int)session('PYG_USER.userId');
		$goodsId = (int)input('post.goodsId');
		$cartNum = (int)input('post.buyNum',1);
		$cartNum = ($cartNum>0)?$cartNum:1;
		//$type = (int)input('post.type');
		if($userId==0)return PYGReturn('加入购物车失败，请先登录',-2);
		//验证传过来的商品是否合法
		$chk = $this->checkGoodsSaleSpec($goodsId,$goodsSpecId);

		if($chk['status']==-1)return $chk;
		//检测库存是否足够
		if($chk['data']['stock']<$cartNum)return PYGReturn("加入购物车失败，商品库存不足", -1);
		//添加实物商
		
		$goods = $this->where(['userId'=>$userId,'goodsId'=>$goodsId])->select();
        $goods1 = $this->where(['userId'=>$userId,'goodsId'=>$goodsId,'isPro'=>2])->find();
        if(!empty($goods1)){
            return PYGReturn("此商品为秒杀商品！请勿重复添加！", -1);
        }
		if(count($goods)==0){
			$data = array();
			$data['userId'] = $userId;
			$data['goodsId'] = $goodsId;
			$data['isCheck'] = 1;
			$data['cartNum'] = $cartNum;
			$rs = $this->save($data);
		} else {
			$rs = $this->where(['userId'=>$userId,'goodsId'=>$goodsId])->setInc('cartNum',$cartNum);
		}
		if(false !==$rs){
			if($type==1){
				$cartId = $this->where(['userId'=>$userId,'goodsId'=>$goodsId])->value('cartId');
				$this->where("cartId = ".$cartId." and userId=".$userId)->setField('isCheck',1);
				$this->where("cartId != ".$cartId." and userId=".$userId)->setField('isCheck',0);
				$this->where(['cartId' =>$cartId,'userId'=>$userId])->setField('cartNum',$cartNum);
			}
			return PYGReturn("成功加入购物车", 1);
		}
	
		return PYGReturn("加入购物车失败", -1);
	}

	/**
	 * 验证商品是否合法
	 */
	public function checkGoodsSaleSpec($goodsId){
		$goods = model('Goods')->where(['dataFlag'=>1,'isSale'=>1,'goodsId'=>$goodsId])->field('goodsId,goodsStock')->find();
		if(empty($goods))return PYGReturn("添加失败，无效的商品信息", -1);
		$goodsStock = (int)$goods['goodsStock'];

		return PYGReturn("", 1,['stock'=>$goodsStock]);
	}


	/**
	 * 验证商品是否合法
	 */
	public function checkSeckillGoodsSaleSpec($goodsId){

		$count=Cache::store('redis')->lpop($goodsId.'-goods_store');
		if(!$count){
			 insertlog(0); 
             return PYGReturn("商品已经被抢光！!", 1);
         }
		// $goods = model('Goods')->where(['dataFlag'=>1,'isSale'=>1,'goodsId'=>$goodsId])->field('goodsId,goodsStock')->find();
		// if(empty($goods))return PYGReturn("添加失败，无效的商品信息", -1);
		// $goodsStock = (int)$goods['goodsStock'];

		// return PYGReturn("", 1,['stock'=>$goodsStock]);
	}

	/**
	 * 删除购物车里的商品
	 */
	public function delCart(){
		$userId = session('PYG_USER.userId');
		$id = input('post.id');
		
		//$id = explode(',',PYGFormatIn(",",$id));
		//$id = array_filter($id);
		$where['userId'] = $userId;
		$where['cartId'] = $id;
		$this->where($where)->delete();
		return PYGReturn("删除成功", 1);
	}

	/**
	 * 获取购物车列表 普通商品和秒杀商品
	 */
	public function getCarts($isSettlement = false, $uId=0){
		$userId = ($uId==0)?(int)session('PYG_USER.userId'):$uId;
		$where = [];
		$where['c.userId'] = $userId;
        $prefix = config('database.prefix');
		if($isSettlement)$where['c.isCheck'] = 1;
		$rs = Db::table($prefix.'carts')
		           ->alias([$prefix.'carts'=>'c',$prefix.'goods' => 'g',$prefix.'goods_seckill' => 'gs'])
		           ->join($prefix.'goods','c.goodsId=g.goodsId','left')
                    ->join($prefix.'goods_seckill','c.goodsId=gs.product_id','left')
		           ->where($where)
		           ->field('c.cartId,g.goodsId,g.goodsName,g.marketPrice,g.goodsStock,g.goodsImg,gs.price,c.isPro,c.isCheck,c.cartNum,g.goodsCatId')
		           ->select();
		$carts = [];
		$goodsIds = [];
		$goodsTotalNum = 0;
		$goodsTotalMoney = 0;
		foreach ($rs as $key =>$v){
			//判断能否购买，预设allowBuy值为10，为将来的各种情况预留10个情况值，从0到9
			$v['allowBuy'] = 10;
			if($v['goodsStock']<=0){
				$v['allowBuy'] = 0;
			}else if($v['goodsStock']<$v['cartNum']){
				$v['cartNum'] = $v['goodsStock'];
			}
			if($isSettlement && $v['allowBuy']!=10){
				$this->disChkGoods($v['goodsId'],(int)session('PYG_USER.userId'));
				continue;
			}
			if($v['isCheck']==1 && $v['isPro'] ==1){
				$goodsTotalMoney = $goodsTotalMoney + $v['marketPrice'] * $v['cartNum'];

			}else{
                $goodsTotalMoney = $goodsTotalMoney + $v['price'] * $v['cartNum'];
            }


    		$goodsTotalNum = Db::table('__CARTS__')->where(['userId'=>$userId])->sum('cartNum');

			$carts['list'][] = $v;

			if($v['isPro'] == 2){
                $carts['list'][$key]['xiaoji'] = $v['price'] * $v['cartNum'];
            } else {
                $carts['list'][$key]['xiaoji'] = $v['marketPrice'] * $v['cartNum'];
            }

			if(!in_array($v['goodsId'],$goodsIds))$goodsIds[] = $v['goodsId'];
		}

		$cartData = ['carts'=>$carts['list'],'goodsTotalMoney'=>$goodsTotalMoney,'goodsTotalNum'=>$goodsTotalNum,'promotionMoney'=>0];
		return $cartData;   
	}
	
	/**
	 * 获取购物车商品列表
	 */
	public function getCartInfo($isSettlement = false,$uId = 0){
		$userId = ($uId>0)?$uId:(int)session('WST_USER.userId');
		$where = [];
		$where['c.userId'] = $userId;
		if($isSettlement)$where['c.isCheck'] = 1;
		$rs = $this->alias('c')->join('__GOODS__ g','c.goodsId=g.goodsId','inner')
		           ->join('__GOODS_SPECS__ gs','c.goodsSpecId=gs.id','left')
		           ->where($where)
		           ->field('c.goodsSpecId,c.cartId,g.goodsId,g.goodsName,g.shopPrice,g.goodsStock,g.isSpec,gs.specPrice,gs.specStock,g.goodsImg,c.isCheck,gs.specIds,c.cartNum')
		           ->select();
		$goodsIds = []; 
		$goodsTotalMoney = 0;
		$goodsTotalNum = 0;
		foreach ($rs as $key =>$v){
			if(!in_array($v['goodsId'],$goodsIds))$goodsIds[] = $v['goodsId'];
			if($v['isSpec']==1){
				$v['shopPrice'] = $v['specPrice'];
				$v['goodsStock'] = $v['specStock'];
			}
			if($v['goodsStock']<$v['cartNum']){
				$v['cartNum'] = $v['goodsStock'];
			}
			$goodsTotalMoney = $goodsTotalMoney + $v['shopPrice'] * $v['cartNum'];
			$rs[$key]['goodsImg'] = WSTImg($v['goodsImg']);
		}
	    //加载规格值
		if(count($goodsIds)>0){
		    $specs = DB::name('spec_items')->alias('s')->join('__SPEC_CATS__ sc','s.catId=sc.catId','left')
		        ->where([['s.goodsId','in',$goodsIds],['s.dataFlag','=',1]])->field('itemId,itemName')->select();
		    if(count($specs)>0){
		    	$specMap = [];
		    	foreach ($specs as $key =>$v){
		    		$specMap[$v['itemId']] = $v;
		    	}
			    foreach ($rs as $key =>$v){
			    	$strName = [];
			    	if($v['specIds']!=''){
			    		$str = explode(':',$v['specIds']);
			    		foreach ($str as $vv){
			    			if(isset($specMap[$vv]))$strName[] = $specMap[$vv]['itemName'];
			    		}
			    	}
			    	$rs[$key]['specNames'] = $strName;
			    }
		    }
		}
		$goodsTotalNum = count($rs);
		return ['list'=>$rs,'goodsTotalMoney'=>sprintf("%.2f", $goodsTotalMoney),'goodsTotalNum'=>$goodsTotalNum];
	}
	
	/**
	 * 删除购物车商品
	 */
	public function delCartByUpdate($goodsId){
		if(is_array($goodsId)){
            $this->where([['goodsId','in',$goodsId]])->delete();
		}else{
			$this->where('goodsId',$goodsId)->delete();
		}
		
	}

	/**
	 * 下单
	 */
	public function submit($orderSrc = 0,$uId=0){
		//检测购物车
		$carts = $this->getCarts();
		if(empty($carts['carts']))return PYGReturn("请选择要购买的商品");
		// $checkNum = $carts['carts']['goods']['goodsStock']-$carts['carts']['goods']['orderNum'];
		// if($checkNum<$carts['goodsTotalNum'])return PYGReturn("购买商品失败，商品剩余库存为".$checkNum);
         return $this->submitByEntity($carts,$uId);
		
	}

	/**
	 * 商品下单
	 */
	public function submitByEntity($carts,$uId=0){
		$addressId = (int)input('post.s_addressId');
		$payType = (int)input('post.payType');
		$userId = ($uId==0)?(int)session('PYG_USER.userId'):$uId;
		if($userId==0)return PYGReturn('您尚未登录系统，请先登录系统');
        //再次检查团购是否已满
        $goods = $carts['carts']['goods'];
		//检测地址是否有效
		$address = Db::name('user_address')->where(['userId'=>$userId,'addressId'=>$addressId,'dataFlag'=>1])->find();
		if(empty($address)){
			return PYGReturn("无效的用户地址");
		}
		$address['userAddress'] = $address['areaName'].$address['userAddress'];
		PYGUnset($address, 'isDefault,dataFlag,createTime,userId');
		Db::startTrans();
		try{
			$orderunique = PYGOrderQnique();
			$carts = $carts;
			//print_r($carts);die;
			$orderNo = PYGOrderNo();
			//创建订单
			$order = [];
			$order = array_merge($order,$address);
			$order['orderNo'] = $orderNo;
			$order['userId'] = $userId;
			$order['payType'] = $payType;
			$order['totalMoney'] = $carts['goodsTotalMoney'];
            if($payType === 1){
                $order['orderStatus'] = -2;//待付款
			    $order['isPay'] = 0; 
			    $order['payTime'] = date('Y-m-d H:i:s');  
                
			} else {
				$order['orderStatus'] = 0;//待发货
				if($order['needPay']==0){
					$order['isPay'] = 1; 
					$order['payTime'] = date('Y-m-d H:i:s'); 
				}
			}
			$order['orderunique'] = $orderunique;
			$order['dataFlag'] = 1;
			$order['createTime'] = date('Y-m-d H:i:s');
			$o = new O();
			$result = $o->data($order,true)->isUpdate(false)->allowField(true)->save($order);
			if(false !== $result){
				$orderId = $o->orderId;
				$goods = $carts['carts'];

				//创建订单商品记录
				$orderGgoods = [];
				foreach ($goods as $key => $value) {
				
					$orderGgoods['orderId'] = $orderId;
					$orderGgoods['goodsId'] = $value['goodsId'];
					$orderGgoods['goodsNum'] = $value['cartNum'];
					$orderGgoods['goodsPrice'] = $value['marketPrice'];
					$orderGgoods['goodsName'] = $value['goodsName'];
					$orderGgoods['goodsImg'] = $value['goodsImg'];	
					Db::name('order_goods')->insert($orderGgoods);
				}
				
				//建立订单记录
				$logOrder = [];
				$logOrder['orderId'] = $orderId;
				$logOrder['orderStatus'] = ($payType==1 && $order['needPay']==0)?-2:$order['orderStatus'];
				$logOrder['logContent'] = ($payType==1)?"下单成功，等待用户支付":"下单成功";
				$logOrder['logUserId'] = $userId;
				$logOrder['logType'] = 0;
				$logOrder['logTime'] = date('Y-m-d H:i:s');
				Db::name('log_orders')->insert($logOrder);
				if($payType==1 && $order['needPay']==0){
					$logOrder = [];
					$logOrder['orderId'] = $orderId;
					$logOrder['orderStatus'] = 0;
					$logOrder['logContent'] = "订单已支付，下单成功";
					$logOrder['logUserId'] = $userId;
					$logOrder['logType'] = 0;
					$logOrder['logTime'] = date('Y-m-d H:i:s');
					Db::name('log_orders')->insert($logOrder);
				}
			}
			Db::commit();
			session('GROUPON_CARTS',null);
			//清空购物车
			db('carts')->where('userId',$userId)->delete();
			return PYGReturn("提交订单成功", 1,$orderunique);
		}catch (\Exception $e) {
            Db::rollback();
            return PYGReturn('提交订单失败',-1);
        }
	}
}
