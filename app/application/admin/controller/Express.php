<?php

// +----------------------------------------------------------------------
// | 快递信息
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\Adminbase;
use app\admin\model\Express as E;
use think\Db;

class Express extends Adminbase
{

    /**
     * 快递信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    /*
    * 获取数据-快递
    */
    public function get()
    {
        $e = new E();
        $rs = $e->getById(Input("id/d",0));
        return $rs;
    }

    /**
     * 获取分页 - 快递信息
     */
    public function pageQuery()
    {
        $e = new E();
        $rs =  $e->pageQuery();
        return PYGGrid($rs);
    }

    /**
     * 新增-快递
     */
    public function add()
    {
        $e = new E();
        return $e->add();
    }

    /**
     * 编辑-快递
     */
    public function edit()
    {
        $e = new E();
        return $e->edit();
    }

    /**
     * 删除-快递
     */
    public function del()
    {
        $e = new E();
        return $e->del();
    }
}
