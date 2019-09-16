<?php
namespace app\common\model;
use think\Db;
use think\Model;
/**
 * 浏览历史
 */
class History extends Model{
	protected $pk = 'historyId';

	/**
	 * 浏览历史列表
	 */
	public function listGoodsQuery(){
		$pagesize = input("param.pagesize/d");
		$userId = (int)session('PYG_USER.userId');
		$page = Db::name("history")->alias('h')
    	->join('__GOODS__ g','g.goodsId = h.targetId','left')
    	->field('h.historyId,h.targetId,h.score,g.goodsId,g.goodsName,g.goodsImg,g.marketPrice,g.saleNum')
    	->where(['h.userId'=> $userId])
    	->order('h.historyId desc')
    	->paginate($pagesize)->toArray();
		return $page;
	}

	/**
	 * 删除浏览历史
	 */
	public function del(){
		$id = input("param.id");
	
		$userId = (int)session('PYG_USER.userId');
		
		if(empty($id))return PYGReturn("取消失败", -1);
		$rs = $this->where([['targetId','=',$id],['userId','=',$userId]])->delete();
		if(false !== $rs){
			return PYGReturn("取消成功", 1);
		}else{
			return PYGReturn($this->getError(),-1);
		}
	}

	/**
	 * 新增浏览历史
	 */
	public function add(){
	    $id = input('goodsId/d',0);

		$userId = (int)session('PYG_USER.userId');
		$isFind = false;
		$c = Db::name('goods')->where(['dataFlag'=>1,'goodsId'=>$id])->count();
		$isFind = ($c>0);
		
		if(!$isFind)return PYGReturn("添加失败，无效的关注对象", -1);
		$data = [];
		$data['userId'] = $userId;
		$data['targetId'] = $id;
		$rc = $this->where($data)->count();
		if($rc>0){
			Db::name("history")->where($data)->setInc('score',1);
		} else {
			$data['createTime'] = date('Y-m-d H:i:s');
			$rs = $this->save($data);
		}
	}
}
