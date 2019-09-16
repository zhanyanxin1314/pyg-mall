<?php

// +----------------------------------------------------------------------
// | 商品信息 例如 商品分类 商品品牌等
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\GoodsCats as M;
use app\admin\model\Brands as B;
use app\admin\model\Goods as G;
use app\admin\model\GoodsSeckill as GS;
use app\common\controller\Adminbase;
use think\Db;

class Goods extends Adminbase
{

    /**
     * 商品信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    /**
     * 商品分类-展示页面
     */
    public function cats()
    {
        return $this->fetch();
    }

    /**
     * 商品品牌-展示页面
     */
    public function brand()
    {
        $g = model('GoodsCats');
        $this->assign("p",(int)input("p"));
        $this->assign('gcatList',$g->listQuery(0));
        return $this->fetch();
    }

    /**
     * 获取分页 - 商品分类
     */
    public function pageQuery()
    {
        $m = new M();
        return $m->pageQuery();
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
     * 跳去新增/编辑页面 - 商品分类
     */
    public function toEdit()
    {
        $id = Input("get.id/d",0);
        $pid = Input("get.pid/d",0);
        $m = new M();
        if($id>0){
            $object = $m->get($id);
        } else {
            if($pid > 0){
                $parentObject = $m->get($pid);
                $object['parentId'] = $pid;
            }else{
                $object['parentId'] = $pid;
            }
        }
        $this->assign('object',$object);
        return $this->fetch("cats_edit");
    }

    /**
     * 跳去新增/编辑页面 - 商品品牌
     */
    public function toEditBrand()
    {
        $id = Input("get.id/d",0);
        $b = new B();
        if($id>0){
            $object = $b->getById($id);
        }
        $this->assign("p",(int)input("p"));
        $this->assign('object',$object);
        $this->assign('gcatList',model('GoodsCats')->listQuery(0));
        return $this->fetch("brand_edit");
    }


    /**
     * 新增 - 秒杀商品
     */
    public function toAddSeckillGoods()
    {
        $g = new GS();
        return $g->add();
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
     * 新增 - 品牌
     */
    public function addBrand()
    {
        $b = new B();
        return $b->add();
    }
    
    /**
     * 编辑 - 品牌
     */
    public function editBrand()
    {
        $b = new B();
        return $b->edit();
    }

    /**
     * 删除 - 品牌
    */
    public function delBrand()
    {
        $b = new B();
        $rs = $b->del();
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

    /**
     * 秒杀页面 - 商品
    */
    public function seckillGoods()
    {
        $g = new G();
        $object = $g->getById(input('get.id'));
        $this->assign("p",(int)input("p"));
        $gallery = json_decode($object['gallery']);
        $object['gallery'] = $gallery;
        $data = ['object'=>$object];
        return $this->fetch('',$data);
    }
}
