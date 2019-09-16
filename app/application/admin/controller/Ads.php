<?php

// +----------------------------------------------------------------------
// | 广告信息
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\Adminbase;
use app\admin\model\Ads as A;
use think\Db;

class Ads extends Adminbase
{

    /**
     * 广告信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    public function index2()
    {
        $a = new A();
        $this->assign("p",(int)input("p"));
        $adPositionId = (int)input("id");
        $data = $a->getByPositionId($adPositionId);
        $this->assign("data",$data);
        $this->assign("adPositionId",$adPositionId);
        return $this->fetch("index2");
    }

    /**
     * 获取分页 - 广告信息
     */
    public function pageQuery()
    {
        $a = new A();
        $rs =  $a->pageQuery();
        return PYGGrid($rs);
    }


    /**
    * 修改广告排序
    */
    public function changeSort()
    {
        $a = new A();
        return $a->changeSort();
    }
    /**
     * 获取分页 - 商品品牌
     */
    public function pageBrandQuery()
    {
        $b = new B();
        $rs =  $b->pageQuery();
        return PYGGrid($rs);
    }

    //通用缩略图上传接口
    public function upload()
    {
       if($this->request->isPost()){
                 $dir = Input('param.dir');
                 $res['code']=1;
                 $res['msg'] = '上传成功！';
                 $file = $this->request->file('file');
                 $info = $file->move('../public/uploads/'.$dir);
                 //halt( $info);
                 if($info){
                     $res['name'] = $info->getFilename();
                     $res['filepath'] = '/uploads/goods/'.$info->getSaveName();
                 }else{
                     $res['code'] = 0;
                     $res['msg'] = '上传失败！'.$file->getError();
                 }
                 return $res;
             }
    }

    /**
     * 跳去编辑页面
     */
    public function toEdit()
    {
        $a = new A();
        $data = $a->getById(Input("id/d",0));
        $this->assign("p",(int)input("p"));
        return $this->fetch("edit",['data'=>$data]);
    }

     /**
     * 跳去编辑页面
     */
    public function toEdit2()
    {

        $a = new A();
        $data = $a->getById(Input("id/d",0));
        $adPositionId = (int)input("adPositionId");
        $position = $a->getByPositionId($adPositionId);
        
        $this->assign("p",(int)input("p"));
        return $this->fetch("edit2",['data'=>$data,'position'=>$position,'adpid'=>$adPositionId]);
    }

    /**
     * 新增
     */
    public function add()
    {
        $a = new A();
        return $a->add();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $a = new A();
        return $a->edit();
    }

    /**
     * 删除
     */
    public function del()
    {
        $a = new A();
        return $a->del();
    }
}
