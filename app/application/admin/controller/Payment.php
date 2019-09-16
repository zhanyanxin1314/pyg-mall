<?php

// +----------------------------------------------------------------------
// | 支付信息
// +----------------------------------------------------------------------

namespace app\admin\controller;
use app\common\controller\Adminbase;
use app\admin\model\Payment as P;
use think\Db;

class Payment extends Adminbase
{

    /**
     * 支付信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    /**
     * 获取分页 - 支付信息
     */
    public function pageQuery()
    {
        $p = new P();
        $rs =  $p->pageQuery();
        return PYGGrid($rs);
    }

    /**
     * 跳去编辑页面
     */
    public function toEdit()
    {
        $p = new P();
        $rs = $p->getById((int)Input("get.id"));
        $payConfig = json_decode($rs['payConfig']);
        //判断是否为空
        if(!empty($payConfig)){
            foreach($payConfig as $k=>$v)
                $rs[$k]=$v;
        }
        $this->assign("object",$rs);
        return $this->fetch("pay_".input('get.payCode'));
    }


    /**
     * 编辑
     */
    public function edit()
    {
        $p = new P();
        return $p->edit();
    }

    /**
     * 删除
     */
    public function del()
    {
        $p = new P();
        return $p->del();
    }
}
