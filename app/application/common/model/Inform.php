<?php
namespace app\common\model;
use think\Db;
use think\Model;

/**
 * 举报类
 */
class Inform extends Model{
	protected $pk = 'informId';

	/**
	 * 跳到举报列表
	 */
	public function inform(){
		$id = input('id');
		$type = input('type');
		$userId = (int)session('PYG_USER.userId');
		//判断用户是否拥有举报权利
		    $s = Db::name('users')->where("userId=$userId")->find();
		    if($s['isInform']==0)return WSTReturn("你已被禁止举报！", -1);
		//判断记录是否存在
		$isFind = false;
			$c = Db::name('goods')->where(['dataFlag'=>1,'goodsId'=>$id])->find();
			$isFind = ($c>0);
		if(!$isFind)return PYGReturn("举报失败，无效的举报对象", -1);
		   
		return PYGReturn('',1,$c);
	} 
	
	/**
	  * 获取用户举报列表
	  */
	public function queryUserInformByPage(){
		$userId = (int)session('PYG_USER.userId');
		$where['oc.informTargetId'] = $userId;
		$rs = $this->alias('oc')
				   ->join('__GOODS__ o','oc.goodId=o.goodsId and o.dataFlag=1','inner')
				   ->order('oc.informId asc')
				   ->where($where)
				   ->paginate()->toArray();

		foreach($rs['data'] as $k=>$v){
			if($v['informStatus']==0){
				$rs['data'][$k]['informStatus'] = '等待处理';
			}elseif($v['informStatus']==1){
				$rs['data'][$k]['informStatus'] = '无效举报';
			}elseif($v['informStatus']==2){
				$rs['data'][$k]['informStatus'] = '有效举报';
			}elseif($v['informStatus']==3){
				$rs['data'][$k]['informStatus'] = '恶意举报';
			}
		}
		if($rs !== false){
			return PYGReturn('',1,$rs);
		}else{
			return PYGReturn($this->getError(),-1);
		}
	}

	// 判断是否已经举报过
	public function alreadyInform($goodsId,$userId){
		return $this->field('informId')->where("goodId=$goodsId and informTargetId=$userId")->find();
	}

	// 判断是否已经被禁止举报
	public function alreadyForbidInform($userId){
		return model('users')->where("isInform = 0 and userId=$userId")->find();
	}

	/**
	 * 保存商品举报信息
	 */
	public function saveInform(){

		$userId = (int)session('PYG_USER.userId');
        $data['goodId'] = (int)input('goodsId');
        $rs1 = $this->alreadyForbidInform($userId);
        if($rs1){
       		return PYGReturn("您已经被禁止举报任何商品!",-1);
        }
		//判断是否提交过举报
		$rs = $this->alreadyInform($data['goodId'],$userId);
		if((int)$rs['informId']>0){
			return PYGReturn("该订单已进行了举报,请勿重提提交举报信息",-1);
		}
		Db::startTrans();
		try{
			$data['informTargetId'] = $userId;
			$data['informStatus'] = 0;
			$data['informType'] = (int)input('informType');
			$data['informTime'] = date('Y-m-d H:i:s');
			$data['informContent'] = input('informContent');
			$rs = $this->save($data);
			if($rs !==false){
				Db::commit();
				return PYGReturn('',1);
			}else{
				return PYGReturn($this->getError(),-1);
			}
		}catch (\Exception $e) {
		    Db::rollback();
	    }
	    return PYGReturn('举报失败',-1);
	}
	
    /**
	 * 获取举报详情
	 */
	public function getUserInformDetail($userType = 0){
		$userId = (int)session('PYG_USER.userId');
		$id = (int)Input('id');
		if($userId==0){
			$where['informTargetId']=$userId;
		}

		//获取举报信息
		$where['informId'] = $id;
		$rs = Db::name('inform')->alias('oc')
		           ->field('oc.*,o.goodsId ,o.goodsName, o.goodsImg')
				   ->join('__GOODS__ o','oc.goodId=o.goodsId and o.dataFlag=1','inner')
				   ->where($where)->find();
        return $rs;
	}
}