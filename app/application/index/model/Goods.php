<?php
namespace app\index\model;
use app\common\model\Goods as CGoods;
use think\Db;

/**
 * 商品类
 */
class Goods extends CGoods{

	public function getById($id){
		return $this->get(['goodsId'=>$id,'dataFlag'=>1])->toArray();
	}

	/**
	 * 获取商品资料在前台展示
	 */
     public function getBySale($goodsId){
     	$key = input('key');
     	// 浏览量
     	$this->where('goodsId',$goodsId)->setInc('visitNum',1);
		$rs = Db::name('goods')->where(['goodsId'=>$goodsId,'dataFlag'=>1])->find();
		if(!empty($rs)){
			$rs['read'] = false;
			$rs['goodsDesc'] = $rs['goodsDesc'];
			//判断是否可以公开查看
			$gallery = [];
			$gallery[] = $rs['goodsImg'];
			if($rs['gallery']!=''){
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

			//品牌名称
			$rs['brandName'] = Db::name('brands')->where(['brandId'=>$rs['brandId']])->value('brandName');
		}
		return $rs;
	}
	
	
    /**
     * 获取符合筛选条件的商品ID
     */
    public function filterByAttributes(){
    	$vs = input('vs');
    	if($vs=='')return [];
    	$vs = explode(',',$vs);
    	$goodsIds = [];
    	$prefix = config('database.prefix');
		//循环遍历每个属性相关的商品ID
	    foreach ($vs as $v){
	    	$goodsIds2 = [];
	    	$attrVal = input('v_'.(int)$v);
	    	if($attrVal=='')continue;
	    	if(stristr($attrVal,'、')!==false){
	    		// 同属性多选
	    		$attrArr = explode('、',$attrVal);
	    		foreach($attrArr as $v1){
	    			$sql = "select goodsId from ".$prefix."goods_attributes where attrId=".(int)$v." and find_in_set('".$v1."',attrVal) ";
					$rs = Db::query($sql);
					if(!empty($rs)){
						foreach ($rs as $vg){
							$goodsIds2[] = $vg['goodsId'];
						}
					}
	    		}
	    	}else{
		    	$sql = "select goodsId from ".$prefix."goods_attributes 
		    	where attrId=".(int)$v." and find_in_set('".$attrVal."',attrVal) ";
				$rs = Db::query($sql);
				if(!empty($rs)){
					foreach ($rs as $vg){
						$goodsIds2[] = $vg['goodsId'];
					}
				}
	    	}
			//如果有一个属性是没有商品的话就不需要查了
			if(empty($goodsIds2))return [-1];
			//第一次比较就先过滤，第二次以后的就找集合
			$goodsIds2[] = -1;
			if(empty($goodsIds)){
				$goodsIds = $goodsIds2;
			}else{
				$goodsIds = array_intersect($goodsIds,$goodsIds2);
			}
		}
		return $goodsIds;
    }
	
	/**
	 * 获取分页商品记录
	 */
	public function pageQuery($goodsCatIds = []){
		//查询条件
		$isStock = input('isStock/d');
		$isNew = input('isNew/d');
		$keyword = input('keyword');
		$where = $where2 = [];
		$where[] = ['dataFlag','=',1];
		$where[] = ['isSale','=',1];
		if($keyword!='')$where2 = $this->getKeyWords($keyword);
		// 品牌筛选
		$brandIds = input('param.brand');
		if(!empty($brandIds)){
			$brandIds = explode(',',$brandIds);
			$where[] = ['brandId','in',$brandIds];
		}
		//排序条件
		$orderBy = input('orderBy/d',0);
		$orderBy = ($orderBy>=0 && $orderBy<=4)?$orderBy:0;
		$order = (input('order/d',1)==1)?1:0;
		$pageBy = ['saleNum','marketPrice','visitNum','saleTime'];
		$pageOrder = ['asc','desc'];
		if($isStock==1)$where[] = ['goodsStock','>',0];
		if($isNew==1)$where[] = ['isNew','=',1];
	
		$condition = '';
        if(!empty($goodsCatIds)){
            $str = implode('_',$goodsCatIds).'_%';
            $condition = "goodsCatIdPath like '$str'";
        }
	    $minPrice = input("param.minPrice");//开始价格
	    $maxPrice = input("param.maxPrice");//结束价格
		if($minPrice!='' && $maxPrice!=''){
	    	$where[] = ['marketPrice','between',[(int)$minPrice,(int)$maxPrice]];
	    }elseif($minPrice!=''){
	    	$where[] = ['marketPrice','>=',(int)$minPrice];
		}elseif($maxPrice!=''){
			$where[] = ['marketPrice','<=',(int)$maxPrice];
		}
		$list = Db::name("goods")
			->where($where)->where($where2)
            ->where($condition)
			->field('goodsId,goodsName,goodsSn,goodsStock,isNew,saleNum,marketPrice,goodsImg,visitNum,gallery')
			->order($pageBy[$orderBy]." ".$pageOrder[$order].",goodsId desc")
			->paginate(input('pagesize/d',16))->toArray();
			$favorites = model('favorites');
			$rs = $favorites->column('targetId');
			foreach ($list['data'] as $key => $value) {
				if(in_array($value['goodsId'], $rs)){
					$list['data'][$key]['is_fav'] = 1;
				}
			}
		return $list;
	}
	
	/**
	 * 关键字
	 */
	public function getKeyWords($name){
		$words = PYGAnalysis($name);
		if(!empty($words)){
			$str = [];
			if(count($words)==1){
				$str[] = ['goodsSerachKeywords','LIKE','%'.$words[0].'%'];
			}else{
				foreach ($words as $v){
					$str[] = ['goodsSerachKeywords','LIKE','%'.$v.'%'];
				}
			}
			return $str;
		}
		return "";
	}
	/**
	 * 获取价格范围
	 */
	public function getPriceGrade(){
	
        $rs = Db::name("goods")
			->field('min(marketPrice) minPrice,max(marketPrice) maxPrice')->select();
		if(isset($rs[0])){
			$rs = $rs[0];
		}else{
			return;
		}
		if($rs['maxPrice']=='')return;
		$minPrice = 0;
		$maxPrice = $rs['maxPrice'];
		$pavg5 = ($maxPrice/5);
		$prices = array();
    	$price_grade = 0.0001;
        for($i=-2; $i<= log10($maxPrice); $i++){
            $price_grade *= 10;
        }
    	//区间跨度
        $span = ceil(($maxPrice - $minPrice) / 8 / $price_grade) * $price_grade;
        if($span == 0){
            $span = $price_grade;
        }
		for($i=1;$i<=8;$i++){
			$prices[($i-1)*$span."_".($span * $i)] = ($i-1)*$span."-".($span * $i);
			if(($span * $i)>$maxPrice) break;
		}
		return $prices;
	}

}
