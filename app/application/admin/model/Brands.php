<?php

// +----------------------------------------------------------------------
// | 品牌模型
// +----------------------------------------------------------------------

namespace app\admin\model;
use app\admin\validate\Brands as validate;
use \think\Model;
use think\Db;
/**
 * 品牌业务处理
 */
class Brands extends Model{
	protected $pk = 'brandId';
	/**
	 * 分页
	 */
	public function pageQuery(){
		$key = input('key');
		$id = input('id/d');
		$where[] = ['b.dataFlag','=',1];
		if($key!='')$where[] = ['b.brandName','like','%'.$key.'%'];
		if($id>0)$where[] = ['gcb.catId','=',$id];
		$total = Db::name('brands')->alias('b');
		if($id>0){ 
		    $total->join('cat_brands gcb','b.brandId = gcb.brandId','left');
		}
		$page = $total->where($where)
		->field('b.brandId,b.brandName,b.brandImg,b.brandDesc')
		->order('b.brandId', 'desc')
		->paginate(input('post.limit/d'))->toArray();
		if(count($page['data'])>0){
			foreach ($page['data'] as $key => $v){
				$page['data'][$key]['brandDesc'] = strip_tags(htmlspecialchars_decode($v['brandDesc']));
			}
		}
		return $page;
	}	


	/**
	 * 获取品牌列表
	 */
	public function listQuery($catId){
		$rs = Db::name('cat_brands')->alias('l')
									->join('__BRANDS__ b','b.brandId=l.brandId and b.dataFlag=1 and l.catId='.$catId)
		          					->field('b.brandId,b.brandName,b.brandImg')
		          					->group('b.brandId')
		          					->select();
		return $rs;
	}

	
	/**
	 * 获取指定对象
	 */
	public function getById($id){
		$result = $this->where(['brandId'=>$id])->find();
		//获取关联的分类
		$result['catIds'] = Db::name('cat_brands')->where(['brandId'=>$id])->column('catId');
		return $result;
	}
	
	/**
	 * 新增
	 */
	public function add(){
		$data = input('post.');
		PYGUnset($data,'brandId,dataFlag');
		$data['createTime'] = date('Y-m-d H:i:s');
		$idsStr = explode(',',$data['catId']);
		if($idsStr!=''){
			foreach ($idsStr as $v){
				if((int)$v>0)$ids[] = (int)$v;
			}
		}
		Db::startTrans();
        try{
        	$validate = new validate();
		    if(!$validate->scene('add')->check($data))return WSTReturn($validate->getError());
			$result = $this->allowField(true)->save($data);
			if(false !== $result){
				PYGClearAllCache();
				foreach ($ids as $key =>$v){
					$d = array();
					$d['catId'] = $v;
					$d['brandId'] = $this->brandId;
					Db::name('cat_brands')->insert($d);
				}
				Db::commit();
				return PYGReturn("新增成功", 1);
			}
        }catch (\Exception $e) {
            Db::rollback();
        }
        return PYGReturn('新增失败',-1);
	}
	
	/**
	 * 编辑
	 */
	public function edit(){
		$brandId = input('post.id/d');
		$data = input('post.');
		$idsStr = explode(',',$data['catId']);
		if($idsStr!=''){
			foreach ($idsStr as $v){
				if((int)$v>0)$ids[] = (int)$v;
			}
		}
		$filter = array();
		//获取品牌的关联分类
		$catBrands = Db::name('cat_brands')->where(['brandId'=>$brandId])->select();
		foreach ($catBrands as $key =>$v){
			if(!in_array($v['catId'],$ids))$filter[] = $v['catId'];
		}
		Db::startTrans();
        try{
			$desc = $this->where('brandId',$brandId)->value('brandDesc');
			$validate = new validate();
		    if(!$validate->scene('edit')->check($data))return WSTReturn($validate->getError());
			$result = $this->allowField(['brandName','brandImg','brandDesc','sortNo'])->save($data,['brandId'=>$brandId]);
			if(false !== $result){
				PYGClearAllCache();
				foreach ($catBrands as $key =>$v){
					Db::name('cat_brands')->where('brandId',$brandId)->delete();
				}
				foreach ($ids as $key =>$v){
					$d = array();
					$d['catId'] = $v;
					$d['brandId'] = $brandId;
					Db::name('cat_brands')->insert($d);
				}
				Db::commit();
				return PYGReturn("修改成功", 1);
			}
        }catch (\Exception $e) {
            Db::rollback();
        }
        return PYGReturn('修改失败',-1);
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$id = input('post.id/d');
		$data = [];
		$data['dataFlag'] = -1;
		Db::startTrans();
        try{
			$result = $this->where(['brandId'=>$id])->update($data);
			$desc = $this->where('brandId',$id)->value('brandDesc');
			if(false !== $result){
				PYGClearAllCache();
				Db::name('cat_brands')->where(['brandId'=>$id])->delete();
				Db::commit();
				return PYGReturn("删除成功", 1);
			}
        }catch (\Exception $e) {
            Db::rollback();
        }
        return PYGReturn('删除失败',-1);
	}
	
	/**
	 * 获取品牌
	 */
	public function searchBrands(){
		$goodsCatatId = (int)input('post.goodsCatId');
		if($goodsCatatId<=0)return [];
		$key = input('post.key');
		$where[] = ['dataFlag','=',1];
		$where[] = ['catId','=',$goodsCatatId];
		if($key!='')$where[] = ['brandName','like','%'.$key.'%'];
		return $this->alias('s')->join('__CAT_BRANDS__ cb','s.brandId=cb.brandId','inner')
		            ->where($where)->field('brandName,s.brandId')->select();
	}
	/**
	 * 排序字母
	 */
	public function letterObtain(){
		$areaName =  input('code');
		if($areaName =='')return WSTReturn("", 1);
		$areaName = WSTGetFirstCharter($areaName);
		if($areaName){
			return WSTReturn($areaName, 1);
		}else{
			return WSTReturn("", 1);
		}
	}

}