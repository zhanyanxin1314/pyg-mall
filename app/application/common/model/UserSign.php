<?php
namespace app\common\model;
use think\Db;
use think\Model;
use Env;

/**
 * 用户签到类
 */
class UserSign extends Model{
	protected $pk = 'signId';
}