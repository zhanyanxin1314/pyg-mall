<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\UserSign as M;
use think\Request;
use think\Db;
class Sign extends Base
{
    /**
     * 用户签到
     */
    public function userSign() {
   
        $m = new M();
        $data['addtime'] = strtotime(date("Y-m-d 00:00:00"));
        $data['uid'] = (int)session('PYG_USER.userId');
        if(empty($data['uid'])){
             return  json(["code" => 3, "result" => "请先登录！"]);
        }
        $yesterday_start = $data['addtime'] - 3600 * 24;
        $yesterday_end = $data['addtime'] - 1;
        $where['addtime'] = ['between time', $yesterday_start, $yesterday_end];
        $where['uid'] = $data['uid'];
        $yesterday_info = $m->field("num,points")->where($where)->find();
        $data['num'] = $yesterday_info['num'] > 0 ? $yesterday_info['num'] + 1 : 1;
        $where1['addtime'] = $data['addtime'];
        $where1['uid'] = $data['uid'];
        $info = $m->where($where1)->find();
        if (empty($info)) {
            $data['points'] =  6;
            $lastid = $m->save($data);
            $billData = ['uid' => $data['uid'], 'title' => '用户签到','category'=>'integral','type'=>'sign','number'=>6,'balance'=>6,'mark'=>'签到获得6积分','add_time'=>date('Y-m-d H:i:s',time()),'status'=>1];
            Db::table('pyg_user_bill')->insert($billData);
            if ($lastid > 0) {
                $sign_info = getSignTip();
                $sign_tip = $sign_info['tip'];
                $sign_tip1 = $sign_info['tip1'];
                return json(["code" => 2, "result" => "连续签到" . $data['num'] . "天奖励" . $data['points'] . "积分", "days" => $data['num'], "points" => $data['points'], "sign_tip" => $sign_tip,"sign_tip1" => $sign_tip1]);
            }
        } else {
            return  json(["code" => 1, "result" => "今日已签到"]);
        }
    }
}