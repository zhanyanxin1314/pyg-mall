<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\Favorites as M;
/**
 * 收藏控制器
 */
class Favorites extends Base{
	protected $beforeActionList = ['checkAuth'];
	/**
	 * 关注的商品
	 */
	public function goods(){
	    $this->assign("p",(int)input("p"));
		return $this->fetch('users/favorites/list_goods');
	}
	/**
	 * 关注的店铺
	 */
	public function shops(){
        $this->assign("p",(int)input("p"));
		return $this->fetch('users/favorites/list_shops');
	}
	/**
	 * 关注的商品列表
	 */
	public function listGoodsQuery(){
		$m = new M();
		$data = $m->listGoodsQuery();
		return WSTReturn("", 1,$data);
	}

	/**
	 * 取消关注
	 */
	public function cancel(){
		$m = new M();
		$rs = $m->del();
		return $rs;
	}
	/**
	 * 增加关注
	 */
	public function add(){
		$m = new M();
		$rs = $m->add();
		return $rs;
	}
}
