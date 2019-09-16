<?php

// +----------------------------------------------------------------------
// | 统计信息
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\Adminbase;
use think\Db;

class Record extends Adminbase
{

    /**
     * 商品统计
     */
    public function product()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }
}
