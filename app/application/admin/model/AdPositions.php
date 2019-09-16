<?php
namespace app\admin\model;
use app\admin\validate\AdPositions as validate;
use think\Db;
use think\Model;

/**
 * 广告位置业务处理
 */
class AdPositions extends Model{
	protected $pk = 'positionId';
	/**
	 * 分页
	 */
	public function pageQuery(){
		$key = input('key');
		$where[] = ['dataFlag','=',1];
        if($key !='')$where[] = ['positionCode','like','%'.$key.'%'];
		return $this->where($where)->field(true)->order('apSort asc,positionName asc')->paginate(input('limit/d'));
	}
	public function getById($id){
		return $this->get(['PositionId'=>$id,'dataFlag'=>1]);
	}
	/**
	 * 新增
	 */
	public function add(){

		$data = input('post.');
		PYGUnset($data,'positionId');
		$validate = new validate();
		if(!$validate->scene('add')->check($data))return PYGReturn($validate->getError());
		$result = $this->allowField(true)->save($data);
        if(false !== $result){
        	return PYGReturn("新增成功", 1);
        }else{
        	return PYGReturn($this->getError(),-1);
        }
	}
    /**
	 * 编辑
	 */
	public function edit(){
		$data = input('post.');
		$Id = (int)input('post.positionId');
		$validate = new validate();
		if(!$validate->scene('edit')->check($data))return PYGReturn($validate->getError());
	    $result = $this->allowField(true)->save($data,['positionId'=>$Id]);
        if(false !== $result){
        	return PYGReturn("编辑成功", 1);
        }else{
        	return PYGReturn($this->getError(),-1);
        }
	}
	/**
	 * 删除
	 */
    public function del(){
	    $id = (int)input('post.id/d');
	    $result = $this->setField(['positionId'=>$id,'dataFlag'=>-1]);
        if(false !== $result){
        	return PYGReturn("删除成功", 1);
        }else{
        	return PYGReturn($this->getError(),-1);
        }
	}
	/**
	* 获取广告位置
	*/
	public function getPositon($typeId){
		return $this->where(['positionType'=>$typeId,'dataFlag'=>1])->order('apSort asc,positionId asc')->select();
	}
	
}
