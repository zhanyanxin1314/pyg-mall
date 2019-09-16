<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\Orders as O;
use app\common\model\Inform as I;
use app\index\model\Goods as G;
use app\common\model\Users as U;
use app\common\model\UserAddress as UA;
use app\common\model\GoodsAppraises as GA;
use app\common\model\Favorites as F;
use app\common\model\History as H;
class Center extends Base
{
    /**
     * 用户中心 - 订单列表
     */
    public function order()
    {
        $this->checkAuth();
        $this->assign("p",(int)input("p"));
        $o  = new O();
        $list = $o->getAllOrders();
        $this->assign('list',$list);
    	$this->assign('nav','order');
        return $this->fetch();
    }

    /**
     * 用户中心 - 收货地址
     */
    public function address()
    {
        $this->checkAuth();
        $this->assign("p",(int)input("p"));
    	$this->assign('nav','address');
        $userId = (int)session('PYG_USER.userId');
        //查询收货地址
        $ua = new UA();
        $data = $ua->listQuery($userId);
        $total = count($data);
        $this->assign('total',$total);
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 用户中心 - 收货地址 - 编辑收货人姓名
     */
    public function editAddressUserName()
    {
        $ua = new UA();
        $addressId = input("addressId");
        $userName = input("userName");
        $list = $ua->editAddressName($addressId,$userName);
        return $list;
    }
    
    /**
     * 用户中心 - 关注的商品
     */
    public function favorites()
    {
        $this->checkAuth();
        $this->assign("p",(int)input("p"));
        $this->assign('nav','favorites');
        //查询关注商品列表
        $f = new F();
        $data = $f->listGoodsQuery();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 用户中心 - 个人信息
     */
    public function info()
    {
        $this->checkAuth();
        $this->assign("p",(int)input("p"));
        $this->assign('nav','info');
        $userId = (int)session('PYG_USER.userId');
        $u  = new U();
        $rs = $u->getFieldsById($userId);
        $this->assign('list',$rs);
        $this->assign('userId',$userId);
        return $this->fetch();
    }

    /**
     * 用户 - 待付款订单
     */
    public function waitPay()
    {
        $this->checkAuth();
        $this->assign("p",(int)input("p"));
        $o  = new O();
        $list = $o->getAllOrders();
        $this->assign('list',$list);
        return $this->fetch('order');
    }
    
    /**
     * 用户中心 - 取消订单记录列表
     */
    public function cancel()
    {
        $this->checkAuth();
        $this->assign("p",(int)input("p"));
        $o  = new O();
        $list = $o->getAllOrders();
        $this->assign('list',$list);
        $this->assign('nav','cancel');
        return $this->fetch();
    }

    /**
     * 用户 - 订单详情
     */
    public function orderDetail()
    {
        $this->checkAuth();
        $o  = new O();
        $orderNo = input("orderNo");
        $list = $o->getOrderDetail($orderNo);
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 用户 - 取消订单记录-操作
     */
    public function cancelOrders()
    {
        $this->checkAuth();
        $o  = new O();
        $orderId = input("orderId");
        $list = $o->cancelOrders($orderId);
        return $list;
    }

    /**
     * 用户 - 恢复订单记录-操作
     */
    public function resumedOrders()
    {
        $this->checkAuth();
        $o  = new O();
        $orderId = input("orderId");
        $list = $o->resumedOrders($orderId);
        return $list;
    }

    /**
     * 用户 - 永久删除订单
     */
    public function delOrders()
    {
        $this->checkAuth();
        $o  = new O();
        $orderId = input("orderId");
        $list = $o->delOrders($orderId);
        return $list;
    }

    /**
     * 用户中心 - 浏览历史
     */
    public function history()
    {
        $this->checkAuth();
        $this->assign("p",(int)input("p"));
        $h  = new H();
        $list = $h->listGoodsQuery();
        $this->assign('list',$list);
        $this->assign('nav','history');
        return $this->fetch();
    }

    /**
     * 用户 - 确认收货-操作
     */
    public function takeOrders()
    {
        $this->checkAuth();
        $o  = new O();
        $orderId = input("orderId");
        $list = $o->takeOrders($orderId);
        return $list;
    }


    /**
    * 用户中心 - 个人信息修改 - 操作
    */
    public function toEditInfo(){
        $u = new U();
        $rs = $u->edit();
        return $rs;
    }

    /**
     * 用户中心 - 安全设置
     */
    public function safe()
    {
        $this->checkAuth();
        $this->assign("p",(int)input("p"));
        $this->assign('nav','safe');
        $userId = (int)session('PYG_USER.userId');
        return $this->fetch();
    }

    /**
    * 用户中心 - 安全设置 - 密码设置
    */
    public function passedit(){
        $this->checkAuth();
        $userId = (int)session('PYG_USER.userId');
        $m = new U();
        $rs = $m->editPass($userId);
        return $rs;
    }

    /**
    * 订单评价 - 展示页面
    */
    public function toAppraise(){
        $this->checkAuth();
        $m = new O();
        $data = $m->getOrderInfoAndAppr();
        $this->assign(['data'=>$data['data'],
                       'order'=>$data['orderNo'],
                       'count'=>$data['count']]);
        return $this->fetch();
    }

    /**
    * 订单评价 - 增加 - 操作
    */
    public function addAppraise(){
        $m = new GA();
        $rs = $m->addAppra();
        return $rs;
    }

    /**
    * 用户中心 - 评价晒单 - 列表
    */
    public function appraise(){
        $this->checkAuth();
        $this->assign("p",(int)input("p"));
        $this->assign('nav','appraise');
        $m = new GA();
        $data = $m->getGoodsAppraise();
        $this->assign('data',$data['data']);
        return $this->fetch();
    }  

    /**
     * 商品举报页面
     */
    public function inform(){
       $this->checkAuth();
       $this->assign('nav','inform');
       $this->assign('p',(int)input('p'));
       $list = model('inform')->queryUserInformByPage();

       $this->assign('list',$list['data']['data']);
       return $this->fetch('inform');
    }

    /**
     * 商品详情页-举报商品-展示页面-操作
     */
    public function addInform()
    {
        $this->checkAuth();
        $g  = new G();
        $gId = input("gId");
        $list = $g->getById($gId);
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 商品详情页-举报商品-增加-操作
     */
    public function saveInform()
    {
        $this->checkAuth();
        return model('Inform')->saveInform();  
    }

    /**
     * 用户查举报详情
     */
    public function informDetail(){
        $this->checkAuth();
        $data = model('Inform')->getUserInformDetail(0);
        
        $this->assign("data",$data);
        $this->assign("p",(int)input('p'));
        return $this->fetch("inform_detail");
    }

    /**
     * 订单投诉列表页面
     */
    public function complains(){
        $this->checkAuth();
        $this->assign('nav','complains');
        $data =  model('OrderComplains')->queryUserComplainByPage();
        
        $this->assign("data",$data['data']['data']);
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    /**
     * 订单跳转到-订单投诉页面
     */
    public function orderComplains(){
        $this->checkAuth();
        $data = model('OrderComplains')->getOrderInfo();

        $this->assign("data",$data);
        $this->assign("src",input('src'));
        $this->assign("p",(int)input('p',1));
        return $this->fetch();
    }

    /**
     * 保存订单投诉信息
     */
    public function saveComplain(){
        return model('OrderComplains')->saveComplain();
    }

    /**
     * 用户查投诉详情
     */
    public function getUserComplainDetail(){
        $data = model('OrderComplains')->getComplainDetail(0);
        
        $this->assign("data",$data);
        $this->assign("p",(int)input("p"));
        return $this->fetch("complain_detail");
    }

}
