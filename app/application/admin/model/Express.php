<?php
namespace app\admin\model;
use app\admin\validate\Express as validate;

use \think\Model;
/**
 * 快递业务处理
 */
class Express extends Model{
	/**
	 * 分页
	 */
	public function pageQuery(){
		return $this->where('dataFlag',1)->field('expressId,expressName,expressCode')->order('expressId desc')->paginate(input('limit/d'));
	}
	public function getById($id){
		return $this->get(['expressId'=>$id,'dataFlag'=>1]);
	}
	/**
	 * 新增
	 */
	public function add(){
		$data = ['expressName'=>input('post.expressName'),'expressCode'=>input('post.expressCode')];
		$validate = new validate();
		if(!$validate->scene('add')->check($data))return PYGReturn($validate->getError());
		$result = $this->allowField(['expressName','expressCode'])->save($data);
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
		$expressId = input('post.expressId/d',0);
		$validate = new validate();
		if(!$validate->scene('edit')->check(['expressName'=>input('post.expressName')]))return PYGReturn($validate->getError());
	    $result = $this->allowField(['expressName','expressCode'])->save(['expressName'=>input('post.expressName'),'expressCode'=>input('post.expressCode')],['expressId'=>$expressId]);

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
	    $id = (int)input('post.id/d',0);
		$data = [];
		$data['dataFlag'] = -1;
	    $result = $this->update($data,['expressId'=>$id]);
        if(false !== $result){
        	return PYGReturn("删除成功", 1);
        }else{
        	return PYGReturn($this->getError(),-1);
        }
	}
	
}
