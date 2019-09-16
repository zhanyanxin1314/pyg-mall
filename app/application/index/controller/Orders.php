<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\Orders as M;

class Orders extends Base
{

    /**
     * 订单提交成功
     */
    public function succeed(){
        $this->checkAuth();
        $m = new M();
        $rs = $m->getByUnique();
        $this->assign('object',$rs);

        if(!empty($rs['list'])){
            if($rs['payType']==1 && $rs['totalMoney']>0){
                $this->assign('orderNo',input("get.orderNo"));
                $this->assign('isBatch',(int)input("get.isBatch/d",1));
                $this->assign('rs',$rs);
                return $this->fetch('order_pay_step1');
            }else{
                return $this->fetch('order_success');
            }
        }else{
            $this->assign('message','Sorry~您要找的页面丢失了。。。');
            return $this->fetch('error_msg');
        }
    }
}
