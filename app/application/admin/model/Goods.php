<?php

// +----------------------------------------------------------------------
// | 商品模型
// +----------------------------------------------------------------------

namespace app\admin\model;
use app\admin\validate\Goods as Validate;
use think\Db;
use \think\Model;

/**
 * 商品类
 */
class Goods extends Model{

	protected $pk = 'goodsId';
     /**
      *  商品列表
      */
	public function saleByPage(){
		$where = [];
		$where[] = ['dataFlag',"=",1];
		$goodsName = input('goodsName');
		if($goodsName != ''){
			$where[] = ['goodsName','like',"%$goodsName%"];
		}
		$rs = $this->where($where)
			->field('goodsId,goodsName,goodsImg,goodsSn,isSale,isBest,isHot,isNew,isSale,isRecom,goodsStock,saleNum,marketPrice')
			->order('saleTime', 'desc')
			->paginate(input('limit/d'))->toArray();
		return $rs;
	}

	/**
	 * 新增商品
	 */
	public function add($sId=0){
		$data = input('post.');
		PYGUnset($data,'goodsId,dataFlag');
		if($data['isSale']==1 && $data['goodsImg']==''){
			return PYGReturn("上架商品必须有商品图片");
		}
		$data['saleTime'] = date('Y-m-d H:i:s');
		$data['createTime'] = date('Y-m-d H:i:s');	
		$goodmodel = model('GoodsCats');

		$goodsCats = $goodmodel->getParentIs($data['goodsCatId']);

		$data['goodsCatIdPath'] = implode('_',$goodsCats)."_";
        $data['gallery'] = json_encode($data['gallery']);
		Db::startTrans();
        try{
			$data['goodsDesc'] = $data['goodsDesc'];
        	//保存插件数据钩子
        	if($shop['dataFlag'] ==-1 || $shop['shopStatus'] != 1)$data['isSale'] = 0;
        	$validate = new Validate;
        	if (!$validate->scene(true)->check($data)) {
        		return PYGReturn($validate->getError());
        	}else{
        		$result = $this->allowField(true)->save($data);
        	}
			if(false !== $result){
				$goodsId = $this->goodsId;
	
    	        Db::commit();
				return PYGReturn("新增成功", 1,['id'=>$goodsId]);
			}else{
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
	    $goodsId = input('post.goodsId/d');
	   
		$data = input('post.');
		PYGUnset($data,'goodsId,dataFlag,createTime');
		$ogoods = $this->where(['goodsId'=>$goodsId,'dataFlag'=>1])->field('goodsCatId,goodsCatIdPath,goodsImg')->find();
		if(empty($ogoods))return PYGReturn('商品不存在');

		if($ogoods['goodsImg']=='' && $data['isSale']==1 && $data['goodsImg']==''){
			return WSTReturn("上架商品必须有商品图片");
		}
		//不允许修改商品类型
		$data['saleTime'] = date('Y-m-d H:i:s');

		if(empty($data['goodsCatId'])){
		    
		    $data['goodsCatId'] = $ogoods['goodsCatId'];
		    $data['goodsCatIdPath'] = $ogoods['goodsCatIdPath'];

		} else {
			$goodmodel = model('GoodsCats');
			$goodsCats = $goodmodel->getParentIs($data['goodsCatId']);
			$data['goodsCatIdPath'] = implode('_',$goodsCats)."_";
		}
        $data['gallery'] = json_encode($data['gallery']);
		Db::startTrans();
        try{
	        $desc = $this->where('goodsId',$goodsId)->value('goodsDesc');
			$validate = new Validate;
			if (!$validate->scene(true)->check($data)) {
				return PYGReturn($validate->getError());
			}else{
				$result = $this->allowField(true)->save($data,['goodsId'=>$goodsId]);
			}
			if(false !== $result){

				Db::commit();
				return PYGReturn("编辑成功", 1,['id'=>$goodsId]);
			}else{
				return PYGReturn($this->getError(),-1);
			}
	    }catch (\Exception $e) {
        	Db::rollback();
            return PYGReturn('编辑失败',-1);
        }
	}
	
	/**
	 * 检测商品主表的货号或者商品编号
	 */
	public function checkExistGoodsKey($key,$val,$id = 0){
		if(!in_array($key,array('goodsSn')))return PYGReturn("非法的查询字段");
		$conditon[] = [$key,'=',$val];
		if($id>0)$conditon[] = ['goodsId','<>',$id];
		$rs = $dbo = $this->where($conditon)->count();
		return ($rs==0)?false:true;
	}

	
	/**
	 * 删除商品
	 */
	public function del(){
	    $id = input('post.id/d');
		$data = [];
		$data['dataFlag'] = -1;
		Db::startTrans();
		try{
		    $result = $this->update($data,['goodsId'=>$id]);
	        if(false !== $result){
				Db::commit();
				PYGClearAllCache();
	        	//标记删除购物车
	        	return PYGReturn("删除成功", 1);
	        }
		}catch (\Exception $e) {
            Db::rollback();
        }
        return PYGReturn('删除失败',-1);
	}

	/**
	 * 获取商品资料方便编辑
	 */
	public function getById($goodsId,$sId=0){
		
     
		$rs = $this->where(['goodsId'=>$goodsId])->find();
		if(!empty($rs)){
			
			$rs['goodsDesc'] = htmlspecialchars_decode($rs['goodsDesc']);
          
         
		}
		return $rs;
	}

	/**
	  * 批量删除商品
	  */
	 public function batchDel(){
	 	$shopId = (int)session('WST_USER.shopId');
	   	$ids = input('post.ids/a');
	   	Db::startTrans();
		try{
		   	$rs = $this->where([['goodsId','in',$ids],['shopId','=',$shopId]])->setField('dataFlag',-1);
			if(false !== $rs){
				//标记删除购物车
				foreach ($ids as $v){
					WSTUnuseImage('goods','goodsImg',(int)$v);
	        	    WSTUnuseImage('goods','gallery',(int)$v);
	        	    // 商品描述图片
		        	$desc = $this->where('goodsId',(int)$v)->value('goodsDesc');
					WSTEditorImageRocord(0, (int)$v, $desc,'');
					model('common/carts')->delCartByUpdate((int)$v);
					hook('afterChangeGoodsStatus',['goodsId'=>(int)$v]);
				}
				Db::commit();
				WSTClearAllCache();
	        	return WSTReturn("删除成功", 1);
	        }
		}catch (\Exception $e) {
            Db::rollback();
        }
        return WSTReturn('删除失败',-1);
	 }

	
	/**
	* 修改商品状态
	*/
	public function changSaleStatus(){
		$shopId = (int)session('WST_USER.shopId');
		$allowArr = ['isHot','isNew','isBest','isRecom'];
		$is = input('post.is');
		if(!in_array($is,$allowArr))return WSTReturn('非法操作',-1);
		$status = (input('post.status',1)==1)?0:1;
		$id = (int)input('post.id');
		$rs = $this->where(["shopId"=>$shopId,'goodsId'=>$id])->setField($is,$status);
		if($rs!==false){
			return WSTReturn('设置成功',1);
		}else{
			return WSTReturn($this->getError(),-1);
		}
	}
	/**
	 * 批量修改商品状态
	 */
	public function changeGoodsStatus(){
		$shopId = (int)session('WST_USER.shopId');
		//设置为什么 hot new best rec
		$allowArr = ['isHot','isNew','isBest','isRecom'];
		$is = input('post.is');
		if(!in_array($is,$allowArr))return WSTReturn('非法操作',-1);
		//设置哪一个状态
		$status = input('post.status',1);
		$ids = input('post.ids/a');
		$rs = $this->where([['goodsId','in',$ids],['shopId','=',$shopId]])->setField($is, $status);
		if($rs!==false){
			return WSTReturn('设置成功',1);
		}else{
			return WSTReturn($this->getError(),-1);
		}

	}
	/**
	 * 获取商品规格属性
	 */
	public function getSpecAttrs(){
		$goodsType = (int)input('goodsType');
		$goodsCatId = Input('post.goodsCatId/d');
		$goodsCatIds = model('GoodsCats')->getParentIs($goodsCatId);
		$data = [];
		if($goodsType==0){
			$specs = Db::name('spec_cats')->where([['goodsCatId','in',$goodsCatIds],['isShow','=',1],['dataFlag','=',1]])->field('catId,catName,isAllowImg')->order('isAllowImg desc,catSort asc,catId asc')->select();
			$spec0 = null;
			$spec1 = [];
			foreach ($specs as $key => $v){
				if($v['isAllowImg']==1){
					$spec0 = $v;
				}else{
					$spec1[] = $v;
				}
			}
			$data['spec0'] = $spec0;
			$data['spec1'] = $spec1;
		}
		$data['attrs'] = Db::name('attributes')->where([['goodsCatId','in',$goodsCatIds],['isShow','=',1],['dataFlag','=',1]])->field('attrId,attrName,attrType,attrVal')->order('attrSort asc,attrId asc')->select();
	    return WSTReturn("", 1,$data);
	}
	/**
	 * 修改商品库存/价格
	 */
	public function editGoodsBase(){
		$goodsId = (int)Input("goodsId");
		$post = input('post.');
		$data = [];
		if(isset($post['goodsStock'])){
			$data['goodsStock'] = (int)input('post.goodsStock',0);
			if($data['goodsStock']<0)return WSTReturn('操作失败，库存不能为负数');
		}elseif(isset($post['shopPrice'])){
			$data['shopPrice'] = (float)input('post.shopPrice',0);
			if($data['shopPrice']<0.01)return WSTReturn('操作失败，价格必须大于0.01');
		}else{
			return WSTReturn('操作失败',-1);
		}
		$rs = $this->update($data,['goodsId'=>$goodsId,'shopId'=>(int)session('WST_USER.shopId')]);
		if($rs!==false){
			return WSTReturn('操作成功',1);
		}else{
			return WSTReturn('操作失败',-1);
		}
	}
	/**
	 *  预警库存列表
	 */
	public function stockByPage(){
		$where = [];
		$c1Id = (int)input('cat1');
		$c2Id = (int)input('cat2');
		$shopId = (int)session('WST_USER.shopId');
		if($c1Id!=0)$where[] = " shopCatId1=".$c1Id;
		if($c2Id!=0)$where[] = " shopCatId2=".$c2Id;
		$where[] = " g.shopId = ".$shopId;
		$prefix = config('database.prefix');
		$sql1 = 'SELECT g.goodsId,g.goodsName,g.goodsType,g.goodsImg,gs.specStock goodsStock ,gs.warnStock warnStock,g.isSpec,gs.productNo,gs.id,gs.specIds,g.isSale
                    FROM '.$prefix.'goods g inner JOIN '.$prefix.'goods_specs gs ON gs.goodsId=g.goodsId and gs.specStock <= gs.warnStock and gs.warnStock>0
                    WHERE g.dataFlag = 1 and '.implode(' and ',$where);

		$sql2 = 'SELECT g.goodsId,g.goodsName,g.goodsType,g.goodsImg,g.goodsStock,g.warnStock,g.isSpec,g.productNo,0 as id,"" as specIds,g.isSale
                    FROM '.$prefix.'goods g 
                    WHERE g.dataFlag = 1  and isSpec=0 and g.goodsStock<=g.warnStock 
                    and g.warnStock>0 and '.implode(' and ',$where);
		$page = (int)input('post.'.config('paginate.var_page'));
		$page = ($page<=0)?1:$page;
		$pageSize = 20;
		$start = ($page-1)*$pageSize;
		$sql = $sql1." union ".$sql2;
		$sqlNum = 'select count(*) wstNum from ('.$sql.") as c";
		$sql = 'select * from ('.$sql.') as c order by isSale desc limit '.$start.','.$pageSize;
		$rsNum = Db::query($sqlNum);
		$rsdata = Db::query($sql);
		$rs = WSTPager((int)$rsNum[0]['wstNum'],$rsdata,$page,$pageSize);
		if(empty($rs['data']))return $rs;
		$specIds = [];
		foreach ($rs['data'] as $key =>$v){
			$specIds[$key] = explode(':',$v['specIds']);
			$rss = Db::name('spec_items')->alias('si')
			->join('__SPEC_CATS__ sc','sc.catId=si.catId','left')
			->where('si.shopId = '.$shopId.' and si.goodsId = '.$v['goodsId'])
			->where([['si.itemId','in',$specIds[$key]]])
			->field('si.itemId,si.itemName,sc.catId,sc.catName')
			->select();
			$rs['data'][$key]['spec'] = $rss;
		}
		return $rs;
	}
	/**
	 *  预警修改预警库存
	 */
	public function editwarnStock(){
		$id = input('post.id/d');
		$type = input('post.type/d');
		$number = (int)input('post.number');
		$shopId = (int)session('WST_USER.shopId');
		$data = $data2 = [];
		$data['shopId'] =  $data2['shopId'] = $shopId;
		$datat=array('1'=>'specStock','2'=>'warnStock','3'=>'goodsStock','4'=>'warnStock');
		if(!empty($type)){
			$data[$datat[$type]] = $number;
			if($type==1 || $type==2){
				$data['goodsId'] = $goodsId = input('post.goodsId/d');
				$rss = Db::name("goods_specs")->where('id', $id)->update($data);
				//更新商品库存
				$goodsStock = 0;
				if($rss!==false){
					$specStocks = Db::name("goods_specs")->where(['shopId'=>$shopId,'goodsId'=>$goodsId,'dataFlag'=>1])->field('specStock')->select();
					foreach ($specStocks as $key =>$v){
						$goodsStock = $goodsStock+$v['specStock'];
					}
					$data2['goodsStock'] = $goodsStock;
					$rs = $this->update($data2,['goodsId'=>$goodsId]);
				}else{
					return WSTReturn('操作失败',-1);
				}
			}
			if($type==3 || $type==4){
				$rs = $this->update($data,['goodsId'=>$id]);
			}
			if($rs!==false){
				return WSTReturn('操作成功',1);
			}else{
				return WSTReturn('操作失败',-1);
			}
		}
		return WSTReturn('操作失败',-1);
	}
}
