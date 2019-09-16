<?php 
namespace app\admin\validate;
use think\Validate;

/**
 * 广告验证器
 */
class Ads extends Validate{
	protected $rule = [
        'adName' => 'require|max:30',
        'adFile' => 'require'
    ];

    protected $message = [
        'adName.require' => '请输入广告标题',
        'adName.max' => '广告标题不能超过10个字符',
        'adFile.require' => '请上传广告图片'
    ];

    protected $scene = [
        'add'   =>  ['adName','adURL'],
        'edit'  =>  ['adName','adURL'],
    ]; 
}