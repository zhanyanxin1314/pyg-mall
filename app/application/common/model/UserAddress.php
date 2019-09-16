<?php

namespace app\common\model;
use app\common\validate\UserAddress as Validate;
use think\Db;
use think\Model;

/**
 * 用户地址
 */
class UserAddress extends Model{
    
    protected $pk = 'addressId';

     /**
      * 获取用户地址列表
      */
      public function listQuery($userId){
         $where = ['userId'=>(int)$userId,'dataFlag'=>1];
         $rs = $this->order('isDefault asc, addressId desc')->where($where)->select()->toArray();
         return $rs;
      }
    /**
    *  获取用户信息
    */
    public function getById($id, $uId=0){
        $userId = ((int)$uId==0)?(int)session('PYG_USER.userId'):$uId;
    	$rs = $this->get(['addressId'=>$id,'userId'=>$userId,'dataFlag'=>1]);
        if(empty($rs))return [];
        return $rs;
    }

    /**
     * 新增
     */
    public function add($uId=0){

        $total = $this->where(['dataFlag'=>1])->count();
        if($total >=5){
            Return(3);
        }
        $data = input('post.');
        unset($data['addressId']);
        $data['userId'] = ((int)$uId==0)?(int)session('PYG_USER.userId'):$uId;
        $data['createTime'] = date('Y-m-d H:i:s');
        if($data['userId']==0)return PYGReturn('新增失败，请先登录');

        $validate = new Validate;
        if (!$validate->scene('add')->check($data)) {
        	return PYGReturn($validate->getError());
        }else{
        	$result = $this->allowField(true)->save($data);
        }
        if(false !== $result){
            //修改默认地址
            if((int)input('post.isDefault')==1){
            	$this->where("addressId != $this->addressId and userId=".$data['userId'])->setField('isDefault',0);
            }
          
            return PYGReturn("新增成功", 1,['addressId'=>$this->addressId,'total'=>$total]);
        }else{
            return PYGReturn($this->getError(),-1);
        }
    }

    /**
     * 编辑资料
     */
    public function edit($uId=0){
        $userId = ((int)$uId==0)?(int)session('PYG_USER.userId'):$uId;
        $id = (int)input('post.addressId');
        $data = input('post.');
       
        $validate = new Validate;
        if (!$validate->scene('edit')->check($data)) {
        	return PYGReturn($validate->getError());
        }else{
        	$result = $this->allowField(true)->save($data,['addressId'=>$id,'userId'=>$userId]);
        }
        //修改默认地址
        if((int)input('post.isDefault')==1)
          $this->where("addressId != $id and userId=".$userId)->setField('isDefault',0);
        if(false !== $result){
            return PYGReturn("编辑成功", 1);
        }else{
            return PYGReturn($this->getError(),-1);
        }
    }

    /**
     * 删除
     */
    public function del($uId=0){
        $userId = ((int)$uId==0)?(int)session('PYG_USER.userId'):$uId;
        $id = input('post.id/d');
        $data = [];
        $data['dataFlag'] = -1;
        $result = $this->update($data,['addressId'=>$id,'userId'=>$userId]);
        if(false !== $result){
            return PYGReturn("删除成功", 1);
        } else {
            return PYGReturn($this->getError(),-1);
        }
    }

    /**
    * 设置为默认地址
    */
    public function setDefault($uId=0){
        $userId = ((int)$uId==0)?(int)session('WST_USER.userId'):$uId;
        $id = (int)input('post.id');
        $this->where([['addressId','<>',$id],['userId','=',$userId]])->setField('isDefault',0);
        $rs = $this->where("addressId = $id and userId=".$userId)->setField('isDefault',1);
        if(false !== $rs){
            return WSTReturn("设置成功", 1);
        }else{
            return WSTReturn($this->getError(),-1);
        }
    }
    /**
     * 获取默认地址
     */
    public function getDefaultAddress($uId=0){
    	$userId = ((int)$uId==0)?(int)session('PYG_USER.userId'):$uId;
    	$where = ['userId'=>$userId,'dataFlag'=>1];
        $rs = $this->where($where)->order('isDefault desc,addressId desc')->find()->toArray();
        if(empty($rs))return [];
     
         return $rs;
    }

    /**
     * 修改收货人姓名-操作
    */
    public function editAddressName($addressId,$userName)
    {
        $userId = (int)session('PYG_USER.userId');  
        if(empty($addressId))return PYGReturn("编辑失败", -1);
        $rs = $this->where(['addressId'=>$addressId,'userId'=>$userId])->update(['userName' => $userName]);
        if(false !== $rs){
            return PYGReturn("修改成功", 1);
        } else {
            return PYGReturn($this->getError(),-1);
        }
    }
}
