<?php

// +----------------------------------------------------------------------
// | 举报管理
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\Adminbase;
use app\admin\model\Inform as I;
use think\Db;

class Inform extends Adminbase
{

    /**
     * 广告信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    /**
     * 获取分页 - 举报信息
     */
    public function pageQuery()
    {
        $m = new I();
        $rs =  $m->pageQuery();
        return PYGGrid($rs);
    }

    /**
     * 跳去处理页面
     */
    public function toHandle()
    {
        $m = model('inform');
        if(Input('cid')>0){
            $data = $m->getDetail();
            $this->assign('data',$data);
        }
        $this->assign("p",(int)input("p"));
        return $this->fetch("handle");
    }

    /**
     * 举报记录
     */
    public function finalHandle()
    {
        
        return model('Inform')->finalHandle();
    }
}
