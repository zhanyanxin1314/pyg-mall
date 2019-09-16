<?php
namespace app\common\model;
use think\Db;
use think\Model;
use Env;
/**
 * 用户类
 */
class Users extends Model{
	protected $pk = 'userId';
    /**
     * 用户登录验证
     */
    public function checkLogin($loginSrc = 0){
    	$loginName = input("post.loginName");
    	$loginPwd = input("post.loginPwd");
    	
        
    	$rememberPwd = input("post.rememberPwd",1);
    	// if(!WSTVerifyCheck($code) && strpos(WSTConf("CONF.captcha_model"),"4")>=0){
    	// 	return WSTReturn('验证码错误!');
    	// }
    	// $decrypt_data = WSTRSA($loginPwd);
    	// if($decrypt_data['status']==1){
    	// 	$loginPwd = $decrypt_data['data'];
    	// }else{
    	// 	return WSTReturn('登录失败');
    	// }
    	$rs = $this->where("loginName|userEmail|userPhone",$loginName)
    				->where(["dataFlag"=>1, "userStatus"=>1])
    				->find();

    	if(!empty($rs)){
            if($rs['loginPwd']!=md5($loginPwd))return PYGReturn("密码错误");
    		$userId = $rs['userId'];
    		//获取用户等级
	    	$rrs = Db::name('user_ranks')->where(['dataFlag'=>1])->where('startScore','<=',$rs['userTotalScore'])->where('endScore','>=',$rs['userTotalScore'])->field('rankId,rankName,rankImg')->find();
	    	$rs['rankId'] = $rrs['rankId'];
	    	$rs['rankName'] = $rrs['rankName'];
	    	$rs['rankImg'] = $rrs['rankImg'];

    		$ip = request()->ip();
    		$update = [];
    		$update = ["lastTime"=>date('Y-m-d H:i:s'),"lastIP"=>$ip];
    		$this->where(["userId"=>$userId])->update($update);
    		$data = array();
    		$data["userId"] = $userId;
    		$data["loginTime"] = date('Y-m-d H:i:s');
    		$data["loginIp"] = $ip;
    		Db::name('log_user_logins')->insert($data);
    		session('PYG_USER',$rs);
    		return PYGReturn("登录成功","1");
    	}
    	return PYGReturn("用户不存在");
    }
    
    /**
     * 会员注册
     */
    public function regist(){
    	$data = array();
    	$data['loginName'] = input("post.loginName");
    	$data['loginPwd'] = input("post.loginPwd");
    	$data['reUserPwd'] = input("post.reUserPwd");

    	//检测账号是否存在
    	$crs = PYGCheckLoginKey($data['loginName']);
    	if($crs['status']!=1)return $crs;
   
    	if($data['loginPwd']!=$data['reUserPwd']){
    		return WSTReturn("两次输入密码不一致!");
    	}
    	foreach ($data as $v){
    		if($v ==''){
    			return WSTReturn("注册信息不完整!");
    		}
    	}
		$loginName = PYGRandomLoginName($data['loginName']);
    	if($loginName=='')return PYGReturn("注册失败!");
    	unset($data['reUserPwd']);
    	unset($data['protocol']);
    	//检测账号，邮箱，手机是否存在
    	$data["loginSecret"] = rand(1000,9999);
    	$data['loginPwd'] = md5($data['loginPwd']);
    	$data['userType'] = 0;
    	$data['userName'] = '手机用户'.substr($data['userPhone'],-4);
    	$data['userQQ'] = "";
    	$data['userScore'] = 0;
    	$data['createTime'] = date('Y-m-d H:i:s');
    	$data['dataFlag'] = 1;
    	Db::startTrans();
        try{

	    	$userId = $this->data($data)->save();
	    	if(false !== $userId){
	    		$data = array();
	    		$ip = request()->ip();
	    		$data['lastTime'] = date('Y-m-d H:i:s');
	    		$data['lastIP'] = $ip;
	    		$userId = $this->userId;
	    		$this->where(["userId"=>$userId])->update($data);
	    		//记录登录日志
	    		$data1 = array();
	    		$data1["userId"] = $userId;
	    		$data1["loginTime"] = date('Y-m-d H:i:s');
	    		$data1["loginIp"] = $ip;
	    		Db::name('log_user_logins')->insert($data1);
	    		$user = $this->get(['userId'=>$userId]);
	    		session('PYG_USER',$user);
	    		Db::commit();
	    		return PYGReturn("注册成功",1);
	    	}
        }catch (\Exception $e) {
        	Db::rollback();
        }
    	return PYGReturn("注册失败!");
    }
    
    /**
     * 查询用户手机是否存在
     * 
     */
    public function checkUserPhone($userPhone,$userId = 0){
    	$dbo = $this->where(["dataFlag"=>1, "userPhone"=>$userPhone]);
    	if($userId>0){
    		$dbo->where("userId","<>",$userId);
    	}
    	$rs = $dbo->count();
    	if($rs>0) {
    		return PYGReturn("手机号已存在!");
    	} else {
    		return PYGReturn("",1);
    	}
    }

    /**
     * 编辑资料
    */
    public function edit(){
    	$Id = (int)session('PYG_USER.userId');
    	$data = input('post.');
        if(isset($data['brithday']))$data['brithday'] = ($data['brithday']=='')?date('Y-m-d'):$data['brithday'];
    	PYGAllow($data,'brithday,trueName,nickName,userId,userPhoto,userQQ,userSex,userEmail');
    	Db::startTrans();
		try{
	    	$result = $this->allowField(true)->save($data,['userId'=>$Id]);
	    	if(false !== $result){
	    		Db::commit();
	    		return PYGReturn("编辑成功", 1);
	    	}
		}catch (\Exception $e) {
            Db::rollback();
            return PYGReturn('编辑失败'.$e->getMessage(),-1);
        }	
    }
    /**
    * 绑定邮箱
     */
    public function editEmail($userId,$userEmail){
    	$data = array();
    	$data["userEmail"] = $userEmail;
    	Db::startTrans();
    	try{
    		$user = Db::name('users')->where(["userId"=>$userId])->field(["userId","loginName,userEmail"])->find();
			$rs = $this->update($data,['userId'=>$userId]);
			if(false !== $rs){
				hook("afterEditEmail",["user"=>$user]);
				Db::commit();
				return PYGReturn("绑定成功",1);
			}else{
				Db::rollback();
				return PYGReturn("",-1);
			}
		}catch (\Exception $e) {
    		Db::rollback();
    		return PYGReturn('编辑失败',-1);
    	}
    }
    /**
     * 绑定手机
     */
    public function editPhone($userId,$userPhone){
    	$data = array();
    	$data["userPhone"] = $userPhone;
    	$rs = $this->update($data,['userId'=>$userId]);
    	if(false !== $rs){
    		return PYGReturn("绑定成功", 1);
    	}else{
    		return PYGReturn($this->getError(),-1);
    	}
    }
    /**
     * 查询并加载用户资料
     */
    public function checkAndGetLoginInfo($key){
    	if($key=='')return array();
    	$rs = $this->where([["loginName|userEmail|userPhone",'=',$key],['dataFlag','=',1]])->find();
    	return $rs;
    }
    
    /**
     * 获取用户可用积分
     */
    public function getFieldsById($userId){
    	return $this->where(['userId'=>$userId,'dataFlag'=>1])->find();
    }

    /**
     * 用户退出
     */
    public function logout(){
        session('PYG_USER',null);
        return PYGReturn("退出成功",1);
    }

      /**
     * 修改用户密码
     */
    public function editPass($id){
        $data = array();
        $newPass = input("post.newPass");
    
        if(!$newPass){
            return WSTReturn('密码不能为空',-1);
        }
        $rs = $this->where('userId='.$id)->find();
        //核对密码
        if($rs['loginPwd']){
            $oldPass = input("post.oldPass");
            if($rs['loginPwd']==md5($oldPass)){
                $data["loginPwd"] = md5($newPass);
                $rs = $this->update($data,['userId'=>$id]);
                if(false !== $rs){
                    
                    return PYGReturn("密码修改成功", 1);
                }else{
                    return PYGReturn($this->getError(),-1);
                }
            }else{
                return PYGReturn('原始密码错误',-1);
            }
        }else{
            $data["loginPwd"] = md5($newPass);
            $rs = $this->update($data,['userId'=>$id]);
            if(false !== $rs){
            
                return PYGReturn("密码修改成功", 1);
            }else{
                return PYGReturn($this->getError(),-1);
            }
        }
    }
}
