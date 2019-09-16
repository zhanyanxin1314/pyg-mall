<?php
namespace app\common\model;
use think\Db;
use think\Model;
/**
 * 收藏类
 */
class Favorites extends Model{
	protected $pk = 'favoriteId';
	/**
	 * 关注的商品列表
	 */
	public function listGoodsQuery(){
		$pagesize = input("param.pagesize/d");
		$userId = (int)session('PYG_USER.userId');
		$page = Db::name("favorites")->alias('f')
    	->join('__GOODS__ g','g.goodsId = f.targetId','left')
    	->field('f.favoriteId,f.targetId,g.goodsId,g.goodsName,g.goodsImg,g.marketPrice,g.saleNum')
    	->where(['f.userId'=> $userId])
    	->order('f.favoriteId desc')
    	->paginate($pagesize)->toArray();
		return $page;
	}

	/**
	 * 取消关注
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
	 * 新增关注
	 */
	public function add(){
	    $id = input("param.id/d");
		$userId = (int)session('PYG_USER.userId');
		if($userId==0)return PYGReturn('关注失败，请先登录',-2);
		//判断记录是否存在
		$isFind = false;
		$c = Db::name('goods')->where(['dataFlag'=>1,'goodsId'=>$id])->count();
		$isFind = ($c>0);
		
		if(!$isFind)return PYGReturn("关注失败，无效的关注对象", -1);
		$data = [];
		$data['userId'] = $userId;
		$data['targetId'] = $id;
		//判断是否已关注
		$rc = $this->where($data)->count();
		if($rc>0)return PYGReturn("关注成功", 1);
		$data['createTime'] = date('Y-m-d H:i:s');
		$rs = $this->save($data);
		if(false !== $rs){
			return PYGReturn("关注成功", 1,['fId'=>$id]);
		}else{
			return PYGReturn($this->getError(),-1);
		}
	}
	/**
	 * 判断是否已关注
	 */
	public function checkFavorite($id,$type,$uId=0){
		$userId = ($uId==0)?(int)session('WST_USER.userId'):$uId;
		$rs = $this->where(['userId'=>$userId,'favoriteType'=>$type,'targetId'=>$id])->find();
		return empty($rs)?0:$rs['favoriteId'];
	}
	/**
	 * 关注数
	 */
	public function followNum($id,$type){
		$rs = $this->where(['favoriteType'=>$type,'targetId'=>$id])->count();
		return $rs;
	}
}
