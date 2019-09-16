<?php
namespace app\admin\controller;
use app\common\controller\Adminbase;
use think\Db;
use app\admin\model\IntegralConfig as M;
/**
 * 
 * 积分配置控制器
 */
class Integralconfig extends Adminbase{
	
    public function index()
    {
        
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }
    /*
    * 获取数据
    */
    public function get()
    {
        $m = new M();
        $rs = $m->getById(Input("id/d",0));
        return $rs;
    }

    /**
     * 获取分页 - 银行信息
     */
    public function pageQuery()
    {
        $m = new M();
        $rs =  $m->pageQuery();
        return PYGGrid($rs);
    }

    /**
     * 新增
     */
    public function add()
    {
        $m = new M();
        return $m->add();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $m = new M();
        return $m->edit();
    }

}