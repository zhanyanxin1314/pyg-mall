<?php

// +----------------------------------------------------------------------
// | 用户信息 例如用户等级
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\Adminbase;
use app\admin\model\UserRanks as UR;
use app\admin\model\Users as M;
use think\Db;

class User extends Adminbase
{

    /**
     * 用户信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    /**
     * 会员等级-展示页面
     */
    public function ranks()
    {
        return $this->fetch();
    }

    /**
     * 获取分页 - 会员信息
     */
    public function pageQuery()
    {
        $m = new M();
        return PYGGrid($m->pageQuery());
    }

    /**
     * 获取分页 - 会员等级信息
     */
    public function pageRanksQuery()
    {
        $ur = new UR();
        $rs =  $ur->pageQuery();
        return PYGGrid($rs);
    }



    /**
     * 获取分类列表
     */
    public function listQuery()
    {
        $m = new M();
        $rs = $m->listQuery(input('parentId/d',0));
        return PYGReturn("", 1,$rs);
    }

    /**
     * 获取品牌列表
     */
   public function listBrandQuery()
   {
        $b = new B();
        return ['status'=>1,'list'=>$b->listQuery(input('post.catId/d'))];
    }


    /**
     * 获取商品列表
     */
    public function saleByPage()
    {
        $g = new G();
        $rs = $g->saleByPage();
        $rs['status'] = 1;
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
                     $res['filepath'] = '/uploads/'.$dir.'/'.$info->getSaveName();
                 }else{
                     $res['code'] = 0;
                     $res['msg'] = '上传失败！'.$file->getError();
                 }
                 return $res;
             }
    }

   /**
     * 设置是否显示/隐藏
     */
    public function editiIsShow()
    {
        $m = new M();
        return $m->editiIsShow();
    }

    /**
     * 跳去新增/编辑页面 - 会员信息
     */
    public function toEdit(){
   
    }

    /**
     * 跳去新增/编辑页面 - 会员等级
     */
    public function toEditRanks()
    {
        $this->assign("p",(int)input("p"));
        $ur = new UR();
        $assign = ['data'=>$ur->getById((int)Input("id"))];
        return $this->fetch("ranks_edit",$assign);
    }


     /**
     * 新增 - 商品
     */
    public function toAddGoods()
    {
        $g = new G();
        return $g->add();
    }

   /**
     * 编辑 - 商品
     */
    public function toEditGoods()
    {
        $g = new G();
        return $g->edit();
    }

    /**
     * 跳去编辑页面 - 商品
     */
    public function editGoods()
    {
        $g = new G();
        $object = $g->getById(input('get.id'));
        $this->assign("p",(int)input("p"));
        $gallery = json_decode($object['gallery']);
        $object['gallery'] = $gallery;

        $data = ['object'=>$object];
        return $this->fetch('edit',$data);
    }


    /**
     * 删除 - 商品
     */
    public function delGoods()
    {
        $g = new G();
        return $g->del();
    }

    /**
     * 新增 - 分类
     */
    public function add()
    {
        $m = new M();
        return $m->add();
    }
    
    /**
     * 编辑  - 分类
     */
    public function edit()
    {
        $m = new M();
        return $m->edit();
    }

    /**
     * 删除 - 分类
     */
    public function del()
    {
        $m = new M();
        return $m->del();
    }

   /**
     * 新增 - 会员等级
     */
    public function addRanks()
    {
        $ur = new UR();
        return $ur->add();
    }
    
    /**
     * 编辑 - 会员等级
     */
    public function editRanks()
    {
        $ur = new UR();
        return $ur->edit();
    }

    /**
     * 删除 - 会员等级
    */
    public function delRanks()
    {
        $ur = new UR();
        $rs = $ur->del();
        return $rs;
    }

    /**
     *  跳去添加页面 - 商品
    */
    public function addGoods()
    {
        $g = new G();
        $this->assign("p",1);
        $object['goodsSn'] = PYGGoodsNo();
        $src=input("src")?input("src"):'add';
        $data = ['object'=>$object,'src'=>$src];
        return $this->fetch('edit',$data);
    }
    /**
     * 编辑分类名
     */
    public function editName()
    {
        $m = new M();
        return $m->editName();
    }

      /**
     * 编辑分类排序
     */
    public function editOrder()
    {
        $m = new M();
        return $m->editOrder();
    }

    /**
    * 编辑器上传文件
    */
    public function editorUpload()
    {
        return PYGEditUpload();
    }
}
