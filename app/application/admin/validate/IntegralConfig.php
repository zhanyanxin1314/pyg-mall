<?php 

namespace app\admin\validate;
use think\Validate;

/**
 * 积分配置验证器
 */
class IntegralConfig extends Validate{
	protected $rule = [
        'integralProportion' => 'require',
        'minimumPoints' => 'require',
        'highestPoints' => 'require',
    ];
    
    protected $message = [
        'integralProportion.require' => '请输入积分抵用比例',
        'minimumPoints.require' => '请输入签到奖励最低积分',
        'highestPoints.require' => '请输入签到奖励最高积分',
        
    ];
    protected $scene = [
        'add'   =>  ['integralProportion','minimumPoints','highestPoints'],
        'edit'  =>   ['integralProportion','minimumPoints','highestPoints'],
    ]; 
}