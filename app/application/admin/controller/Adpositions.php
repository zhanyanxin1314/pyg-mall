<?php

// +----------------------------------------------------------------------
// | 广告位置信息
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\Adminbase;
use app\admin\model\AdPositions as AP;
use think\Db;

class Adpositions extends Adminbase
{

    /**
     * 广告位置信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }


    /**
     * 获取分页 - 广告位置信息
     */
    public function pageQuery(){
        $ap = new AP();
        $rs =  $ap->pageQuery();
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
     * 跳去编辑页面
     */
    public function toEdit(){
        $ap = new AP();

        $this->assign("p",(int)input("p"));
        $assign = ['data'=>$ap->getById(Input("get.id/d",0))];
        return $this->fetch("edit",$assign);
    }

    /**
     * 新增
     */
    public function add(){
        $ap = new AP();
        return $ap->add();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $ap = new AP();
        return $ap->edit();
    }

    /**
     * 删除
     */
    public function del()
    {
        $ap = new AP();
        return $ap->del();
    }
}
