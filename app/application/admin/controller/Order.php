<?php

// +----------------------------------------------------------------------
// | 订单信息
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\Adminbase;
use app\admin\model\Orders as M;
use think\Db;

class Order extends Adminbase
{

    /**
     * 订单信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    /**
     * 获取分页
     */
    public function pageQuery()
    {
        $m = new M();
        return PYGGrid($m->pageQuery((int)input('orderStatus',10000)));
    }

    /**
    * 获取订单详情
    */
    public function view()
    {
        $m = new M();
        $rs = $m->getByView(Input("id/d",0));
        $this->assign("object",$rs);
        $this->assign("from",input("from/d",0));
        $this->assign("p",(int)input("p"));
        $this->assign("src",input("src"));
        return $this->fetch("view");
    } 

    /**
     * 订单-发货
     */
    public function Shipments()
    {
        $id = (int)input("id");
        $this->assign("orderId",$id);
        return $this->fetch();
    }

    /**
     * 订单-确认发货
     */
    public function editExpress()
    {
        $m = new M();
        return $m->editExpress1();
    }
}
