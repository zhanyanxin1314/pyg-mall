<?php
namespace app\common\model;
use think\Db;
use think\Model;

/**
 * 秒杀商品
 */
class GoodsSeckill extends Model{
	protected $pk = 'seckillid';

	/**
	* 获取秒杀商品信息
	*/
	public function getGoodsSeckill()
	{

		$list = Db::name('goods_seckill')
	    ->where(['is_show'=>1])
		->paginate((input('pagesize/d')>0)?input('pagesize/d'):16)->toArray();
		
		foreach ($list['data'] as $key => $value) {
			$stopTime = strtotime($value['stop_time']);
			if(time() >= $stopTime){
				$list['data'][$key]['stop'] = 1;
			}
		}
		return $list;
	}


	/**
	 * 获取商品资料在前台展示
	 */
     public function getBySale($goodsId){
     	$key = input('key');
		$rs = Db::name('goods_seckill')->where(['product_id'=>$goodsId,'is_show'=>1])->find();
		if(!empty($rs)){
			$rs['read'] = false;
			$rs['goodsDesc'] = $rs['goodsDesc'];
			$gallery = [];
			$gallery[] = $rs['image'];
			if($rs['image']!=''){
				$tmp = json_decode($rs['gallery']);
				$gallery = array_merge($gallery,$tmp);
			 }
			$rs['gallery'] = $gallery;
			$rs['score'] = Db::name('goods_appraises')->alias('ga')
		                      ->field('ga.*,u.userName,u.loginName')
						
						      ->join('__USERS__ u','ga.userId=u.userId','inner')
						      ->join('__GOODS__ oc','oc.goodsId=ga.goodsId','inner')
						      ->where('isShow',1)
						      ->paginate()
						      ->toArray();
		}
		return $rs;
	}
	
}
