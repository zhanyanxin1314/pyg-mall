<?php
namespace app\admin\validate;
use think\Validate;

/**
 * 商品秒杀验证器
 */
class GoodsSeckill extends Validate{
	protected $rule = [
		'title' => 'require|max:100'
	];
	
	protected $message  =  [
		'title.require' => '请输入秒杀名称'
	];

}