<?php
namespace app\common\model;
use think\Db;
use think\Model;

/**
 * 商品分类类
 */
class GoodsCats extends Model{
	protected $pk = 'catId';
	/**
	 * 获取列表
	 */
	public function listQuery($parentId,$isFloor = -1){
		$dbo = $this->where(['dataFlag'=>1,'isShow'=>1,'parentId'=>$parentId]);
		if($isFloor!=-1)$dbo->where('isFloor',$isFloor);
		return $dbo->order('catSort asc')->select();
	}


    /**
     * 获取店铺申请的商品分类
     */
    public function getShopApplyGoodsCats($shopId){
    	$ids = Db::name('cat_shops')->where(['shopId'=>$shopId])->column('catId');
    	return $this->getChildIds($ids);
    }

	/**
	 * 根据父分类获取其下所有子分类[包括自己]
	 */
	public function getChildIds($ids,$data = []){
		$data = array_merge($data,$ids);
		$rs = $this->where([['dataFlag','=',1],['isShow','=',1],['parentId','in',$ids]])->column('catId');
        if(count($rs)>0){
            return $this->getChildIds($rs,$data);
        }else{
        	return $data;
        }
	}
	
	/**
	 * 根据子分类获取其父级分类
	 */
	public function getParentIs($id,$data = array()){
		$data[] = $id;
		$parentId = $this->where('catId',$id)->value('parentId');
		if($parentId==0){
			krsort($data);
			return $data;
		}else{
			return $this->getParentIs($parentId, $data);
		}
	}
	public function getParentNames($id){
		if($id<=0)return [];
	    $ids = $this->getParentIs($id);
        $rs = Db::name('goodsCats')->where([['catId','in',$ids]])->field('catName')->order('catId desc')->select();
        $names = [];
        foreach($rs as $v){
            $names[] = $v['catName'];
        }
        return $names;
	}
   /**
     * 获取首页楼层
     */
    public function getFloors(){
	    $cats1 = Db::name('goods_cats')->where([['dataFlag','=',1],['isShow','=',1] ,['parentId','=',0],['isFloor','=',1]])
		             ->field("catName,catId,subTitle")->order('catSort')->limit(10)->select();
		if(!empty($cats1)){
			$ids = [];
			foreach ($cats1 as $key =>$v){
				$ids[] = $v['catId'];
			}
			$cats2 = [];
			$rs = Db::name('goods_cats')->where([['dataFlag','=',1],['isShow','=',1],['parentId','in',$ids],['isFloor','=',1]])
				             ->field("parentId,catName,catId,subTitle")->order('catSort asc')->select();
			foreach ($rs as $key => $v){
				$cats2[$v['parentId']][] = $v;
			}
			foreach ($cats1 as $key =>$v){
				$cats1[$key]['children'] = (isset($cats2[$v['catId']]))?$cats2[$v['catId']]:[];
			}
		}
		return $cats1;
    }
}
