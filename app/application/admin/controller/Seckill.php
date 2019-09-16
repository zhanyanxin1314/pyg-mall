<?php

// +----------------------------------------------------------------------
// | 运营-商品秒杀
// +----------------------------------------------------------------------

namespace app\admin\controller;


use app\admin\model\GoodsSeckill as GS;
use app\common\controller\Adminbase;
use think\Db;

class Seckill extends Adminbase
{

    /**
     * 秒杀商品信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }


    
    /**
     * 获取商品列表
     */
    public function saleByPage()
    {
        $g = new GS();
        $rs = $g->saleByPage();
        //$rs['status'] = 1;
        return PYGGrid($rs);
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

    /**
     * 秒杀页面 - 查看倒计时
    */
    public function showTime()
    {
        $g = new GS();

        $object = $g->getById(input('post.id'));

        return $object;
    }


    /**
     * 跳去编辑页面 - 商品
     */
    public function editGoods()
    {
        $g = new GS();
        $object = $g->getById(input('get.id'));
        $this->assign("p",(int)input("p"));
        $data = ['object'=>$object];
        return $this->fetch('edit',$data);
    }

     /**
     * 编辑 - 秒杀商品
     */
    public function toEditGoods()
    {
        $g = new GS();
        return $g->edit();
    }


    /**
     * 删除 - 商品
     */
    public function delGoods()
    {
        $g = new GS();
        return $g->del();
    }

    
}
