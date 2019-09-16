<?php
namespace app\admin\model;
use app\admin\validate\GoodsAppraises as validate;
use think\Db;
use think\Model;
/**
 * 商品评价业务处理
 */
class GoodsAppraises extends Model{
	/**
	 * 分页
	 */
	public function pageQuery(){
		$where = 'gp.goodsId=g.goodsId and o.orderId=gp.orderId  and gp.dataFlag=1';

     	$goodsName = input('goodsName');


	 	if($goodsName!='')
	 		$where.=" and (g.goodsName like '%".$goodsName."%' or g.goodsSn like '%".$goodsName."%')";
	 	$sort = input('sort');
		$order = [];
		if($sort!=''){
			$sortArr = explode('.',$sort);
			$order = $sortArr[0].' '.$sortArr[1];
		}
		$rs = $this->alias('gp')->field('gp.*,g.goodsName,g.goodsImg,o.orderNo,u.loginName')
					->join('__GOODS__ g ','gp.goodsId=g.goodsId','left') 
		         	->join('__ORDERS__ o','gp.orderId=o.orderId','left')
		         	->join('__USERS__ u','u.userId=gp.userId','left')
		         	->where($where)
		         	->order($order)
		         	->order('id desc')
		         	->paginate(input('limit/d'))->toArray();
		return $rs;
	}
	public function getById($id){
		return $this->alias('gp')->field('gp.*,o.orderNo,u.loginName,g.goodsName,g.goodsImg')
					->join('__GOODS__ g ','gp.goodsId=g.goodsId','left') 
		         	->join('__ORDERS__ o','gp.orderId=o.orderId','left')
		         	->join('__USERS__ u','u.userId=gp.userId','left')
		         	->where('gp.id',$id)->find();
	}
    /**
	 * 编辑
	 */
	public function edit(){
		$Id = input('post.id/d',0);
		$data = input('post.');
		$data['isShow'] = ((int)$data['isShow']==1)?1:2;
		PYGUnset($data,'createTime');
		Db::startTrans();
        try{
        	$validate = new validate();
		    if(!$validate->scene('edit')->check($data))return PYGReturn($validate->getError()); 
		    $result = $this->allowField(true)->save($data,['id'=>$Id]);
	        if(false !== $result){
	        	$goodsAppraises = $this->get($Id);
	        	Db::commit();
	        	return PYGReturn("编辑成功", 1);
	        }else{
	        	return PYGReturn($this->getError(),-1);
	        }
	    }catch (\Exception $e) {
            Db::rollback();
        }
        return PYGReturn("编辑失败");
	}
	/**
	 * 删除
	 */
    public function del(){
	    $id = input('post.id/d',0);
	    Db::startTrans();
        try{
		    $goodsAppraises = $this->get($id);
		    $goodsAppraises->dataFlag = -1;
		    $result = $goodsAppraises->save();
	        if(false !== $result){
	        	Db::commit();
	        	return PYGReturn("删除成功", 1);
	        }else{
	        	return PYGReturn($this->getError(),-1);
	        }
	    }catch (\Exception $e) {
            Db::rollback();
        }
        return PYGReturn("删除失败");
	}

	
	
}
