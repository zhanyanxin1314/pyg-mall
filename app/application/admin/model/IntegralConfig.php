<?php
namespace app\admin\model;
use app\admin\validate\IntegralConfig as validate;
use think\Model;


/**
 * 积分配置-业务处理
 */
class IntegralConfig extends Model{
	protected $pk = 'configId';
	/**
	 * 分页
	 */
	public function pageQuery(){
		return $this->paginate(input('limit/d'));
	}
	public function getById($id){
		return $this->get(['configId'=>$id]);
	}

	/**
	 * 新增
	 */
	public function add(){
		$data = [
				'integralProportion'=>input('post.integralProportion'),
				'minimumPoints'=>input('post.minimumPoints'),
				'highestPoints'=>input('post.highestPoints')];

		$validate = new validate();

		if(!$validate->scene('add')->check($data))return PYGReturn($validate->getError());
		$result = $this->allowField(['integralProportion','minimumPoints','highestPoints'])->save($data);
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
		$configId = input('post.configId/d',0);
		$validate = new validate();
		if(!$validate->scene('edit')->check(['integralProportion'=>input('post.integralProportion'),'minimumPoints'=>input('post.minimumPoints'),'highestPoints'=>input('post.highestPoints')]))return PYGReturn($validate->getError());
	    $result = $this->allowField(['integralProportion','minimumPoints','highestPoints'])->save(['integralProportion'=>input('post.integralProportion'),'minimumPoints'=>input('post.minimumPoints'),'highestPoints'=>input('post.highestPoints')],['configId'=>$configId]);

        if(false !== $result){
        	return PYGReturn("编辑成功", 1);
        }else{
        	return PYGReturn($this->getError(),-1);
        }
	}
	
}
