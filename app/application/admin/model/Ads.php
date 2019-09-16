<?php

namespace app\admin\model;
use app\admin\validate\Ads as validate;
use think\Db;
use think\Model;
/**
 * 广告业务处理
 */
class Ads extends Model{
	protected $pk = 'adId';
	/**
	 * 分页
	 */
	public function pageQuery(){

		$where = [];
		$where['a.dataFlag'] = 1;
		
		$apId = (int)input('adPositionId');
		
		if($apId!=0)$where['a.adPositionId'] = $apId;
		
		
		return Db::name('ads')->alias('a')
		            ->join('ad_positions ap',' a.adPositionId=ap.positionId AND ap.dataFlag=1','left')
					->field('adId,adName,adPositionId,adURL,adPositionId,adFile,ap.positionName,a.adSort')
		            ->where($where)->order('adId desc')
		            ->order('adSort','asc')
		            ->paginate(input('limit/d'));
	}
	
	//根据主键获取广告信息
	public function getById($id){
		return $this->get(['adId'=>$id,'dataFlag'=>1]);
	}

	//获取广告位信息
	public function getByPositionId($id){
		$where['adPositionId'] = $id;
		$where['dataFlag'] = 1;
		$rs = $this->where($where)
			->order('adSort', 'desc')
			->paginate(input('limit/d'))->toArray();
		return $rs;
	}

	/**
	 * 新增
	 */
	public function add(){
		$data = input('post.');
		$data['createTime'] = date('Y-m-d H:i:s');
		$data['adSort'] = (int)$data['adSort'];
		PYgUnset($data,'adId');
		Db::startTrans();
		try{
			$validate = new validate();
		    if(!$validate->scene('add')->check($data))return PYGReturn($validate->getError());
			$result = $this->allowField(true)->save($data);
        	if(false !== $result){
        		PYGClearAllCache();
				$id = $this->adId;
        		Db::commit();
        	    return PYGReturn("新增成功", 1);
        	}else{
        		return PYGReturn($this->getError(),-1); 
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
		$data = input('post.');
		$data['adSort'] = (int)$data['adSort'];
		PYGUnset($data,'createTime');
		Db::startTrans();
		try{
			$validate = new validate();
		    if(!$validate->scene('edit')->check($data))return WSTReturn($validate->getError());

		    $result = $this->allowField(true)->save($data,['adId'=>(int)$data['adId']]);
	        if(false !== $result){
	        	PYGClearAllCache();
	        	Db::commit();
	        	return PYGReturn("编辑成功", 1);
	        }else{
        		return PYGReturn($this->getError(),-1); 
        	}
		}catch (\Exception $e) {
            Db::rollback();
        }
        return PYGReturn('编辑失败',-1); 
	}

	/**
	 * 删除
	 */
    public function del(){
	    $id = (int)input('post.id/d');
	    Db::startTrans();
		try{
		    $result = $this->setField(['adId'=>$id,'dataFlag'=>-1]);
		    
	        if(false !== $result){
	        	PYGClearAllCache();
	        	Db::commit();
	        	return PYGReturn("删除成功", 1);
	        }
		}catch (\Exception $e) {
            Db::rollback();
            return PYGReturn('删除失败',-1);
        }
	}
	
	/**
	* 修改广告排序
	*/
	public function changeSort(){
		$id = (int)input('id');
		$adSort = (int)input('adSort');
		$result = $this->setField(['adId'=>$id,'adSort'=>$adSort]);
		if(false !== $result){
			PYGClearAllCache();
        	return PYGReturn("操作成功", 1);
        }else{
        	return PYGReturn($this->getError(),-1);
        }
	}
	
}
