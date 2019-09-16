<?php

// +----------------------------------------------------------------------
// | 商品秒杀模型
// +----------------------------------------------------------------------

namespace app\admin\model;
use app\admin\validate\GoodsSeckill as Validate;
use think\Db;
use \think\Model;

/**
 * 商品秒杀类
 */
class GoodsSeckill extends Model{

	protected $pk = 'seckillId';

    /**
      *  商品列表
    */
	public function saleByPage(){
		$where = [];
		$where[] = ['is_del',"=",0];
		$title = input('title');
		if($title != ''){
			$where[] = ['title','like',"%$title%"];
		}
		$rs = $this->where($where)
			->order('seckillId', 'desc')
			->paginate(input('limit/d'))->toArray();
		return $rs;
	}

	/**
	 * 获取秒杀商品资料方便编辑
	 */
	public function getById($seckillId){
		$rs = $this->where(['seckillId'=>$seckillId])->find();
		return $rs;
	}

	/**
	 * 新增商品
	 */
	public function add($sId=0){
		$data = input('post.');
		$data['add_time'] = date('Y-m-d H:i:s');
        $data['product_id'] = $data['goodsId'];
        $data['gallery'] = json_encode($data['gallery']);
		Db::startTrans();
        try{
        	$validate = new Validate;
        	if (!$validate->scene(true)->check($data)) {
        		return PYGReturn($validate->getError());
        	} else {
        		$result = $this->allowField(true)->save($data);
        	}
			if(false !== $result){
				$goodsId = $this->goodsId;
    	        Db::commit();
				return PYGReturn("新增成功", 1,['id'=>$goodsId]);
			} else {
				return PYGReturn($this->getError(),-1);
			}
        }catch (\Exception $e) {
            Db::rollback();
            return PYGReturn('新增失败'.$e->getMessage().$this->getLastSql(),-1);
        }
	}

	/**
	 * 编辑商品资料
	 */
	public function edit($sId=0){
	    $seckillId = input('post.seckillId/d');
		$data = input('post.');
		$ogoods = $this->where(['seckillId'=>$seckillId,'is_show'=>1])->find();
		if(empty($ogoods))return PYGReturn('商品不存在');
		Db::startTrans();
        try{
			$validate = new Validate;
			if (!$validate->scene(true)->check($data)) {
				return PYGReturn($validate->getError());
			}else{
				$result = $this->allowField(true)->save($data,['seckillId'=>$seckillId]);
			}
			if(false !== $result){
				Db::commit();
				return PYGReturn("编辑成功", 1,['id'=>$goodsId]);
			} else {
				return PYGReturn($this->getError(),-1);
			}
	    }catch (\Exception $e) {
        	Db::rollback();
            return PYGReturn('编辑失败',-1);
        }
	}

	/**
	 * 删除商品
	 */
	public function del(){
	    $id = input('post.id/d');
		$data = [];
		$data['is_del'] = 1;
		Db::startTrans();
		try{
		    $result = $this->update($data,['seckillId'=>$id]);
	        if(false !== $result){
				Db::commit();
				PYGClearAllCache();
	        	return PYGReturn("删除成功", 1);
	        }
		}catch (\Exception $e) {
            Db::rollback();
        }
        return PYGReturn('删除失败',-1);
	}
}
