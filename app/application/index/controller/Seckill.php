<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\GoodsSeckill as M;
use think\Request;
use think\Facade\Config;
use think\Facade\Cache;
use think\Db;
class Seckill extends Base
{

    public function initialize(){
            parent::initialize();
            $m = new M();
            $goods_id = input('goodsId/d',0); 
            if($goods_id){
                $this->goods_id = $goods_id;
            }
            $goods = $m->field('product_id,stock,stop_time')->select()->toArray();
            foreach ($goods as $key => $value) {
                if(time() <= strtotime($value['stop_time'])){
                    $store = $value['stock'];
                    Cache::store('redis')->del($value['product_id'] . '-goods_store');
                    $res= Cache::store('redis')->llen($value['product_id'].'-goods_store');
                    $count=$store - $res;
                    for($i=0;$i<$count;$i++){
                        Cache::store('redis')->lpush($value['product_id'].'-goods_store',1);
                    }
                }
        }
    }
    /**
     * 秒杀首页
     */
    public function index()
    {
    	$m = new M();
        $seckillGoodsList = Cache::store('redis')->get('seckillGoods');
        if(empty($seckillGoodsList)){
            $seckillGoodsList = $m->getGoodsSeckill();
            Cache::store('redis')->set('seckillGoods',$seckillGoodsList);
        }
    	$this->assign('seckillGoodsList',$seckillGoodsList);
        return $this->fetch();
    }

    /**
     * 商品详情
     */
    public function detail()
    {
        $m = new M();
        $where['product_id'] = $this->goods_id;
        $goods = $m->where($where)->field('stock,start_time,stop_time')->find();
        $start_time = strtotime($goods['start_time']);
        $stop_time = strtotime($goods['stop_time']);
        if(time() >= $stop_time){
              $this->error("当前秒杀已结束！",url('index/seckill/index'));
        }
        $goods = $m->getBySale($this->goods_id);
        if(!empty($goods)){
            $this->assign('goods',$goods);
            return $this->fetch();
        } else {
            return $this->fetch("error_lost");
        }
    }
}
