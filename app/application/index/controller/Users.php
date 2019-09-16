<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\Users as MUsers;

class Users extends Base
{


	public function clickver(){
        

        $clicaptcha = new \capt\clicaptcha();
        if($_POST['do'] == 'check'){
            echo $clicaptcha->check($_POST['info'], false) ? 1 : 0;
        }else{
            $clicaptcha->creat();
        }
    }
    
	/**
     * 去登录
     */
    public function Login()
    {
    	$USER = session('PYG_USER');
        return $this->fetch();
    }

    /**
	 * 验证登录
	 *
	 */
	public function checkLogin(){
		$m = new MUsers();
    	$rs = $m->checkLogin();
    	$rs['url'] = session('PYG_HO_CURRENTURL');
    	return $rs;
	}


	/**
     * 用户注册
     * 
     */
	public function regist(){
		$USER = session('PYG_USER');
		//如果已经登录了则直接跳去用户中心
		if(!empty($USER) && $USER['userId']!=''){
			$this->redirect("/");
		}
		$loginName = cookie("loginName");
		if(!empty($loginName)){
			$this->assign('loginName',cookie("loginName"));
		}else{
			$this->assign('loginName','');
		}
		return $this->fetch();
	}

	/**
	 * 跳到用户注册协议
	 */
	public function protocol(){
		return $this->fetch("user_protocol");
	}
	/**
	 * 新用户注册
	 */
	public function toRegist(){
		$m = new MUsers();
		$rs = $m->regist();
		$rs['url'] = session('PYG_HO_CURRENTURL');
		return $rs;
	
	}

	/**
	 * 用户退出
	 */
	public function logout(){
		$rs = model('Users')->logout();
		return $rs;
	}

	/**
     * 加载登录小窗口
     */
    public function toLoginBox(){
    	return $this->fetch('box_login');
    }

}
