<?php
namespace app\admin\model;
use app\admin\model\Inform as M;
use think\Db;
use \think\Model;

/**
 * 投诉业务处理
 */
class Inform extends Model{
	/**
	 * 获取举报列表
	 */
	public function pageQuery(){
     	$informStatus = (int)Input('informStatus',-1);
	 	if($informStatus>-1)$where['o.informStatus']=$informStatus;
     	$where['o.dataFlag']=1;
		$order = [];
		$rs = Db::name('inform')->alias('o')
		                      ->field('o.*,u.userName,u.loginName,oc.goodsImg,oc.goodsId,oc.goodsName')
						
						      ->join('__USERS__ u','o.informTargetId=u.userId','inner')
						      ->join('__GOODS__ oc','oc.goodsId=o.goodId','inner')
						      ->where($where)
						      ->order('informId desc')
						      ->paginate()
						      ->toArray();
	   
		return $rs;
	}

	/**
	 * 获取举报信息
	 */
	 public function getDetail(){
	 	$informId = (int)Input('cid');
	 	$data = $this->alias('oc')
	 	             
					 ->join('__USERS__ u','oc.informTargetId=u.userId','inner')
	 				 ->where("oc.informId=$informId")
	 				 ->find();
	 	if($data){
			$data['userName'] = $data['loginName'];
		   
	 	}
	 	 return $data;
	 }


	 /**
	  * 处理
	  */
	 public function finalHandle(){
	 	$rd = array('status'=>-1,'msg'=>'无效的举报信息');
	 	$informId = (int)Input('cid');
	 	$finalResult = Input('finalResult');
	 	$informStatus = Input('informStatus');
	 	if($informId==0){
	 		return PYGReturn('无效的举报信息',-1);
	 	}

	 	//判断是否已经处理过了
	 	$rs = Db::name('inform')->alias('oc')
	 			   ->field('oc.informTargetId,oc.informStatus,oc.goodId,oc.informTargetId')
	 			   ->where("oc.informId=$informId")
	 			   ->find();

	    if($informStatus == 3){
	    	 try{
	    	 	$data['isInform']  = 0;
	    	 	$data1['informStatus']  = $informStatus;
	    	 	

	    	 	$ers = Db::name('inform')->where('informId='.$informId)->update($data1);
	 	        //$ers = Db::name('inform')->where('informTargetId='.$rs['informTargetId'])->delete();
	 	        $res = Db::name('users')->where('userId='.$rs['informTargetId'])->update($data);
	 	        if($ers!==false){
				            
					Db::commit();
					return PYGReturn('操作成功',2);
	 	        }
	 	    }catch(\Exception $e){
	 	    	Db::rollback();
	            return PYGReturn('操作失败',-1);
	 	    }
	    }

	 	if($rs['informStatus']!=1 && $rs['informStatus']!=2){
	 		$data = array();
	 		
	 		$data['informStatus'] = $informStatus;
	 		$data['respondContent'] = Input('finalResult');
	 		$data['finalHandleTime'] = date('Y-m-d H:i:s');
	 		Db::startTrans();
		    try{
	 	        $ers = Db::name('inform')->where('informId='.$informId)->update($data);
	 	        if($ers!==false){
	 	        	//下架商品
	 	        	if($informStatus == 2){
			 			$m = new M();
			 			$m->illegal($rs['goodId'],1);
			 		}
		 	        
				              
					Db::commit();
					return PYGReturn('操作成功',1);
	 	        }
	 	    }catch(\Exception $e){
	 	    	Db::rollback();
	            return PYGReturn('操作失败',-1);
	 	    }
	 	}else{
	 	    return PYGReturn('操作失败，该举报状态已发生改变，请刷新后重试!',-1);
	 	}

	 }
}
