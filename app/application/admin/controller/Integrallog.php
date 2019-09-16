<?php
namespace app\admin\controller;
use app\common\controller\Adminbase;
use think\Db;
use app\admin\model\UserBill as M;
/**
 * 
 * 积分日志控制器
 */
class Integrallog extends Adminbase{
	
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    /**
     * 获取分页 - 积分日志
     */
    public function pageQuery()
    {
        $m = new M();
        $rs =  $m->pageQuery();
        return PYGGrid($rs);
    }

}