<?php
namespace app\admin\model;
use think\Model;


/**
 * 积分配置-业务处理
 */
class UserBill extends Model{
	protected $pk = 'billId';
	
	/**
	 * 分页
	 */
	public function pageQuery(){
		return $this->paginate(input('limit/d'));
	}
}
