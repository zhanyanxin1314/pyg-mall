<?php

// +----------------------------------------------------------------------
// | 公共控制模块
// +----------------------------------------------------------------------

namespace app\common\controller;

use think\Controller;

class Base extends Controller
{


    public function _initialize()
    {
        echo 'init<br/>';
    }

    //空操作
    public function _empty()
    {
        $this->error('该页面不存在！');
    }

    // 登录验证方法--用户
    protected function checkAuth(){
       	$USER = session('PYG_USER');
        if(empty($USER)){
        	if(request()->isAjax()){
        		die('{"status":-999,"msg":"您还未登录"}');
        	} else {
        		$this->redirect('index/users/login');
        		exit;
        	}
        }
    }
}
