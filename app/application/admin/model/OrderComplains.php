<?php
namespace app\admin\model;
use think\Db;
use think\Model;

/**
 * 订单投诉业务处理
 */
class OrderComplains extends Model{

	/**
	 * 获取订单投诉列表
	 */
	public function pageQuery(){
		$startDate = input('startDate');
		$endDate = input('endDate');
		$shopName = Input('shopName');
     	$orderNo = Input('orderNo');
     	$complainStatus = (int)Input('complainStatus',-1);
     	// 搜素条件
     	$where = [];
		if($startDate!='' && $endDate!=''){
			$where[] = ['oc.complainTime','between',[$startDate.' 00:00:00',$endDate.' 23:59:59']];
		}else if($startDate!=''){
			$where[] = ['oc.complainTime','>=',$startDate.' 00:00:00'];
		}else if($endDate!=''){
			$where[] = ['oc.complainTime','<=',$endDate.' 23:59:59'];
		}
	 	if($complainStatus>-1)$where[] = ['oc.complainStatus','=',$complainStatus];
	 	if($orderNo!='')$where[] = ['o.orderNo','like',"%$orderNo%"];
     	$where[] = ['o.dataFlag','=',1];
     	$sort = input('sort');
		$order = [];
		if($sort!=''){
			$sortArr = explode('.',$sort);
			$order = $sortArr[0].' '.$sortArr[1];
		}
		$rs = Db::name('orders')->alias('o')
							  ->field('oc.complainId,o.orderId,o.orderNo,u.userName,u.loginName,oc.complainTime,oc.complainStatus,oc.complainType')
						      
						      ->join('__USERS__ u','o.userId=u.userId','inner')
						      ->join('__ORDER_COMPLAINS__ oc','oc.orderId=o.orderId','inner')
						      ->where($where)
						      ->order($order)
						      ->order('complainId desc')
						      ->paginate(input('limit/d'))
						      ->toArray();
	    foreach($rs['data'] as $key => $val){
	    	if($val['complainType'] == 1){
				$rs['data'][$key]['complainName'] = '承诺的没有做到';
	    	}elseif($val['complainType'] == 2){
				$rs['data'][$key]['complainName'] = '未按约定时间发货';
	    	}elseif($val['complainType'] == 3){
				$rs['data'][$key]['complainName'] = '未按成交价进行交易';
	    	}else{
	    		$rs['data'][$key]['complainName'] = '恶意骚扰';
	    	}
	    }
	
		return $rs;
	}

	/**
	 * 获取订单详细信息
	 */
	 public function getDetail(){
	 	$complainId = (int)Input('cid');
	 	$data = $this->alias('oc')
	 				 ->field('oc.*,u.userName,u.loginName')
	 				 ->join('__USERS__ u','oc.complainTargetId=u.userId','inner')
	 				 ->where("oc.complainId=$complainId")
	 				 ->find();
	 	if($data){
	 		
			$data['userName'] = ($data['userName']=='')?$data['loginName']:$data['userName'];
		 	$rs = Db::name('orders')->alias('o')
		 					  ->field('o.orderStatus,o.userAddress,o.orderNo,o.userName,o.userAddress')
		 					 
		 					  ->where(['o.dataFlag'=>1,
		 					  		   'o.orderId'=>$data['orderId']])
		 					  ->find();
	
			//获取相关商品
			$rs['goodslist'] = Db::name('order_goods')->where(['orderId'=>$data['orderId']])->select();
			$data['order'] = $rs;
	 	}
		return $data;
	 }

	 /**
	  * 转交给应诉人应诉
	  */
	 public function deliverRespond(){
	 	$id = (int)Input('id');
	 	if($id==0){
	 		return WSTReturn('无效的投诉信息',-1);
	 	}
	 	//判断是否已经处理过了
	 	$rs = $this->alias('oc')
	 			   ->field('oc.complainStatus,oc.respondTargetId,o.orderNo,s.userId,o.shopId')
	 			   ->join('__ORDERS__ o','oc.orderId=o.orderId','inner')
	 			   ->join('__SHOPS__ s','o.shopId = s.shopId','left')
	 			   ->where("complainId=$id")
	 			   ->find();
	 	if($rs['complainStatus']==0){
	 		$data = array();
	 		$data['complainStatus'] = 1;
	 		$data['deliverRespondTime'] = date('Y-m-d H:i:s');
	 		Db::startTrans();
		    try{
		 	    $ers = $this->where('complainId='.$id)->update($data);
		 	    if($ers!==false){
			 	    //发站内信息提醒
					$tpl = WSTMsgTemplates('ORDER_NEW_COMPLAIN');
			        if( $tpl['tplContent']!='' && $tpl['status']=='1'){
			            $find = ['${ORDER_NO}'];
			            $replace = [$rs['orderNo']];
			            $msg = array();
			            $msg["shopId"] = $rs["shopId"];
			            $msg["tplCode"] = $tpl["tplCode"];
			            $msg["msgType"] = 1;
			            $msg["content"] = str_replace($find,$replace,$tpl['tplContent']) ;
			            $msg["msgJson"] = ['from'=>3,'dataId'=>$id];
			            model("common/MessageQueues")->add($msg);
			        }
					Db::commit();
					return WSTReturn('操作成功',1);
		 	    }
		    }catch (\Exception $e) {
	            Db::rollback();
	            return WSTReturn('操作失败',-1);
	        }
	 	}else{
	 	    return WSTReturn('操作失败，该投诉状态已发生改变，请刷新后重试!',-1);
	 	}
	 	return $rd;
	 }

	 /**
	  * 仲裁
	  */
	 public function finalHandle(){
	 	$rd = array('status'=>-1,'msg'=>'无效的投诉信息');
	 	$complainId = (int)Input('cid');
	 	if($complainId==0){
	 		return PYGReturn('无效的投诉信息',-1);
	 	}
	 	//判断是否已经处理过了
	 	$rs = $this->alias('oc')
	 			   ->field('oc.complainStatus,o.userId,o.orderNo,o.orderId')
	 			   ->join('__ORDERS__ o','oc.orderId=o.orderId','inner')
	 			   
	 			   ->where("complainId=$complainId")
	 			   ->find();
	 	if($rs['complainStatus']!=4){
	 		$data = array();
	 		$data['complainStatus'] = 4;
	 		$data['finalResult'] = Input('finalResult');
	 		$data['finalResultTime'] = date('Y-m-d H:i:s');
	 		Db::startTrans();
		    try{
	 	        $ers = $this->where('complainId='.$complainId)->update($data);
	 	        if($ers!==false){	 
					             
					Db::commit();
					return PYGReturn('操作成功',1);
	 	        }
	 	    }catch(\Exception $e){
	 	    	Db::rollback();
	            return PYGReturn('操作失败',-1);
	 	    }
	 	}else{
	 	    return PYGReturn('操作失败，该投诉状态已发生改变，请刷新后重试!',-1);
	 	}

	 }
}
