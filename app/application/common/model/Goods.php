<?php
namespace app\common\model;
use think\Db;
use think\Model;
use think\Config;
use app\common\validate\Goods as Validate;

/**
 * 商品类
 */
class Goods extends Model{

	protected $pk = 'goodsId';

	/**
	 * 获取 8-12 点得秒杀商品
	 */
	public function getBaToShiEr(){

		$time  = time();
		$startTime1 = strtotime(config('proStartTimeShiEr'));
		$endTime1 = strtotime(config('proEndTimeShiSi'));		
		$where['dataFlag'] = 1;
		$where['proStartTime'] = config('proStartTimeShiEr');
		$where['proEndTime'] = config('proEndTimeShiSi');;
		$goodsList = $this->where($where)->field('goodsName,goodsImg,marketPrice,
			proPrice,proStartTime,proEndTime,goodsStock')->select()->toArray();
		return $goodsList;
	}
}
