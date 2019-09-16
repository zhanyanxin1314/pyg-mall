<?php
namespace app\admin\model;
use app\admin\validate\Bank as validate;
use think\Model;


/**
 * 银行业务处理
 */
class Bank extends Model{
	protected $pk = 'bankId';
	/**
	 * 分页
	 */
	public function pageQuery(){
		return $this->where('dataFlag',1)->field('bankId,bankName')->order('bankId desc')->paginate(input('limit/d'));
	}
	public function getById($id){
		return $this->get(['bankId'=>$id,'dataFlag'=>1]);
	}
	/**
	 * 列表
	 */
	public function listQuery(){
		return $this->where('dataFlag',1)->field('bankId,bankName')->select();
	}
	/**
	 * 新增
	 */
	public function add(){
		$data = ['bankName'=>input('post.bankName'),
				 'createTime'=>date('Y-m-d H:i:s'),];
		$validate = new validate();
		if(!$validate->scene('add')->check($data))return PYGReturn($validate->getError());
		$result = $this->allowField(['bankName','createTime'])->save($data);
        if(false !== $result){
        	cache('PYG_BANKS',null);
        	return PYGReturn("新增成功", 1);
        }else{
        	return PYGReturn($this->getError(),-1);
        }
	}
    /**
	 * 编辑
	 */
	public function edit(){
		$bankId = input('post.bankId/d',0);
		$validate = new validate();
		if(!$validate->scene('edit')->check(['bankName'=>input('post.bankName')]))return PYGReturn($validate->getError());
	    $result = $this->allowField(['bankName'])->save(['bankName'=>input('post.bankName')],['bankId'=>$bankId]);

        if(false !== $result){
        	cache('PYG_BANKS',null);
        	return PYGReturn("编辑成功", 1);
        }else{
        	return PYGReturn($this->getError(),-1);
        }
	}
	/**
	 * 删除
	 */
    public function del(){
	    $id = input('post.id/d',0);
		$data = [];
		$data['dataFlag'] = -1;
	    $result = $this->update($data,['bankId'=>$id]);
        if(false !== $result){
        	cache('PYG_BANKS',null);
        	return PYGReturn("删除成功", 1);
        }else{
        	return PYGReturn($this->getError(),-1);
        }
	}
	
}
