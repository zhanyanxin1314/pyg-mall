<?php
namespace app\admin\model;
use app\admin\validate\Ranks as validate;
use think\Db;
use think\Model;
/**
 * 会员等级业务处理
 */
class UserRanks extends Model{
	protected $pk = 'rankId';
	/**
	 * 分页
	 */
	public function pageQuery(){
		return $this->where('dataFlag',1)->field(true)->order('rankId desc')->paginate(input('limit/d'));
	}
	public function getById($id){
		return $this->get(['rankId'=>$id,'dataFlag'=>1]);
	}

	/**
	 * 新增
	 */
	public function add(){
		$data = input('post.');
		$data['createTime'] = date('Y-m-d H:i:s');
		$data['startScore'] = (int) $data['startScore'];
		$data['endScore'] = (int) $data['endScore'];
		PYGUnset($data,'rankId');
		Db::startTrans();
		try{
			$validate = new validate();
		    if(!$validate->scene('add')->check($data))return WSTReturn($validate->getError());
			$result = $this->allowField(true)->save($data);
			$id = $this->rankId;
	        if(false !== $result){
	        	cache('PYG_USER_RANK',null);
	        	Db::commit();
	        	return PYGReturn("新增成功", 1);
	        }
		}catch (\Exception $e) {
            Db::rollback();
            return PYGReturn('新增失败',-1);
        }
	}

    /**
	 * 编辑
	 */
	public function edit(){
		$Id = (int)input('post.rankId');
		$data = input('post.');
		$data['startScore'] = (int) $data['startScore'];
		$data['endScore'] = (int) $data['endScore'];
		Db::startTrans();
		try{
			PYGUnset($data,'createTime');
			$validate = new validate();
		    if(!$validate->scene('edit')->check($data))return WSTReturn($validate->getError());
		    $result = $this->allowField(true)->save($data,['rankId'=>$Id]);
	        if(false !== $result){
	        	cache('PYG_USER_RANK',null);
	        	Db::commit();
	        	return PYGReturn("编辑成功", 1);
	        }
		}catch (\Exception $e) {
            Db::rollback();
            return PYGReturn('编辑失败',-1);
        }	        
	}

	/**
	 * 删除
	 */
    public function del(){
	    $id = (int)input('post.id/d');
	    Db::startTrans();
		try{
			$data = [];
			$data['dataFlag'] = -1;
		    $result = $this->update($data,['rankId'=>$id]);
	        if(false !== $result){
	    
	        	cache('PYG_USER_RANK',null);
	        	Db::commit();
	        	return PYGReturn("删除成功", 1);
	        }
		}catch (\Exception $e) {
            Db::rollback();
            return PYGReturn('编辑失败',-1);
        }	
	}
	
}
