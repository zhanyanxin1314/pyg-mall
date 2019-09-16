/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.7.17 : Database - mall
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mall` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mall`;

/*Table structure for table `pyg_ad_positions` */

DROP TABLE IF EXISTS `pyg_ad_positions`;

CREATE TABLE `pyg_ad_positions` (
  `positionId` int(11) NOT NULL AUTO_INCREMENT,
  `positionName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  `positionCode` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `apSort` int(11) NOT NULL,
  PRIMARY KEY (`positionId`),
  KEY `positionCode` (`positionCode`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_ad_positions` */

insert  into `pyg_ad_positions`(`positionId`,`positionName`,`dataFlag`,`positionCode`,`apSort`) values (1,'首页轮播位置',1,'index_banner',2),(3,'首页-有趣区-左侧',1,'index_youqu_left',2),(4,'首页-有趣区-好东西',1,'index_youqu_hdx',2),(6,'首页-有趣区-品牌街-01',1,'index_youqu_ppj_01',4),(7,'首页-有趣区-品牌街-02',1,'index_youqu_ppj_02',5),(8,'首页-有趣区-品牌街-03',1,'index_youqu_ppj_03',6);

/*Table structure for table `pyg_admin` */

DROP TABLE IF EXISTS `pyg_admin`;

CREATE TABLE `pyg_admin` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '管理账号',
  `password` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '管理密码',
  `roleid` tinyint(4) unsigned DEFAULT '0',
  `encrypt` varchar(6) CHARACTER SET utf8 DEFAULT NULL COMMENT '加密因子',
  `nickname` char(16) CHARACTER SET utf8 NOT NULL COMMENT '昵称',
  `last_login_time` int(10) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) unsigned DEFAULT '0' COMMENT '最后登录IP',
  `email` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '会员状态',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

/*Data for the table `pyg_admin` */

insert  into `pyg_admin`(`id`,`username`,`password`,`roleid`,`encrypt`,`nickname`,`last_login_time`,`last_login_ip`,`email`,`status`) values (1,'admin','9724b5e6c56b95f5723009ef81961bfe',1,'Wo0bAa','张艳新',1563932662,2130706433,'695860928@qq.com',1);

/*Table structure for table `pyg_adminlog` */

DROP TABLE IF EXISTS `pyg_adminlog`;

CREATE TABLE `pyg_adminlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `uid` smallint(3) NOT NULL DEFAULT '0' COMMENT '操作者ID',
  `info` text CHARACTER SET utf8 COMMENT '说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` bigint(20) unsigned NOT NULL DEFAULT '0',
  `get` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=599 DEFAULT CHARSET=utf8mb4 COMMENT='操作日志';

/*Data for the table `pyg_adminlog` */

insert  into `pyg_adminlog`(`id`,`status`,`uid`,`info`,`create_time`,`ip`,`get`) values (598,0,1,'提示语:该页面不存在！',1563957998,2130706433,'/admin/Integralconfig/pageQuery'),(597,0,1,'提示语:该页面不存在！',1563957981,2130706433,'/admin/Integralconfig/pageQuery'),(596,0,1,'提示语:该页面不存在！',1563957978,2130706433,'/admin/Integralconfig/pageQuery'),(595,0,1,'提示语:该页面不存在！',1563957955,2130706433,'/admin/Integralconfig/pageQuery'),(594,0,1,'提示语:该页面不存在！',1563957787,2130706433,'/admin/Integralconfig/pageQuery'),(593,0,1,'提示语:该页面不存在！',1563957778,2130706433,'/admin/Integralconfig/pageQuery'),(592,0,1,'提示语:该页面不存在！',1563957635,2130706433,'/admin/Integralconfig/pageQuery'),(591,0,1,'提示语:该页面不存在！',1563957619,2130706433,'/admin/Integralconfig/pageQuery'),(590,0,1,'提示语:该页面不存在！',1563957573,2130706433,'/admin/Integralconfig/pageQuery'),(589,0,1,'提示语:该页面不存在！',1563957564,2130706433,'/admin/Integralconfig/pageQuery'),(588,0,1,'提示语:该页面不存在！',1563957456,2130706433,'/admin/Integralconfig/pageQuery'),(587,0,1,'提示语:该页面不存在！',1563957412,2130706433,'/admin/Integralconfig/pageQuery'),(586,0,1,'提示语:该页面不存在！',1563957399,2130706433,'/admin/Integralconfig/pageQuery'),(585,0,1,'提示语:该页面不存在！',1563957145,2130706433,'/admin/Integralconfig/pageQuery'),(584,0,1,'提示语:该页面不存在！',1563957123,2130706433,'/admin/Integralconfig/pageQuery'),(583,0,1,'提示语:该页面不存在！',1563957111,2130706433,'/admin/Integralconfig/pageQuery'),(582,0,1,'提示语:该页面不存在！',1563957094,2130706433,'/admin/Integralconfig/pageQuery'),(581,0,1,'提示语:该页面不存在！',1563957070,2130706433,'/admin/Integralconfig/pageQuery'),(580,0,1,'提示语:该页面不存在！',1563956292,2130706433,'/admin/Integralconfig/pageQuery'),(579,1,1,'提示语:添加成功！',1563952344,2130706433,'/admin/menu/add.html?parentid=56'),(578,1,1,'提示语:编辑成功！',1563952284,2130706433,'/admin/menu/edit.html?id=90'),(577,1,1,'提示语:添加成功！',1563952270,2130706433,'/admin/menu/add.html?parentid=56'),(576,1,1,'提示语:添加成功！',1563952226,2130706433,'/admin/menu/add.html?parentid=56'),(575,1,1,'提示语:编辑成功！',1563952173,2130706433,'/admin/menu/edit.html?id=56'),(574,1,1,'提示语:编辑成功！',1563952132,2130706433,'/admin/menu/edit.html?id=56'),(573,1,1,'提示语:编辑成功！',1563952106,2130706433,'/admin/menu/edit.html?id=56'),(572,1,1,'提示语:恭喜您，登陆成功',1563932662,2130706433,'/admin/index/login.html'),(571,0,0,'提示语:请先登陆',1563932649,2130706433,'/admin/index/index.html'),(570,1,1,'提示语:恭喜您，登陆成功',1563931219,2130706433,'/admin/index/login.html'),(569,0,0,'提示语:请先登陆',1563931169,2130706433,'/admin'),(568,1,1,'提示语:恭喜您，登陆成功',1563859707,2130706433,'/admin/index/login.html'),(567,0,0,'提示语:请先登陆',1563859696,2130706433,'/admin'),(566,1,1,'提示语:操作成功！',1563517850,2130706433,'/admin/menu/setstate.html?id=80&status=0'),(565,1,1,'提示语:恭喜您，登陆成功',1563499658,2130706433,'/admin/index/login.html'),(564,0,0,'提示语:请先登陆',1563499646,2130706433,'/admin'),(563,0,1,'提示语:该页面不存在！',1563439684,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(562,0,1,'提示语:该页面不存在！',1563439673,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(561,0,1,'提示语:该页面不存在！',1563439659,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(560,0,1,'提示语:该页面不存在！',1563439592,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(559,0,1,'提示语:该页面不存在！',1563438091,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(558,0,1,'提示语:该页面不存在！',1563438076,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(557,0,1,'提示语:该页面不存在！',1563438063,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(556,0,1,'提示语:该页面不存在！',1563437974,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(555,0,1,'提示语:该页面不存在！',1563437956,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(554,0,1,'提示语:该页面不存在！',1563437882,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(553,0,1,'提示语:该页面不存在！',1563437814,2130706433,'/admin/orderComplains/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204.jpg'),(552,1,1,'提示语:编辑成功！',1563436219,2130706433,'/admin/menu/edit.html?id=79'),(551,1,1,'提示语:操作成功！',1563436188,2130706433,'/admin/menu/setstate.html?id=102&status=0'),(550,1,1,'提示语:操作成功！',1563436186,2130706433,'/admin/menu/setstate.html?id=103&status=0'),(549,1,1,'提示语:删除菜单成功！',1563436015,2130706433,'/admin/menu/delete.html?id=84'),(548,1,1,'提示语:删除菜单成功！',1563436010,2130706433,'/admin/menu/delete.html?id=81'),(547,1,1,'提示语:删除菜单成功！',1563436001,2130706433,'/admin/menu/delete.html?id=91'),(546,1,1,'提示语:恭喜您，登陆成功',1563435981,2130706433,'/admin/index/login.html'),(545,0,0,'提示语:请先登陆',1563435972,2130706433,'/admin/inform/index/menuid/90.html'),(544,0,1,'提示语:该页面不存在！',1563413435,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(543,0,1,'提示语:该页面不存在！',1563413394,2130706433,'/admin/goodsappraises/public/static/admin/img/icon_score_yes.png'),(542,0,1,'提示语:该页面不存在！',1563413386,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(541,0,1,'提示语:该页面不存在！',1563413382,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(540,0,1,'提示语:该页面不存在！',1563413260,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(539,0,1,'提示语:该页面不存在！',1563413182,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(538,0,1,'提示语:该页面不存在！',1563413182,2130706433,'/admin/goodsappraises/__ROOT__/app/application/admin/view/goodsappraises/icon_score_yes.png'),(537,1,1,'提示语:恭喜您，登陆成功',1563413112,2130706433,'/admin/index/login.html'),(536,0,0,'提示语:验证码输入错误！',1563413097,2130706433,'/admin/index/login.html'),(535,0,0,'提示语:验证码输入错误！',1563413051,2130706433,'/admin/index/login.html'),(534,0,0,'提示语:请先登陆',1563413040,2130706433,'/admin'),(533,0,1,'提示语:该页面不存在！',1563358733,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(532,0,1,'提示语:该页面不存在！',1563358733,2130706433,'/admin/goodsappraises/__ROOT__/app/application/admin/view/goodsappraises/icon_score_yes.png'),(531,0,1,'提示语:该页面不存在！',1563358730,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(530,0,1,'提示语:该页面不存在！',1563358730,2130706433,'/admin/goodsappraises/__ROOT__/app/application/admin/view/goodsappraises/icon_score_yes.png'),(529,0,1,'提示语:该页面不存在！',1563358723,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(528,0,1,'提示语:该页面不存在！',1563358723,2130706433,'/admin/goodsappraises/__ROOT__/app/application/admin/view/goodsappraises/icon_score_yes.png'),(527,0,1,'提示语:该页面不存在！',1563358719,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(526,0,1,'提示语:该页面不存在！',1563358719,2130706433,'/admin/goodsappraises/__ROOT__/app/application/admin/view/goodsappraises/icon_score_yes.png'),(525,0,1,'提示语:该页面不存在！',1563358702,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(524,0,1,'提示语:该页面不存在！',1563358702,2130706433,'/admin/goodsappraises/__ROOT__/app/application/admin/view/goodsappraises/icon_score_yes.png'),(523,0,1,'提示语:该页面不存在！',1563358641,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(522,0,1,'提示语:该页面不存在！',1563358641,2130706433,'/admin/goodsappraises/__ROOT__/app/application/admin/view/goodsappraises/icon_score_yes.png'),(521,0,1,'提示语:该页面不存在！',1563358637,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(520,0,1,'提示语:该页面不存在！',1563358637,2130706433,'/admin/goodsappraises/__ROOT__/app/application/admin/view/goodsappraises/icon_score_yes.png'),(519,0,1,'提示语:该页面不存在！',1563358624,2130706433,'/admin/goodsappraises/__ROOT__/application/admin/view/goodsappraises/icon_score_yes.png'),(518,0,1,'提示语:该页面不存在！',1563358624,2130706433,'/admin/goodsappraises/__ROOT__/app/application/admin/view/goodsappraises/icon_score_yes.png'),(517,0,1,'提示语:该页面不存在！',1563358598,2130706433,'/admin/goodsappraises/admin/goodsappraises/index'),(516,0,1,'提示语:该页面不存在！',1563358119,2130706433,'/admin/goodsappraises/__RESOURCE_PATH__//uploads/goods/20190530/169e891c93641d61a0849769eeb16204_thumb.jpg'),(515,1,1,'提示语:编辑成功！',1563357165,2130706433,'/admin/menu/edit.html?id=89'),(514,1,1,'提示语:编辑成功！',1563357085,2130706433,'/admin/menu/edit.html?id=89'),(513,0,1,'提示语:控制器只能是字母',1563357081,2130706433,'/admin/menu/edit.html?id=89'),(512,0,1,'提示语:该页面不存在！',1563357033,2130706433,'/admin/appraise/admin/view/goodsappraises/icon_score_yes.png'),(511,1,1,'提示语:编辑成功！',1563355957,2130706433,'/admin/menu/edit.html?id=89'),(510,1,1,'提示语:恭喜您，登陆成功',1563343668,2130706433,'/admin/index/login.html'),(509,0,0,'提示语:请先登陆',1563343658,2130706433,'/admin'),(508,1,1,'提示语:恭喜您，登陆成功',1563328161,2130706433,'/admin/index/login.html'),(507,0,0,'提示语:验证码输入错误！',1563328154,2130706433,'/admin/index/login.html'),(506,0,0,'提示语:请先登陆',1563328133,2130706433,'/admin'),(505,1,1,'提示语:恭喜您，登陆成功',1563325180,2130706433,'/admin/index/login.html'),(504,0,0,'提示语:请先登陆',1563325167,2130706433,'/admin'),(503,0,1,'提示语:该页面不存在！',1563270364,2130706433,'/admin/Inform/admin/Inform/finalHandle'),(502,1,1,'提示语:恭喜您，登陆成功',1563269099,2130706433,'/admin/index/login.html'),(501,0,0,'提示语:请先登陆',1563269082,2130706433,'/admin'),(500,0,0,'提示语:请先登陆',1563267955,2130706433,'/admin/'),(499,0,1,'提示语:该页面不存在！',1563264251,2130706433,'/admin/Inform/toHandle'),(498,1,1,'提示语:编辑成功！',1563260869,2130706433,'/admin/menu/edit.html?id=90'),(497,1,1,'提示语:恭喜您，登陆成功',1563259991,2130706433,'/admin/index/login.html'),(496,0,0,'提示语:请先登陆',1563259978,2130706433,'/admin/menu/index/menuid/14.html'),(495,1,1,'提示语:恭喜您，登陆成功',1563242789,2130706433,'/admin/index/login.html'),(494,0,0,'提示语:请先登陆',1563242766,2130706433,'/admin/'),(493,0,0,'提示语:请先登陆',1563238469,2130706433,'/admin/'),(492,1,1,'提示语:恭喜您，登陆成功',1562891934,2130706433,'/admin/index/login.html'),(491,0,0,'提示语:请先登陆',1562891913,2130706433,'/admin/'),(490,1,1,'提示语:恭喜您，登陆成功',1562806695,2130706433,'/admin/index/login.html'),(489,0,0,'提示语:请先登陆',1562806674,2130706433,'/admin/'),(488,1,1,'提示语:恭喜您，登陆成功',1562766000,2130706433,'/admin/index/login.html'),(487,0,0,'提示语:验证码输入错误！',1562765994,2130706433,'/admin/index/login.html'),(486,0,0,'提示语:请先登陆',1562765965,2130706433,'/admin'),(485,1,1,'提示语:恭喜您，登陆成功',1562738256,2130706433,'/admin/index/login.html'),(484,0,0,'提示语:请先登陆',1562738243,2130706433,'/admin'),(483,1,1,'提示语:恭喜您，登陆成功',1562726283,2130706433,'/admin/index/login.html'),(482,0,0,'提示语:请先登陆',1562726262,2130706433,'/admin/'),(481,1,1,'提示语:恭喜您，登陆成功',1562640536,2130706433,'/admin/index/login.html'),(480,0,0,'提示语:请先登陆',1562640528,2130706433,'/admin/'),(479,1,1,'提示语:恭喜您，登陆成功',1562290010,2130706433,'/admin/index/login.html'),(478,0,0,'提示语:请先登陆',1562290001,2130706433,'/admin/'),(477,1,1,'提示语:恭喜您，登陆成功',1562220637,2130706433,'/admin/index/login.html'),(476,0,0,'提示语:请先登陆',1562220627,2130706433,'/admin/goods/cats/menuid/86.html'),(475,1,1,'提示语:恭喜您，登陆成功',1562200332,2130706433,'/admin/index/login.html'),(474,0,0,'提示语:请先登陆',1562200320,2130706433,'/admin/'),(473,1,1,'提示语:操作成功！',1562057124,2130706433,'/admin/menu/setstate.html?id=108&status=0'),(472,1,1,'提示语:编辑成功！',1562057117,2130706433,'/admin/menu/edit.html?id=108'),(471,1,1,'提示语:编辑成功！',1562057104,2130706433,'/admin/menu/edit.html?id=107'),(470,1,1,'提示语:恭喜您，登陆成功',1562049737,2130706433,'/admin/index/login.html'),(469,0,0,'提示语:请先登陆',1562049718,2130706433,'/admin/'),(468,1,1,'提示语:恭喜您，登陆成功',1562030862,2130706433,'/admin/index/login.html'),(467,0,0,'提示语:请先登陆',1562030850,2130706433,'/admin/'),(466,0,1,'提示语:该页面不存在！',1561962464,2130706433,'/admin/order/editExpress59'),(465,0,1,'提示语:该页面不存在！',1561962457,2130706433,'/admin/order/editExpress59'),(464,1,1,'提示语:恭喜您，登陆成功',1561956892,2130706433,'/admin/index/login.html'),(463,0,0,'提示语:请先登陆',1561956883,2130706433,'/admin/'),(462,1,1,'提示语:恭喜您，登陆成功',1561684047,2130706433,'/admin/index/login.html'),(461,0,0,'提示语:请先登陆',1561684038,2130706433,'/admin/'),(460,0,1,'提示语:该页面不存在！',1561625122,2130706433,'/admin/express/get'),(459,1,1,'提示语:添加成功！',1561622699,2130706433,'/admin/menu/add.html'),(458,1,1,'提示语:添加成功！',1561622697,2130706433,'/admin/menu/add.html'),(457,1,1,'提示语:恭喜您，登陆成功',1561598900,2130706433,'/admin/index/login.html'),(456,0,0,'提示语:请先登陆',1561598784,2130706433,'/admin/'),(454,0,0,'提示语:请先登陆',1561511728,2130706433,'/admin/'),(455,1,1,'提示语:恭喜您，登陆成功',1561511751,2130706433,'/admin/index/login.html'),(453,1,1,'提示语:恭喜您，登陆成功',1561423941,2130706433,'/admin/index/login.html'),(452,0,0,'提示语:请先登陆',1561423930,2130706433,'/admin/'),(451,1,1,'提示语:清理缓存',1561358363,2130706433,'/admin/index/cache.html?type=all&_=1561353398737'),(450,1,1,'提示语:恭喜您，登陆成功',1561353396,2130706433,'/admin/index/login.html'),(449,0,0,'提示语:请先登陆',1561353384,2130706433,'/admin/'),(448,1,1,'提示语:恭喜您，登陆成功',1560909156,2130706433,'/admin/index/login.html'),(447,0,0,'提示语:验证码输入错误！',1560909146,2130706433,'/admin/index/login.html'),(446,0,0,'提示语:请先登陆',1560909135,2130706433,'/admin/'),(445,1,1,'提示语:恭喜您，登陆成功',1560820221,2130706433,'/admin/index/login.html'),(444,0,0,'提示语:请先登陆',1560820196,2130706433,'/admin/'),(443,0,1,'提示语:该页面不存在！',1560758587,2130706433,'/admin/ads/index2?id=1&p=1'),(442,1,1,'提示语:恭喜您，登陆成功',1560757616,2130706433,'/admin/index/login.html'),(441,0,0,'提示语:验证码输入错误！',1560757609,2130706433,'/admin/index/login.html'),(440,0,0,'提示语:请先登陆',1560757600,2130706433,'/admin/index/index.html'),(439,1,1,'提示语:恭喜您，登陆成功',1560757478,2130706433,'/admin/index/login.html'),(438,0,0,'提示语:验证码输入错误！',1560757471,2130706433,'/admin/index/login.html'),(437,0,0,'提示语:请先登陆',1560757459,2130706433,'/admin/index/index.html'),(436,1,1,'提示语:恭喜您，登陆成功',1560756950,2130706433,'/admin/index/login.html'),(435,0,0,'提示语:请先登陆',1560756939,2130706433,'/admin/index/index.html'),(434,0,0,'提示语:请先登陆',1560756936,2130706433,'/admin/AdPositions/del'),(433,0,1,'提示语:该页面不存在！',1560754145,2130706433,'/admin/AdPositions/delBrand'),(432,0,1,'提示语:该页面不存在！',1560754089,2130706433,'/admin/AdPositions/delBrand'),(431,0,1,'提示语:该页面不存在！',1560753906,2130706433,'/admin/Adpositions/admin/Adpositions/toEdit?id=1&p=1'),(430,0,1,'提示语:该页面不存在！',1560753894,2130706433,'/admin/Adpositions/admin/Adpositions/toedit?id=1&p=1'),(429,1,1,'提示语:编辑成功！',1560752568,2130706433,'/admin/menu/edit.html?id=106'),(428,1,1,'提示语:添加成功！',1560750553,2130706433,'/admin/menu/add.html'),(427,0,1,'提示语:控制器只能是字母',1560750547,2130706433,'/admin/menu/add.html'),(425,0,0,'提示语:验证码输入错误！',1560734169,2130706433,'/admin/index/login.html'),(426,1,1,'提示语:恭喜您，登陆成功',1560734175,2130706433,'/admin/index/login.html'),(424,0,0,'提示语:请先登陆',1560734160,2130706433,'/admin/'),(423,1,1,'提示语:恭喜您，登陆成功',1560564111,2130706433,'/admin/index/login.html'),(422,0,0,'提示语:请先登陆',1560564101,2130706433,'/admin/');

/*Table structure for table `pyg_ads` */

DROP TABLE IF EXISTS `pyg_ads`;

CREATE TABLE `pyg_ads` (
  `adId` int(11) NOT NULL AUTO_INCREMENT COMMENT '广告标识',
  `adPositionId` int(11) NOT NULL COMMENT '广告位置',
  `adFile` varchar(150) NOT NULL COMMENT '广告图片',
  `adName` varchar(150) NOT NULL COMMENT '广告名称',
  `adURL` varchar(150) NOT NULL COMMENT '广告url',
  `adSort` int(11) NOT NULL COMMENT '广告排序',
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '数据删除状态',
  `createTime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`adId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_ads` */

insert  into `pyg_ads`(`adId`,`adPositionId`,`adFile`,`adName`,`adURL`,`adSort`,`dataFlag`,`createTime`) values (16,1,'/uploads/ads/20190531\\62ac4072de30bebd82b7f5fe25bbf42e.png','首页轮播-01','http://tp-mall.com/',1,1,'2019-05-31 09:36:22'),(17,1,'/uploads/ads/20190531\\eb6e5b99d4cc952122056e4a37a68ded.jpg','首页轮播-02','http://tp-mall.com/',2,1,'2019-05-31 09:36:36'),(18,1,'/uploads/ads/20190531\\f3153635faffcf40af8a94002c4c676e.jpg','首页轮播-03','http://tp-mall.com/',3,1,'2019-05-31 09:36:49'),(19,1,'/uploads/ads/20190531\\186cef56c79cd3844d1abf56247aeb28.jpg','首页轮播-04','http://tp-mall.com/',4,1,'2019-05-31 09:37:02'),(20,3,'/uploads/ads/20190617\\476ea268790f3da214380190d8ee6d2e.png','首页有趣区-左侧','http://tp-mall.com/goods-8.html',5,1,'2019-06-17 13:45:48'),(21,4,'/uploads/ads/20190617\\347a4d469bf4a566b64bd5005a36a57b.png','首页-有趣区-好东西-01','http://tp-mall.com/goods-12.html',6,1,'2019-06-17 15:55:31'),(22,4,'/uploads/ads/20190617\\878b4d9a4254b1641dd6cba680a9e735.png','首页-有趣区-好东西-02','http://tp-mall.com/goods-12.html',7,1,'2019-06-17 15:55:57'),(23,1,'/uploads/ads/20190617\\010407ac5d4742c3900e1fd2e84e9eab.jpg','111','11',11,-1,'2019-06-17 16:46:50');

/*Table structure for table `pyg_attachment` */

DROP TABLE IF EXISTS `pyg_attachment`;

CREATE TABLE `pyg_attachment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `name` char(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件名',
  `module` char(15) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模块名，由哪个模块上传的',
  `path` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件路径',
  `thumb` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '缩略图路径',
  `url` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件链接',
  `mime` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `ext` char(4) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'sha1 散列值',
  `driver` varchar(16) CHARACTER SET utf8 NOT NULL DEFAULT 'local' COMMENT '上传驱动',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `listorders` int(5) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='附件表';

/*Data for the table `pyg_attachment` */

/*Table structure for table `pyg_auth_group` */

DROP TABLE IF EXISTS `pyg_auth_group`;

CREATE TABLE `pyg_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL COMMENT '组类型',
  `title` char(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='权限组表';

/*Data for the table `pyg_auth_group` */

insert  into `pyg_auth_group`(`id`,`module`,`type`,`title`,`description`,`status`,`rules`) values (1,'admin',1,'超级管理员','拥有所有权限',1,''),(2,'admin',1,'编辑','编辑',1,'');

/*Table structure for table `pyg_auth_rule` */

DROP TABLE IF EXISTS `pyg_auth_rule`;

CREATE TABLE `pyg_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='规则表';

/*Data for the table `pyg_auth_rule` */

/*Table structure for table `pyg_bank` */

DROP TABLE IF EXISTS `pyg_bank`;

CREATE TABLE `pyg_bank` (
  `bankId` int(11) NOT NULL AUTO_INCREMENT COMMENT '银行标识',
  `bankName` varchar(50) NOT NULL COMMENT '银行名称',
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '数据删除状态',
  `createTime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`bankId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_bank` */

insert  into `pyg_bank`(`bankId`,`bankName`,`dataFlag`,`createTime`) values (3,'中国光大银行',1,'2019-05-27 15:29:44'),(4,'深圳发展银行',1,'2019-05-27 15:29:49'),(5,'交通银行',1,'2019-05-27 15:29:57'),(6,'中兴银行',1,'2019-05-27 15:30:04'),(7,'招商银行',1,'2019-05-27 15:30:08'),(8,'中国人民银行',1,'2019-05-27 15:30:13'),(9,'中国农业银行',1,'2019-05-27 15:30:18'),(10,'中国工商银行',1,'2019-05-27 15:30:22');

/*Table structure for table `pyg_brands` */

DROP TABLE IF EXISTS `pyg_brands`;

CREATE TABLE `pyg_brands` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT COMMENT '品牌标识',
  `brandName` varchar(100) NOT NULL COMMENT '品牌名称',
  `brandImg` varchar(150) NOT NULL COMMENT '品牌Logo',
  `brandDesc` text NOT NULL COMMENT '品牌描述',
  `createTime` datetime NOT NULL COMMENT '创建时间',
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '数据删除状态',
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_brands` */

insert  into `pyg_brands`(`brandId`,`brandName`,`brandImg`,`brandDesc`,`createTime`,`dataFlag`) values (27,'华为','/uploads/goods/20190530\\dec8c559c6851589ab660b863b6119a0.png','华为品牌<br />','2019-05-30 15:37:24',1),(28,'三星','/uploads/goods/20190530\\9579e7b56870328ea0ab81b04e5d0670.png','三星品牌','2019-05-30 15:39:20',1),(29,'苹果','/uploads/goods/20190530\\a97378af8fd446cadb5a79e6404bdc90.png','苹果','2019-05-30 15:48:26',1),(30,'vivo','/uploads/goods/20190530\\a06994f55e98397ed2c9c7d265af77df.jpg','vivo品牌','2019-05-30 15:49:24',1),(31,'oppo','/uploads/goods/20190530\\592bb592ed0ebb92a9aa93defe3ccf64.jpg','oppo手机','2019-05-30 15:50:03',1);

/*Table structure for table `pyg_cache` */

DROP TABLE IF EXISTS `pyg_cache`;

CREATE TABLE `pyg_cache` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` char(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '缓存KEY值',
  `name` char(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '名称',
  `module` char(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模块名称',
  `model` char(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模型名称',
  `action` char(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '方法名',
  `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统',
  PRIMARY KEY (`id`),
  KEY `ckey` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='缓存列队表';

/*Data for the table `pyg_cache` */

insert  into `pyg_cache`(`id`,`key`,`name`,`module`,`model`,`action`,`system`) values (1,'Config','网站配置','admin','Config','config_cache',1),(2,'Menu','后台菜单','admin','Menu','menu_cache',1),(3,'Module','可用模块列表','admin','Module','module_cache',1),(4,'Model','模型列表','admin','Models','model_cache',1),(5,'ModelField','模型字段','admin','ModelField','model_field_cache',1);

/*Table structure for table `pyg_carts` */

DROP TABLE IF EXISTS `pyg_carts`;

CREATE TABLE `pyg_carts` (
  `cartId` int(11) NOT NULL AUTO_INCREMENT COMMENT '购物车标识',
  `userId` int(11) NOT NULL DEFAULT '0' COMMENT '用户标识',
  `isCheck` tinyint(4) NOT NULL DEFAULT '1' COMMENT '购物车是否选中商品',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品标识',
  `goodsSpecId` varchar(200) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0' COMMENT '商品属性组',
  `cartNum` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  PRIMARY KEY (`cartId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pyg_carts` */

/*Table structure for table `pyg_cat_brands` */

DROP TABLE IF EXISTS `pyg_cat_brands`;

CREATE TABLE `pyg_cat_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catId` int(11) DEFAULT NULL COMMENT '分类标识',
  `brandId` int(11) DEFAULT NULL COMMENT '品牌标识',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_cat_brands` */

insert  into `pyg_cat_brands`(`id`,`catId`,`brandId`) values (23,10,5),(24,10,25),(25,11,25),(28,10,26),(29,11,26),(30,12,27),(31,12,28),(32,12,29),(33,12,30),(34,12,31);

/*Table structure for table `pyg_config` */

DROP TABLE IF EXISTS `pyg_config`;

CREATE TABLE `pyg_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置类型',
  `title` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置分组',
  `options` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置项',
  `remark` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text CHARACTER SET utf8 COMMENT '配置值',
  `listorder` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COMMENT='网站配置';

/*Data for the table `pyg_config` */

insert  into `pyg_config`(`id`,`name`,`type`,`title`,`group`,`options`,`remark`,`create_time`,`update_time`,`status`,`value`,`listorder`) values (1,'web_site_icp','text','备案信息','base','','',1551244923,1551244971,1,'',1),(2,'web_site_statistics','textarea','站点代码','base','','',1551244957,1551244957,1,'',100),(3,'mail_type','radio','邮件发送模式','email','1:SMTP\r\n2:Mail','',1553652833,1553652915,1,'1',1),(4,'mail_smtp_host','text','邮件服务器','email','','错误的配置发送邮件会导致服务器超时',1553652889,1553652917,1,'smtp.163.com',2),(5,'mail_smtp_port','text','邮件发送端口','email','','不加密默认25,SSL默认465,TLS默认587',1553653165,1553653292,1,'465',3),(6,'mail_auth','radio','身份认证','email','0:关闭\r\n1:开启','',1553658375,1553658392,1,'1',4),(7,'mail_smtp_user','text','用户名','email','','',1553653267,1553658393,1,'',5),(8,'mail_smtp_pass','text','密码','email','','',1553653344,1553658394,1,'',6),(9,'mail_verify_type','radio','验证方式','email','1:TLS\r\n2:SSL','',1553653426,1553658395,1,'2',7),(10,'mail_from','text','发件人邮箱','email','','',1553653500,1553658397,1,'',8),(11,'config_group','array','配置分组','system','','',1494408414,1494408414,1,'base:基础\r\nemail:邮箱\r\nsystem:系统\r\nupload:上传\r\ndevelop:开发',0),(12,'theme','text','主题风格','system','','',1541752781,1541756888,1,'default',1),(13,'admin_allow_ip','textarea','后台允许访问IP','system','','匹配IP段用\"*\"占位，如192.168.*.*，多个IP地址请用英文逗号\",\"分割',1551244957,1551244957,1,'',2),(14,'upload_image_size','text','图片上传大小限制','upload','','0为不限制大小，单位：kb',1540457656,1552436075,1,'0',2),(15,'upload_image_ext','text','允许上传的图片后缀','upload','','多个后缀用逗号隔开，不填写则不限制类型',1540457657,1552436074,1,'gif,jpg,jpeg,bmp,png',1),(16,'upload_file_size','text','文件上传大小限制','upload','','0为不限制大小，单位：kb',1540457658,1552436078,1,'0',3),(17,'upload_file_ext','text','允许上传的文件后缀','upload','','多个后缀用逗号隔开，不填写则不限制类型',1540457659,1552436080,1,'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,rar,zip,gz,bz2,7z',4),(18,'upload_driver','radio','上传驱动','upload','local:本地','图片或文件上传驱动',1541752781,1552436085,1,'local',9),(19,'upload_thumb_water','switch','添加水印','upload','','',1552435063,1552436080,1,'0',5),(20,'upload_thumb_water_pic','image','水印图片','upload','','只有开启水印功能才生效',1552435183,1552436081,1,'',6),(21,'upload_thumb_water_position','radio','水印位置','upload','1:左上角\r\n2:上居中\r\n3:右上角\r\n4:左居中\r\n5:居中\r\n6:右居中\r\n7:左下角\r\n8:下居中\r\n9:右下角','只有开启水印功能才生效',1552435257,1552436082,1,'9',7),(22,'upload_thumb_water_alpha','text','水印透明度','upload','','请输入0~100之间的数字，数字越小，透明度越高',1552435299,1552436083,1,'50',8);

/*Table structure for table `pyg_express` */

DROP TABLE IF EXISTS `pyg_express`;

CREATE TABLE `pyg_express` (
  `expressId` int(11) NOT NULL AUTO_INCREMENT,
  `expressName` varchar(50) NOT NULL,
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  `expressCode` varchar(50) DEFAULT '',
  PRIMARY KEY (`expressId`),
  KEY `dataFlag` (`dataFlag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_express` */

insert  into `pyg_express`(`expressId`,`expressName`,`dataFlag`,`expressCode`) values (2,'11122',-1,'11111122'),(3,'圆通快递',1,'yt'),(4,'顺丰快递',1,'sf');

/*Table structure for table `pyg_favorites` */

DROP TABLE IF EXISTS `pyg_favorites`;

CREATE TABLE `pyg_favorites` (
  `favoriteId` int(11) NOT NULL AUTO_INCREMENT COMMENT '关注标识',
  `userId` int(11) NOT NULL DEFAULT '0' COMMENT '用户标识',
  `targetId` int(11) NOT NULL COMMENT '商品标识',
  `createTime` datetime DEFAULT NULL COMMENT '关注时间',
  PRIMARY KEY (`favoriteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_favorites` */

/*Table structure for table `pyg_field_type` */

DROP TABLE IF EXISTS `pyg_field_type`;

CREATE TABLE `pyg_field_type` (
  `name` varchar(32) CHARACTER SET utf8 NOT NULL COMMENT '字段类型',
  `title` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '中文类型名',
  `listorder` int(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `default_define` varchar(128) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '默认定义',
  `ifoption` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要设置选项',
  `ifstring` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否自由字符',
  `vrule` varchar(256) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '验证规则',
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='字段类型表';

/*Data for the table `pyg_field_type` */

insert  into `pyg_field_type`(`name`,`title`,`listorder`,`default_define`,`ifoption`,`ifstring`,`vrule`) values ('text','输入框',1,'varchar(255) NOT NULL DEFAULT \'\'',0,1,''),('checkbox','复选框',2,'varchar(32) NOT NULL DEFAULT \'\'',1,0,''),('textarea','多行文本',3,'varchar(255) NOT NULL DEFAULT \'\'',0,1,''),('radio','单选按钮',4,'tinyint(2) UNSIGNED NOT NULL DEFAULT \'0\'',1,0,'isChsAlphaNum'),('switch','开关',5,'tinyint(2) UNSIGNED NOT NULL DEFAULT \'0\'',0,0,'isBool'),('array','数组',6,'varchar(512) NOT NULL DEFAULT \'\'',0,0,''),('select','下拉框',7,'tinyint(2) UNSIGNED NOT NULL DEFAULT \'0\'',1,0,'isChsAlphaNum'),('image','单张图',8,'int(5) UNSIGNED NOT NULL DEFAULT \'0\'',0,0,'isNumber'),('tags','标签',10,'varchar(255) NOT NULL DEFAULT \'\'',0,1,''),('number','数字',11,'int(10) UNSIGNED NOT NULL DEFAULT \'0\'',0,0,'isNumber'),('datetime','日期和时间',12,'int(11) UNSIGNED NOT NULL DEFAULT \'0\'',0,0,''),('Ueditor','百度编辑器',13,'text NOT NULL',0,1,''),('images','多张图',9,'varchar(256) NOT NULL DEFAULT \'\'',0,0,''),('color','颜色值',17,'varchar(7) NOT NULL DEFAULT \'\'',0,0,''),('files','多文件',15,'varchar(255) NOT NULL DEFAULT \'\'',0,0,''),('summernote','简洁编辑器',14,'text NOT NULL',0,1,''),('file','单文件',16,'int(5) UNSIGNED NOT NULL DEFAULT \'0\'',0,0,'isNumber');

/*Table structure for table `pyg_goods` */

DROP TABLE IF EXISTS `pyg_goods`;

CREATE TABLE `pyg_goods` (
  `goodsId` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品标识',
  `goodsSn` varchar(20) DEFAULT NULL COMMENT '商品编号',
  `goodsName` varchar(255) DEFAULT NULL COMMENT '商品名称',
  `goodsImg` varchar(150) DEFAULT NULL COMMENT '商品logo',
  `marketPrice` decimal(11,2) DEFAULT '0.00' COMMENT '商品价格',
  `proPrice` decimal(11,2) DEFAULT '0.00' COMMENT '促销价格',
  `warnStock` int(11) DEFAULT '0' COMMENT '预警库存',
  `goodsStock` int(11) DEFAULT '0' COMMENT '商品库存',
  `goodsUnit` char(10) DEFAULT NULL COMMENT '商品单位',
  `isSale` tinyint(4) DEFAULT '1' COMMENT '商品是否上架',
  `isBest` tinyint(4) DEFAULT '0' COMMENT '商品是否为特价',
  `isHot` tinyint(4) DEFAULT '0' COMMENT '商品是否为热卖',
  `isNew` tinyint(4) DEFAULT '0' COMMENT '商品是否为新品',
  `isRecom` tinyint(4) DEFAULT '0' COMMENT '商品是否推荐',
  `isPro` tinyint(4) DEFAULT '0' COMMENT '商品是否促销',
  `goodsCatIdPath` varchar(255) DEFAULT NULL COMMENT '商品分类路径',
  `goodsCatId` int(11) DEFAULT NULL COMMENT '商品分类标识',
  `brandId` int(11) DEFAULT '0' COMMENT '商品品牌标识',
  `goodsDesc` text COMMENT '商品描述',
  `goodsSerachKeywords` varchar(200) DEFAULT NULL COMMENT '搜索商品关键词',
  `saleNum` int(11) DEFAULT '0' COMMENT '销售数量',
  `saleTime` datetime DEFAULT NULL COMMENT '开售时间',
  `proStartTime` datetime DEFAULT NULL COMMENT '促销开始时间',
  `proEndTime` datetime DEFAULT NULL COMMENT '促销结束时间',
  `visitNum` int(11) DEFAULT '0' COMMENT '访问数量',
  `gallery` text COMMENT '商品相册',
  `dataFlag` tinyint(4) DEFAULT '1' COMMENT '数据删除状态',
  `createTime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`goodsId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_goods` */

insert  into `pyg_goods`(`goodsId`,`goodsSn`,`goodsName`,`goodsImg`,`marketPrice`,`proPrice`,`warnStock`,`goodsStock`,`goodsUnit`,`isSale`,`isBest`,`isHot`,`isNew`,`isRecom`,`isPro`,`goodsCatIdPath`,`goodsCatId`,`brandId`,`goodsDesc`,`goodsSerachKeywords`,`saleNum`,`saleTime`,`proStartTime`,`proEndTime`,`visitNum`,`gallery`,`dataFlag`,`createTime`) values (9,'PYG155920263226796','荣耀20i 3200万AI自拍 超广角三摄 全网通版6GB+64GB 渐变蓝 移动联通电信4G全面屏手机 双卡双待','/uploads/goods/20190530\\26e93b88f7d6cc9a3d7100c9d1c71cd8.jpg','1599.00','599.00',10,100,'100',1,1,1,1,1,1,'12_33_34_',34,27,'<div id=\"activity_header\" style=\"margin:0px;padding:0px;\">\n	<div style=\"margin:0px auto;padding:0px;\">\n		<img id=\"pcarea\" alt=\"\" class=\"\" src=\"https://img13.360buyimg.com/cms/jfs/t28207/227/1658597638/176016/f8b8e685/5ce654eeN727f1864.jpg\" style=\"border:0px;\" border=\"0\" /> \n	</div>\n</div>\n<div id=\"J-detail-content\" style=\"margin:0px;padding:0px;\">\n	<br />\n</div>','荣耀',0,'2019-07-11 15:10:07','2014-00-00 00:00:00','2016-00-00 00:00:00',260,'[\"\\/uploads\\/goods\\/20190530\\\\4d7cf8b1f0fd72c999d781168427ffa6.jpg\",\"\\/uploads\\/goods\\/20190530\\\\36671765f56352506416943e4692c639.jpg\"]',1,'2019-05-30 15:54:04'),(11,'PYG155920471728338','三星 Galaxy S10 8GB+128GB皓玉白（SM-G9730）超感官全视屏骁龙855双卡双待全网通4G游戏手机','/uploads/goods/20190530\\f972ffbde9e64063dd634a172e8f0246.jpg','5999.00','4999.00',10,100,'10',1,1,1,1,1,1,'12_33_34_',34,28,'<div id=\"activity_header\" style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, \"font-size:12px;font-style:normal;font-weight:400;text-align:start;background-color:#FFFFFF;\">\n	<div style=\"margin:0px auto;padding:0px;\">\n		<img id=\"pcarea\" alt=\"\" class=\"\" src=\"https://img13.360buyimg.com/cms/jfs/t28207/227/1658597638/176016/f8b8e685/5ce654eeN727f1864.jpg\" style=\"border:0px;\" border=\"0\" />\n	</div>\n</div>\n<div id=\"J-detail-content\" style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, \"font-size:12px;font-style:normal;font-weight:400;text-align:start;background-color:#FFFFFF;\">\n	<br />\n	<div style=\"margin:0px;padding:0px;text-align:center;\">\n		<img class=\"\" src=\"https://img12.360buyimg.com/cms/jfs/t1/53710/33/218/41145/5cd3a942Ece92bf86/58cec251d8e67ee4.jpg\" style=\"border:0px;\" border=\"0\" /><img class=\"\" src=\"https://img12.360buyimg.com/cms/jfs/t1/47918/7/231/91239/5cd39d27Eb930b445/9adab2b025491386.jpg\" style=\"border:0px;\" border=\"0\" />\n		<div style=\"margin:0px auto;padding:0px;text-align:center;\">\n			<img title=\"s10详情-2_03.jpg\" alt=\"s10详情-2_03.jpg\" class=\"\" src=\"https://img20.360buyimg.com/cms/jfs/t28024/218/1478698582/206982/f7c36254/5ce2167eNb7a4935c.jpg\" style=\"border:0px;\" width=\"750\" height=\"285\" /><img title=\"s10详情-2_03.jpg\" alt=\"s10详情-2_03.jpg\" class=\"\" src=\"https://img20.360buyimg.com/cms/jfs/t1/27454/26/15863/177914/5cb688faEca7491b6/e3ea745399454534.jpg\" style=\"border:0px;\" width=\"750\" height=\"550\" /><img title=\"s10详情-2_04.jpg\" alt=\"s10详情-2_04.jpg\" class=\"\" src=\"https://img30.360buyimg.com/sku/jfs/t1/25262/4/8784/295409/5c79122dEa872645c/a7f86ebe465ba280.jpg\" style=\"border:0px;\" width=\"750\" height=\"836\" /><img title=\"s10详情-2_05.jpg\" alt=\"s10详情-2_05.jpg\" class=\"\" src=\"https://img30.360buyimg.com/sku/jfs/t1/27718/12/8728/299994/5c79122dEb7c88195/84ef52561767c1be.jpg\" style=\"border:0px;\" width=\"750\" height=\"1245\" /><img title=\"s10详情-2_06.jpg\" alt=\"s10详情-2_06.jpg\" class=\"\" src=\"https://img30.360buyimg.com/sku/jfs/t1/23803/38/8642/120314/5c79122bE84fbf24b/100931f6df2befcc.jpg\" style=\"border:0px;\" width=\"750\" height=\"568\" /><img title=\"s10详情-2_07.jpg\" alt=\"s10详情-2_07.jpg\" class=\"\" src=\"https://img30.360buyimg.com/sku/jfs/t1/15480/14/6172/298711/5c79122dE077bb0f0/8c03ad81bfb07cb3.jpg\" style=\"border:0px;\" width=\"750\" height=\"1355\" /><img title=\"s10详情-2_09.jpg\" alt=\"s10详情-2_09.jpg\" class=\"\" src=\"https://img30.360buyimg.com/sku/jfs/t1/16421/20/8761/175148/5c79122cE5452c633/554af6f05ed7b872.jpg\" style=\"border:0px;\" width=\"750\" height=\"782\" /><img title=\"s10详情-2_10.jpg\" alt=\"s10详情-2_10.jpg\" class=\"\" src=\"https://img30.360buyimg.com/sku/jfs/t1/28162/39/8850/234562/5c79122cEe971f780/00578f2c75789143.jpg\" style=\"border:0px;\" width=\"750\" height=\"930\" /><img title=\"三选一00.jpg\" alt=\"三选一00.jpg\" class=\"\" src=\"https://img30.360buyimg.com/cms/jfs/t1/25743/1/13895/77585/5ca1cce0E797f36cb/82cb69837d6c3d68.jpg\" style=\"border:0px;\" width=\"750\" height=\"938\" /><img title=\"三选一00.jpg\" alt=\"三选一00.jpg\" class=\"\" src=\"https://img14.360buyimg.com/cms/jfs/t1/11321/6/12511/345442/5c91dd0dE57d80d8d/f445db308459bf9e.jpg\" style=\"border:0px;\" width=\"750\" height=\"822\" /><img title=\"三选一00.jpg\" alt=\"三选一00.jpg\" class=\"\" src=\"https://img14.360buyimg.com/cms/jfs/t1/30721/20/6814/233064/5c91dd0dE46ed1af4/292e70ebd544b945.jpg\" style=\"border:0px;\" width=\"750\" height=\"668\" /><img title=\"三选一00.jpg\" alt=\"三选一00.jpg\" class=\"\" src=\"https://img11.360buyimg.com/cms/jfs/t1/11084/9/14368/56322/5ca1cce0E590a8f54/0a614c282a40f4a6.jpg\" style=\"border:0px;\" width=\"750\" height=\"645\" /><img title=\"s10详情-2_11.jpg\" alt=\"s10详情-2_11.jpg\" class=\"\" src=\"https://img30.360buyimg.com/sku/jfs/t1/26822/40/8737/293209/5c79122dE11614f93/c274711666c54338.jpg\" style=\"border:0px;\" width=\"750\" height=\"757\" /><img title=\"s10详情-2_12.jpg\" alt=\"s10详情-2_12.jpg\" class=\"\" src=\"https://img30.360buyimg.com/sku/jfs/t1/25282/12/8666/265774/5c79122dEbe612e9e/5287305fdebfab61.jpg\" style=\"border:0px;\" width=\"750\" height=\"712\" /><img title=\"s10详情-2_13.jpg\" alt=\"s10详情-2_13.jpg\" class=\"\" src=\"https://img30.360buyimg.com/sku/jfs/t1/30533/20/3929/293263/5c79122dEbf0e0aa4/9003e91b76b3b71e.jpg\" style=\"border:0px;\" width=\"750\" height=\"907\" />\n		</div>\n	</div>\n</div>','三星',0,'2019-07-11 15:08:01','2012-00-00 00:00:00','2014-00-00 00:00:00',176,'[\"\\/uploads\\/goods\\/20190530\\\\5ac2ed44da46a4572509edf57406c7ba.jpg\",\"\\/uploads\\/goods\\/20190530\\\\7d78fde251bbd5c82967803f754087da.jpg\"]',1,'2019-05-30 16:26:13'),(12,'PYG155920478149551','OPPO K3 高通骁龙710 升降摄像头 VOOC闪充 6GB+64GB 星云紫 全网通4G 全面屏拍照游戏智能手机','/uploads/goods/20190530\\92d9ac6992c3f0721ff934785071e02c.jpg','1599.00','599.00',100,100,'100',1,1,1,1,1,1,'12_33_34_',34,31,'<div id=\"activity_header\" style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, \"font-size:12px;font-style:normal;font-weight:400;text-align:start;background-color:#FFFFFF;\">\n	<div style=\"margin:0px;padding:0px;text-align:center;\">\n		<img alt=\"\" class=\"\" src=\"https://img13.360buyimg.com/cms/jfs/t1/78707/1/578/203283/5cec9859E3d9d172c/64d54342e6f5d6b9.jpg\" style=\"border:0px;\" width=\"750\" height=\"602\" border=\"0\" />\n	</div>\n</div>\n<div id=\"J-detail-content\" style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, \"font-size:12px;font-style:normal;font-weight:400;text-align:start;background-color:#FFFFFF;\">\n	<br />\n	<div style=\"margin:0px auto;padding:0px;\">\n		<img class=\"\" src=\"https://img14.360buyimg.com/cms/jfs/t1/56983/37/663/49785/5ce53f04Ef630c46c/fffcc4346f21e46d.jpg\" style=\"border:0px;\" /><img class=\"\" src=\"https://img12.360buyimg.com/cms/jfs/t30019/304/1615234858/138044/f7587d3d/5ce53f04Ndaad0e29.jpg\" style=\"border:0px;\" /><img class=\"\" src=\"https://img20.360buyimg.com/cms/jfs/t1/69230/12/728/93036/5cef3dc1E425196e5/bf2d4aedd8d5f309.jpg\" style=\"border:0px;\" /><img class=\"\" src=\"https://img11.360buyimg.com/cms/jfs/t1/44038/19/5396/962154/5cef3dd4E019d391a/5a91b77fc333e84a.jpg\" style=\"border:0px;\" /><img class=\"\" src=\"https://img12.360buyimg.com/cms/jfs/t1/47906/38/1159/520798/5cef3dd4E70ff44d1/81b71ec68b966040.jpg\" style=\"border:0px;\" /><img class=\"\" src=\"https://img11.360buyimg.com/cms/jfs/t28168/235/1572865247/265372/1fabad7d/5ce53f05Nbb864d9b.jpg\" style=\"border:0px;\" /><img class=\"\" src=\"https://img11.360buyimg.com/cms/jfs/t1/45917/23/743/65376/5ce7445bE420ab0ff/91664bb4b4d0163b.jpg\" style=\"border:0px;\" />\n	</div>\n</div>','OPPO',0,'2019-07-11 15:10:56','2016-00-00 00:00:00','2018-00-00 00:00:00',97,'[\"\\/uploads\\/goods\\/20190530\\\\779db2ce8309684f9b0c9ebb35df5df2.jpg\",\"\\/uploads\\/goods\\/20190530\\\\b695075c8a2debe877c0a329c5ff9f63.jpg\",\"\\/uploads\\/goods\\/20190531\\\\187d5e440d78d68d662b9956168ff10a.jpg\"]',1,'2019-05-30 16:27:49'),(14,'PYG155920146726756','华为 HUAWEI P30 超感光徕卡三摄麒麟980AI智能芯片全面屏屏内指纹版手机8GB+128GB亮黑色全网通双4G手机','/uploads/goods/20190530\\169e891c93641d61a0849769eeb16204.jpg','4288.00','3288.00',10,100,'100',1,1,1,1,1,1,'12_33_34_',34,27,'<div id=\"activity_header\" style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, \"font-size:12px;font-style:normal;font-weight:400;text-align:start;background-color:#FFFFFF;\">\n	<div style=\"margin:0px auto;padding:0px;\">\n		<img id=\"pcarea\" alt=\"\" class=\"\" src=\"https://img13.360buyimg.com/cms/jfs/t28207/227/1658597638/176016/f8b8e685/5ce654eeN727f1864.jpg\" style=\"border:0px;\" border=\"0\" />\n	</div>\n</div>\n<div id=\"J-detail-content\" style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, \"font-size:12px;font-style:normal;font-weight:400;text-align:start;background-color:#FFFFFF;\">\n	<br />\n	<div style=\"margin:0px;padding:0px;text-align:center;\">\n		<img class=\"\" src=\"https://img20.360buyimg.com/vc/jfs/t1/33439/26/2361/571730/5cadd0d9E7807e2a2/cef07417934994d9.jpg\" style=\"border:0px;\" /><span>&nbsp;</span><img class=\"\" src=\"https://img20.360buyimg.com/vc/jfs/t1/36403/9/5981/4667392/5cc17b58E75c1b2d8/19f52d37e5813053.jpg\" style=\"border:0px;\" />\n	</div>\n</div>','华为 荣耀',0,'2019-07-11 15:08:27','2012-00-00 00:00:00','2014-00-00 00:00:00',212,'[\"\\/uploads\\/goods\\/20190530\\\\f0dcf58ec2a072bb340d8c97336cab24.jpg\",\"\\/uploads\\/goods\\/20190530\\\\84f747ab61a52999b02df5eeb4a16421.jpg\"]',1,'2019-05-30 15:33:55'),(16,'PYG155920461059009','Apple iPhone XR (A2107) 64GB 黑色 全网通（移动4G优先版） 双卡双待','/uploads/goods/20190530\\f0aed7555f7b616d10bb76a434229623.jpg','4799.00','3799.00',10,100,'100',1,1,1,1,1,1,'12_33_34_',34,29,'<div id=\"activity_header\" style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, \"font-size:12px;font-style:normal;font-weight:400;text-align:start;background-color:#FFFFFF;\">\n	<div style=\"margin:0px;padding:0px;\" align=\"center\">\n		<a href=\"https://pro.jd.com/mall/active/7u6vy2G5KWg3wAjBXHgPb9g1YC8/index.html\"><img alt=\"\" class=\"\" src=\"https://img30.360buyimg.com/jgsq-productsoa/jfs/t28075/27/1290865836/113685/272b0fd1/5cdcc3d5Ne8512572.jpg\" style=\"border:0px;\" /></a><br />\n	</div>\n	<div style=\"margin:0px;padding:0px;text-align:center;\">\n		<a href=\"https://sale.jd.com/act/XpbwM0G1ZaW.html\" target=\"_blank\"><img alt=\"\" class=\"\" src=\"https://img11.360buyimg.com/cms/jfs/t29689/168/287401247/104423/c65e1143/5bee7fa4N7edaddfd.jpg\" style=\"border:0px;\" /></a><br />\n	</div>\n	<div style=\"margin:0px auto;padding:0px;\">\n		<img id=\"pcarea\" alt=\"\" class=\"\" src=\"https://img13.360buyimg.com/cms/jfs/t28207/227/1658597638/176016/f8b8e685/5ce654eeN727f1864.jpg\" style=\"border:0px;\" border=\"0\" />\n	</div>\n</div>\n<div id=\"J-detail-content\" style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, \"font-size:12px;font-style:normal;font-weight:400;text-align:start;background-color:#FFFFFF;\">\n	<br />\n	<div style=\"margin:0px auto;padding:0px;\">\n		<img class=\"\" src=\"https://img11.360buyimg.com/cms/jfs/t1/26780/29/3893/222796/5c2c8489Ecf534b26/51ff2992ad246922.jpg\" style=\"border:0px;\" />\n	</div>\n	<div style=\"margin:0px;padding:0px;text-align:center;\">\n		<img alt=\"\" class=\"\" src=\"https://img12.360buyimg.com/cms/jfs/t1/24368/22/12685/45440/5c99cb37Ef8841295/2e5cb9b82f22294b.jpg\" style=\"border:0px;\" width=\"640\" />\n	</div>\n	<div style=\"margin:0px;padding:0px;\" align=\"center\">\n		<table id=\"__01\" style=\"text-align:center;\" class=\"ke-zeroborder\" width=\"750\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n			<tbody>\n				<tr>\n					<td>\n						<img alt=\"\" class=\"\" src=\"https://img14.360buyimg.com/cms/jfs/t1/3232/17/3505/166696/5b997bf1E382f4a2c/b9854b5b9a9fc950.jpg\" style=\"border:0px;\" width=\"750\" height=\"2650\" />\n					</td>\n				</tr>\n				<tr>\n					<td>\n						<img alt=\"\" class=\"\" src=\"https://img14.360buyimg.com/cms/jfs/t1/367/12/3793/205864/5b997bf2E833e701a/0b7d6a51a5ff0781.jpg\" style=\"border:0px;\" width=\"750\" height=\"2204\" />\n					</td>\n				</tr>\n				<tr>\n					<td>\n						<img alt=\"\" class=\"\" src=\"https://img14.360buyimg.com/cms/jfs/t1/5501/9/3441/151755/5b997bf1E4ba7648e/3a3e32f714518dbd.jpg\" style=\"border:0px;\" width=\"750\" height=\"2191\" />\n					</td>\n				</tr>\n			</tbody>\n		</table>\n		<table id=\"__01\" style=\"text-align:center;\" class=\"ke-zeroborder\" width=\"750\" height=\"8220\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n			<tbody>\n				<tr>\n					<td>\n						<img alt=\"\" class=\"\" src=\"https://img11.360buyimg.com/cms/jfs/t1/5544/7/3467/204032/5b997bf1Ef261a506/4d26ef3e87b3f2ea.jpg\" style=\"border:0px;\" width=\"750\" height=\"2412\" />\n					</td>\n				</tr>\n				<tr>\n					<td>\n						<img alt=\"\" class=\"\" src=\"https://img12.360buyimg.com/cms/jfs/t1/3696/36/3551/277359/5b997bf3E275ead32/1d7e44a3d89e6481.jpg\" style=\"border:0px;\" width=\"750\" height=\"2940\" />\n					</td>\n				</tr>\n				<tr>\n					<td>\n						<img alt=\"\" class=\"\" src=\"https://img10.360buyimg.com/cms/jfs/t1/1945/18/3506/251218/5b997bf1E37d9c81a/547cc640769db529.jpg\" style=\"border:0px;\" width=\"750\" height=\"2868\" />\n					</td>\n				</tr>\n				<tr>\n					<td>\n						<img alt=\"\" class=\"\" src=\"https://img11.360buyimg.com/cms/jfs/t1/3420/36/3470/259958/5b997bf2Ecb379dee/0fbd42fb5bb58863.jpg\" style=\"border:0px;\" width=\"750\" height=\"2111\" />\n					</td>\n				</tr>\n				<tr>\n					<td>\n						<img alt=\"\" class=\"\" src=\"https://img14.360buyimg.com/cms/jfs/t1/2845/28/3446/160770/5b997bf1Ebad77223/c04b8bd70ff56d06.jpg\" style=\"border:0px;\" width=\"750\" height=\"1751\" />\n					</td>\n				</tr>\n				<tr>\n					<td>\n						<img alt=\"\" class=\"\" src=\"https://img20.360buyimg.com/cms/jfs/t1/2619/21/3617/278630/5b997bf2Efd504b88/9ce7ff617a41d7cd.jpg\" style=\"border:0px;\" width=\"750\" height=\"2608\" />\n					</td>\n				</tr>\n			</tbody>\n		</table>\n	</div>\n</div>','Apple',0,'2019-07-12 10:36:33','2019-07-12 12:00:00','2019-07-12 14:00:00',96,'[\"\\/uploads\\/goods\\/20190530\\\\65835c145012a5b911cd7e780bca4bc7.jpg\",\"\\/uploads\\/goods\\/20190530\\\\8672f09b72fb1ca68855d3db0f69fc01.jpg\"]',1,'2019-05-30 16:24:57');

/*Table structure for table `pyg_goods_appraises` */

DROP TABLE IF EXISTS `pyg_goods_appraises`;

CREATE TABLE `pyg_goods_appraises` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评价标识',
  `orderId` int(11) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `goodsId` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `userId` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `goodsScore` int(11) NOT NULL DEFAULT '0' COMMENT '商品评分',
  `serviceScore` int(11) NOT NULL DEFAULT '0' COMMENT '服务评分',
  `timeScore` int(11) NOT NULL DEFAULT '0' COMMENT '时效评分',
  `content` text NOT NULL COMMENT '评论内容',
  `shopReply` text COMMENT '回复内容',
  `isShow` tinyint(4) DEFAULT '1' COMMENT '是否显示 2 显示',
  `dataFlag` tinyint(4) DEFAULT '1' COMMENT '数据状态',
  `createTime` datetime DEFAULT NULL COMMENT '评论时间',
  `replyTime` datetime DEFAULT NULL COMMENT '回复时间',
  `orderGoodsId` int(10) DEFAULT NULL COMMENT '订单商品表Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_goods_appraises` */

insert  into `pyg_goods_appraises`(`id`,`orderId`,`goodsId`,`userId`,`goodsScore`,`serviceScore`,`timeScore`,`content`,`shopReply`,`isShow`,`dataFlag`,`createTime`,`replyTime`,`orderGoodsId`) values (4,69,12,16,5,3,3,'44444',NULL,1,1,'2019-07-19 15:01:57',NULL,NULL);

/*Table structure for table `pyg_goods_cats` */

DROP TABLE IF EXISTS `pyg_goods_cats`;

CREATE TABLE `pyg_goods_cats` (
  `catId` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类标识',
  `parentId` int(11) NOT NULL COMMENT '父级分类',
  `catName` varchar(20) NOT NULL COMMENT '分类名称',
  `isShow` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `catSort` int(11) NOT NULL DEFAULT '0' COMMENT '分类排序',
  `dataFlag` tinyint(11) NOT NULL DEFAULT '1' COMMENT '数据删除状态',
  `createTime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`catId`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_goods_cats` */

insert  into `pyg_goods_cats`(`catId`,`parentId`,`catName`,`isShow`,`catSort`,`dataFlag`,`createTime`) values (10,0,'图书、音像、数字商品',1,1,1,'2019-05-21 11:25:39'),(11,0,'家用电器',1,2,1,'2019-05-21 11:31:17'),(12,0,'手机、数码',1,3,1,'2019-05-21 11:31:23'),(13,0,'电脑、办公',1,4,1,'2019-05-21 11:31:32'),(14,0,'家居、家具、家装、厨具',1,5,1,'2019-05-21 11:31:40'),(15,0,'服饰内衣',1,6,1,'2019-05-21 11:32:32'),(16,0,'个护化妆',1,7,1,'2019-05-21 11:32:46'),(17,0,'运动健康',1,8,1,'2019-05-21 11:32:53'),(18,0,'汽车用品',1,9,1,'2019-05-21 11:32:59'),(19,0,'彩票、旅行',1,10,1,'2019-05-21 11:33:06'),(20,0,'理财、众筹',1,11,1,'2019-05-21 11:33:13'),(21,0,'母婴、玩具',1,12,1,'2019-05-21 11:33:19'),(22,0,'箱包',1,13,1,'2019-05-21 11:33:26'),(23,0,'运动户外',1,14,1,'2019-05-21 11:33:32'),(24,23,'电子书',1,1,-1,'2019-05-21 11:34:34'),(25,10,'电子书',1,1,1,'2019-05-21 11:35:32'),(26,25,'文学',1,1,1,'2019-05-21 11:35:50'),(27,25,'经管',1,1,1,'2019-05-21 11:36:04'),(28,10,'畅读VIP',1,1,-1,'2019-05-30 14:41:07'),(29,25,'畅读VIP',1,1,1,'2019-05-30 14:41:35'),(30,10,'数字音乐',1,1,1,'2019-05-30 14:42:02'),(31,30,'古典音乐',1,1,1,'2019-05-30 14:42:11'),(32,30,'通俗流行',1,1,1,'2019-05-30 14:42:45'),(33,12,'手机通讯',1,1,1,'2019-05-31 11:09:47'),(34,33,'手机',1,1,1,'2019-05-31 11:10:01'),(35,33,'游戏手机',1,1,1,'2019-05-31 11:10:14');

/*Table structure for table `pyg_history` */

DROP TABLE IF EXISTS `pyg_history`;

CREATE TABLE `pyg_history` (
  `historyId` int(11) NOT NULL AUTO_INCREMENT COMMENT '浏览历史标识',
  `userId` int(11) NOT NULL DEFAULT '0' COMMENT '用户标识',
  `targetId` int(11) NOT NULL COMMENT '商品标识',
  `score` int(11) DEFAULT '1' COMMENT '浏览次数',
  `createTime` datetime DEFAULT NULL COMMENT '浏览时间',
  PRIMARY KEY (`historyId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_history` */

insert  into `pyg_history`(`historyId`,`userId`,`targetId`,`score`,`createTime`) values (1,16,9,12,'2019-06-25 14:52:23'),(6,16,14,61,'2019-06-25 15:05:37'),(7,16,11,37,'2019-06-25 15:24:03'),(8,0,9,1,'2019-06-25 15:44:13'),(9,0,11,6,'2019-06-27 11:14:46'),(10,16,12,8,'2019-07-01 16:07:59'),(11,0,12,1,'2019-07-05 10:08:35'),(12,0,14,1,'2019-07-17 16:21:36');

/*Table structure for table `pyg_hooks` */

DROP TABLE IF EXISTS `pyg_hooks`;

CREATE TABLE `pyg_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text CHARACTER SET utf8 NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `modules` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '钩子挂载的模块 ''，''分割',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否系统',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='插件和模块钩子';

/*Data for the table `pyg_hooks` */

insert  into `pyg_hooks`(`id`,`name`,`description`,`type`,`update_time`,`addons`,`modules`,`system`,`status`) values (1,'pageHeader','页面header钩子，一般用于加载插件CSS文件和代码',1,1509174020,'','',1,1),(2,'pageFooter','页面footer钩子，一般用于加载插件JS文件和JS代码',1,1509174020,'','',1,1),(3,'smsGet','短信获取行为',2,1509174020,'','',1,1),(4,'smsSend','短信发送行为',2,1509174020,'','',1,1),(5,'smsNotice','短信发送通知',2,1509174020,'','',1,1),(6,'smsCheck','检测短信验证是否正确',2,1509174020,'','',1,1),(7,'smsFlush','清空短信验证行为',2,1509174020,'','',1,1),(8,'emsGet','邮件获取行为',2,1509174020,'','',1,1),(9,'emsSend','邮件发送行为',2,1509174020,'','',1,1),(10,'emsNotice','邮件发送通知',2,1509174020,'','',1,1),(11,'emsCheck','检测邮件验证是否正确',2,1509174020,'','',1,1),(12,'emsFlush','清空邮件验证行为',2,1509174020,'','',1,1);

/*Table structure for table `pyg_inform` */

DROP TABLE IF EXISTS `pyg_inform`;

CREATE TABLE `pyg_inform` (
  `informId` int(11) NOT NULL AUTO_INCREMENT,
  `informTargetId` int(11) NOT NULL,
  `goodId` int(11) NOT NULL,
  `informType` int(11) NOT NULL DEFAULT '1',
  `informContent` text,
  `informTime` datetime NOT NULL,
  `informStatus` tinyint(4) NOT NULL,
  `respondContent` text,
  `finalHandleTime` datetime DEFAULT NULL,
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`informId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `pyg_inform` */

insert  into `pyg_inform`(`informId`,`informTargetId`,`goodId`,`informType`,`informContent`,`informTime`,`informStatus`,`respondContent`,`finalHandleTime`,`dataFlag`) values (3,16,11,1,'哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇哇','2019-07-16 11:15:53',1,'1111','2019-07-16 17:49:41',1),(4,16,12,1,'33333','2019-07-19 10:27:55',0,NULL,NULL,1),(5,16,14,2,'1111','2019-07-19 10:36:13',0,NULL,NULL,1);

/*Table structure for table `pyg_integral_config` */

DROP TABLE IF EXISTS `pyg_integral_config`;

CREATE TABLE `pyg_integral_config` (
  `configId` int(11) NOT NULL AUTO_INCREMENT,
  `integralProportion` int(11) DEFAULT NULL COMMENT '积分抵用比例',
  `minimumPoints` int(11) DEFAULT NULL COMMENT '签到奖励最低积分',
  `highestPoints` int(11) DEFAULT NULL COMMENT '签到奖励最高积分',
  PRIMARY KEY (`configId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_integral_config` */

insert  into `pyg_integral_config`(`configId`,`integralProportion`,`minimumPoints`,`highestPoints`) values (2,2,1,5);

/*Table structure for table `pyg_log_orders` */

DROP TABLE IF EXISTS `pyg_log_orders`;

CREATE TABLE `pyg_log_orders` (
  `logId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL DEFAULT '0' COMMENT '订单标识',
  `orderStatus` int(11) NOT NULL COMMENT '订单状态',
  `logContent` varchar(255) NOT NULL COMMENT '订单日志内容',
  `logUserId` int(11) NOT NULL DEFAULT '0' COMMENT '用户标识',
  `logType` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订单类型',
  `logTime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`logId`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_log_orders` */

insert  into `pyg_log_orders`(`logId`,`orderId`,`orderStatus`,`logContent`,`logUserId`,`logType`,`logTime`) values (1,49,0,'下单成功',16,0,'2019-06-10 14:52:21'),(2,50,0,'下单成功',16,0,'2019-06-10 15:14:45'),(3,51,0,'下单成功',16,0,'2019-06-10 15:24:24'),(4,52,-2,'下单成功，等待用户支付',16,0,'2019-06-10 15:30:19'),(5,52,0,'订单已支付，下单成功',16,0,'2019-06-10 15:30:19'),(6,53,-2,'下单成功，等待用户支付',16,0,'2019-06-10 15:50:12'),(7,53,0,'订单已支付，下单成功',16,0,'2019-06-10 15:50:12'),(8,54,0,'下单成功',16,0,'2019-06-10 15:53:36'),(9,55,-2,'下单成功，等待用户支付',16,0,'2019-06-10 15:54:46'),(10,55,0,'订单已支付，下单成功',16,0,'2019-06-10 15:54:46'),(16,59,0,'下单成功',16,0,'2019-06-10 19:36:47'),(17,60,-2,'下单成功，等待用户支付',16,0,'2019-06-11 10:15:22'),(18,60,0,'订单已支付，下单成功',16,0,'2019-06-11 10:15:22'),(19,61,-2,'下单成功，等待用户支付',16,0,'2019-06-11 10:41:20'),(20,61,0,'订单已支付，下单成功',16,0,'2019-06-11 10:41:20'),(21,61,0,'下单成功',16,0,'2019-07-01 15:59:52'),(22,62,0,'下单成功',16,0,'2019-07-01 16:08:09'),(23,63,0,'下单成功',16,0,'2019-07-01 16:54:53'),(24,64,0,'下单成功',16,0,'2019-07-01 17:49:41'),(25,65,-2,'下单成功，等待用户支付',16,0,'2019-07-19 09:41:29'),(26,65,0,'订单已支付，下单成功',16,0,'2019-07-19 09:41:29'),(27,66,0,'下单成功',16,0,'2019-07-19 10:04:21'),(28,67,0,'下单成功',16,0,'2019-07-19 10:13:06'),(29,68,-2,'下单成功，等待用户支付',16,0,'2019-07-19 10:13:15'),(30,68,0,'订单已支付，下单成功',16,0,'2019-07-19 10:13:15'),(31,69,0,'下单成功',16,0,'2019-07-19 10:16:40'),(32,70,-2,'下单成功，等待用户支付',16,0,'2019-07-19 10:16:52'),(33,70,0,'订单已支付，下单成功',16,0,'2019-07-19 10:16:52'),(34,71,-2,'下单成功，等待用户支付',16,0,'2019-07-19 10:17:35'),(35,71,0,'订单已支付，下单成功',16,0,'2019-07-19 10:17:35');

/*Table structure for table `pyg_log_user_logins` */

DROP TABLE IF EXISTS `pyg_log_user_logins`;

CREATE TABLE `pyg_log_user_logins` (
  `loginId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户标识',
  `loginTime` datetime NOT NULL COMMENT '用户登陆时间',
  `loginIp` varchar(16) NOT NULL COMMENT '用户登陆IP',
  `loginSrc` tinyint(3) DEFAULT '0' COMMENT '用户登陆回调地址',
  `loginRemark` varchar(30) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`loginId`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_log_user_logins` */

insert  into `pyg_log_user_logins`(`loginId`,`userId`,`loginTime`,`loginIp`,`loginSrc`,`loginRemark`) values (2,10,'2019-05-30 12:27:08','127.0.0.1',0,NULL),(3,11,'2019-05-30 12:28:26','127.0.0.1',0,NULL),(4,12,'2019-05-30 12:29:01','127.0.0.1',0,NULL),(5,13,'2019-05-30 12:31:38','127.0.0.1',0,NULL),(6,14,'2019-05-30 12:52:30','127.0.0.1',0,NULL),(7,15,'2019-05-30 13:27:22','127.0.0.1',0,NULL),(8,16,'2019-05-30 13:33:56','127.0.0.1',0,NULL),(9,16,'2019-05-30 13:37:54','127.0.0.1',0,NULL),(10,16,'2019-06-03 11:23:08','127.0.0.1',0,NULL),(11,16,'2019-06-03 11:26:53','127.0.0.1',0,NULL),(12,16,'2019-06-03 11:28:17','127.0.0.1',0,NULL),(13,16,'2019-06-03 11:30:50','127.0.0.1',0,NULL),(14,16,'2019-06-03 11:31:37','127.0.0.1',0,NULL),(15,16,'2019-06-03 11:32:43','127.0.0.1',0,NULL),(16,16,'2019-06-03 11:33:34','127.0.0.1',0,NULL),(17,16,'2019-06-03 12:09:41','127.0.0.1',0,NULL),(18,16,'2019-06-03 12:10:12','127.0.0.1',0,NULL),(19,16,'2019-06-03 12:11:10','127.0.0.1',0,NULL),(20,16,'2019-06-03 13:44:33','127.0.0.1',0,NULL),(21,16,'2019-06-03 15:07:37','127.0.0.1',0,NULL),(22,16,'2019-06-04 09:00:05','127.0.0.1',0,NULL),(23,16,'2019-06-04 11:20:52','127.0.0.1',0,NULL),(24,16,'2019-06-04 17:04:05','127.0.0.1',0,NULL),(25,16,'2019-06-05 09:31:43','127.0.0.1',0,NULL),(26,16,'2019-06-05 14:28:55','127.0.0.1',0,NULL),(27,16,'2019-06-06 09:31:05','127.0.0.1',0,NULL),(28,16,'2019-06-10 09:56:40','127.0.0.1',0,NULL),(29,16,'2019-06-10 09:57:49','127.0.0.1',0,NULL),(30,16,'2019-06-10 09:58:16','127.0.0.1',0,NULL),(31,16,'2019-06-10 10:07:26','127.0.0.1',0,NULL),(32,16,'2019-06-10 10:42:37','127.0.0.1',0,NULL),(33,16,'2019-06-11 09:16:29','127.0.0.1',0,NULL),(34,16,'2019-06-11 17:01:41','127.0.0.1',0,NULL),(35,16,'2019-06-13 09:21:09','127.0.0.1',0,NULL),(36,16,'2019-06-13 11:34:13','127.0.0.1',0,NULL),(37,16,'2019-06-14 10:30:28','127.0.0.1',0,NULL),(38,16,'2019-06-17 17:29:11','127.0.0.1',0,NULL),(39,16,'2019-06-18 09:17:18','127.0.0.1',0,NULL),(40,16,'2019-06-19 10:09:11','127.0.0.1',0,NULL),(41,16,'2019-06-19 11:14:39','127.0.0.1',0,NULL),(42,16,'2019-06-24 13:19:23','127.0.0.1',0,NULL),(43,16,'2019-06-24 13:23:13','127.0.0.1',0,NULL),(44,16,'2019-06-25 09:39:55','127.0.0.1',0,NULL),(45,16,'2019-06-25 14:22:22','127.0.0.1',0,NULL),(46,16,'2019-06-25 18:26:01','127.0.0.1',0,NULL),(47,16,'2019-06-27 14:17:12','127.0.0.1',0,NULL),(48,16,'2019-07-01 15:13:35','127.0.0.1',0,NULL),(49,16,'2019-07-02 09:36:22','127.0.0.1',0,NULL),(50,16,'2019-07-02 14:11:53','127.0.0.1',0,NULL),(51,16,'2019-07-02 14:43:17','127.0.0.1',0,NULL),(52,16,'2019-07-02 15:32:02','127.0.0.1',0,NULL),(53,16,'2019-07-04 08:32:59','127.0.0.1',0,NULL),(54,16,'2019-07-04 10:41:36','127.0.0.1',0,NULL),(55,16,'2019-07-04 14:12:01','127.0.0.1',0,NULL),(56,16,'2019-07-05 10:16:09','127.0.0.1',0,NULL),(57,16,'2019-07-10 10:46:38','127.0.0.1',0,NULL),(58,16,'2019-07-11 09:12:17','127.0.0.1',0,NULL),(59,16,'2019-07-12 14:22:48','127.0.0.1',0,NULL),(60,16,'2019-07-16 10:06:20','127.0.0.1',0,NULL),(61,16,'2019-07-16 13:58:54','127.0.0.1',0,NULL),(62,16,'2019-07-16 15:43:56','127.0.0.1',0,NULL),(63,16,'2019-07-16 17:50:08','127.0.0.1',0,NULL),(64,16,'2019-07-17 09:02:50','127.0.0.1',0,NULL),(65,16,'2019-07-17 09:49:37','127.0.0.1',0,NULL),(66,16,'2019-07-17 15:42:26','127.0.0.1',0,NULL),(67,16,'2019-07-18 09:50:31','127.0.0.1',0,NULL),(68,16,'2019-07-18 14:20:45','127.0.0.1',0,NULL),(69,16,'2019-07-18 16:57:06','127.0.0.1',0,NULL),(70,16,'2019-07-19 09:32:09','127.0.0.1',0,NULL),(71,16,'2019-07-22 14:06:20','127.0.0.1',0,NULL),(72,16,'2019-07-24 11:42:02','127.0.0.1',0,NULL),(73,16,'2019-07-24 14:05:10','127.0.0.1',0,NULL);

/*Table structure for table `pyg_menu` */

DROP TABLE IF EXISTS `pyg_menu`;

CREATE TABLE `pyg_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `title` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '标题',
  `icon` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '图标',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `app` char(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '应用标识',
  `controller` char(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '控制器标识',
  `action` char(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '方法标识',
  `parameter` char(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '附加参数',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `tip` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '提示',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否开发者可见',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID',
  PRIMARY KEY (`id`),
  KEY `pid` (`parentid`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COMMENT='后台菜单表';

/*Data for the table `pyg_menu` */

insert  into `pyg_menu`(`id`,`title`,`icon`,`parentid`,`app`,`controller`,`action`,`parameter`,`status`,`tip`,`is_dev`,`listorder`) values (1,'首页','',0,'admin','index','index','',0,'',0,0),(2,'控制面板','',0,'admin','main','index','',0,'',0,1),(3,'平台','',0,'admin','setting','index','',1,'',0,0),(4,'商城','',0,'admin','module','index','',1,'',0,9),(5,'运营','',0,'addons','addons','index','',1,'',0,10),(10,'系统配置','',3,'admin','config','index1','',1,'',0,0),(11,'配置管理','',10,'admin','config','index','',1,'',0,0),(12,'删除日志','',20,'admin','adminlog','deletelog','',1,'',0,0),(13,'网站设置','',10,'admin','config','setting','',1,'',0,0),(14,'菜单管理','',10,'admin','menu','index','',1,'',0,0),(15,'权限管理','',3,'admin','manager','index1','',1,'',0,0),(16,'管理员管理','',15,'admin','manager','index','',1,'',0,0),(17,'角色管理','',15,'admin','authManager','index','',1,'',0,0),(18,'添加管理员','',16,'admin','manager','add','',1,'',0,0),(19,'编辑管理员','',16,'admin','manager','edit','',1,'',0,0),(20,'管理日志','',15,'admin','adminlog','index','',1,'',0,0),(21,'删除管理员','',16,'admin','manager','del','',1,'',0,0),(22,'添加角色','',17,'admin','authManager','createGroup','',1,'',0,0),(23,'附件管理','',10,'attachment','attachments','index','',1,'',0,1),(24,'新增配置','',11,'admin','config','add','',1,'',0,1),(25,'编辑配置','',11,'admin','config','edit','',1,'',0,2),(26,'删除配置','',11,'admin','config','del','',1,'',0,3),(27,'新增菜单','',14,'admin','menu','add','',1,'',0,0),(28,'编辑菜单','',14,'admin','menu','edit','',1,'',0,0),(29,'删除菜单','',14,'admin','menu','delete','',1,'',0,0),(30,'附件上传','',23,'attachment','attachments','upload','',1,'',0,0),(31,'附件删除','',23,'attachment','attachments','delete','',1,'',0,0),(32,'编辑器附件','',23,'attachment','ueditor','run','',0,'',0,0),(33,'图片列表','',23,'attachment','attachments','showFileLis','',0,'',0,0),(34,'图片本地化','',23,'attachment','attachments','getUrlFile','',0,'',0,0),(58,'推荐管理','',5,'tuijian','tuijian','index','',1,'',0,0),(106,'广告位置','',77,'admin','adpositions','index','',1,'',0,0),(60,'商品推荐','',58,'tuijian','tuijian','index','',1,'',0,0),(56,'营销管理','',5,'qq','aa','dex','',1,'',0,0),(66,'销售订单统计','',62,'idnex','idnex','idnex','',1,'',0,0),(61,'品牌推荐','',58,'tuijian','tuijian','index','',1,'',0,0),(62,'统计报表','',5,'idnex','idnex','idnex','',1,'',0,0),(63,'商品销售排行','',62,'idnex','idnex','idnex','',1,'',0,0),(64,'店铺销售排行','',62,'idnex','idnex','idnex','',1,'',0,0),(65,'销售额统计','',62,'idnex','idnex','idnex','',1,'',0,0),(48,'编辑角色','',17,'admin','authManager','editGroup','',1,'',0,0),(49,'删除角色','',17,'admin','authManager','deleteGroup','',1,'',0,0),(50,'访问授权','',17,'admin','authManager','access','',1,'',0,0),(51,'角色授权','',17,'admin','authManager','writeGroup','',1,'',0,0),(67,'新增会员统计','',62,'idnex','idnex','idnex','',1,'',0,0),(68,'财务管理','',5,'idnex','idnex','idnex','idnex',1,'',0,0),(55,'缓存更新','',0,'admin','index','cache','',0,'',0,0),(69,'资金管理','',68,'idnex','idnex','idnex','',1,'',0,0),(70,'提现申请','',68,'idnex','idnex','idnex','',1,'',0,0),(71,'结算申请','',68,'idnex','idnex','idnex','',1,'',0,0),(72,'商家结算','',68,'idnex','idnex','idnex','',1,'',0,0),(73,'订单管理','',4,'idnex','idnex','idnex','',1,'',0,0),(74,'商品管理','',4,'idnex','idnex','idnex','',1,'',0,0),(105,'商品列表','',74,'admin','goods','index','',1,'',0,1),(76,'会员管理','',4,'idnex','idnex','idnex','',1,'',0,0),(77,'基础设置','',4,'idnex','idnex','idnex','',1,'',0,0),(78,'订单管理','',73,'admin','order','index','',1,'',0,0),(79,'投诉订单','',73,'admin','ordercomplains','index','',1,'',0,0),(80,'退款订单','',73,'idnex','idnex','idnex','',0,'',0,0),(109,'积分配置','',56,'admin','integralconfig','index','',1,'',0,0),(107,'快递管理','',77,'admin','express','index','',1,'',0,0),(85,'商品属性','',74,'idnex','idnex','idnex','',1,'',0,6),(86,'商品分类','',74,'admin','goods','cats','',1,'',0,2),(87,'品牌管理','',74,'admin','goods','brand','',1,'',0,3),(88,'商品规格','',74,'idnex','idnex','idnex','',1,'',0,9),(89,'评价管理','',74,'admin','goodsappraises','index','',1,'',0,10),(90,'举报管理','',74,'admin','inform','index','',1,'',0,11),(92,'会员等级','',76,'admin','user','ranks','',1,'',0,0),(93,'会员管理','',76,'admin','user','index','',1,'',0,0),(98,'广告管理','',77,'admin','ads','index','',1,'',0,0),(100,'银行管理','',77,'admin','bank','index','',1,'',0,0),(101,'支付管理','',77,'admin','payment','index','',1,'',0,0),(102,'众筹管理','',103,'idnex','idnex','idnex','',0,'',0,0),(103,'众筹管理','',4,'idnex','idnex','idnex','',0,'',0,0),(108,'快递管理','',77,'admin','express','index','',0,'',0,0),(110,'积分日志','',56,'admin','Integrallog','index','',1,'',0,0),(111,'限时秒杀','',56,'admin','seckill','index','',1,'',0,0);

/*Table structure for table `pyg_order_complains` */

DROP TABLE IF EXISTS `pyg_order_complains`;

CREATE TABLE `pyg_order_complains` (
  `complainId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `complainType` tinyint(4) NOT NULL DEFAULT '1' COMMENT '投诉类型',
  `complainTargetId` int(11) NOT NULL DEFAULT '0' COMMENT '投诉用户',
  `complainContent` text NOT NULL COMMENT '投诉内容',
  `complainStatus` tinyint(4) NOT NULL DEFAULT '0' COMMENT '投诉状态',
  `complainTime` datetime NOT NULL COMMENT '投诉时间',
  `finalResult` text COMMENT '仲裁结果',
  `finalResultTime` datetime DEFAULT NULL COMMENT '仲裁时间',
  PRIMARY KEY (`complainId`),
  KEY `complainStatus` (`complainStatus`),
  KEY `complainType` (`complainTargetId`,`complainType`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `pyg_order_complains` */

insert  into `pyg_order_complains`(`complainId`,`orderId`,`complainType`,`complainTargetId`,`complainContent`,`complainStatus`,`complainTime`,`finalResult`,`finalResultTime`) values (13,70,1,16,'11111',0,'2019-07-19 10:34:59',NULL,NULL),(14,69,2,16,'11111',0,'2019-07-19 10:35:14',NULL,NULL),(15,71,4,16,'22222',0,'2019-07-19 15:22:45',NULL,NULL);

/*Table structure for table `pyg_order_goods` */

DROP TABLE IF EXISTS `pyg_order_goods`;

CREATE TABLE `pyg_order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL COMMENT '订单ID',
  `goodsId` int(11) NOT NULL COMMENT '商品ID',
  `goodsNum` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `goodsPrice` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goodsName` varchar(255) NOT NULL COMMENT '商品名称',
  `goodsImg` varchar(255) NOT NULL COMMENT '商品图片',
  PRIMARY KEY (`id`),
  KEY `goodsId` (`goodsId`),
  KEY `orderId` (`orderId`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_order_goods` */

insert  into `pyg_order_goods`(`id`,`orderId`,`goodsId`,`goodsNum`,`goodsPrice`,`goodsName`,`goodsImg`) values (34,69,12,1,'1599.00','OPPO K3 高通骁龙710 升降摄像头 VOOC闪充 6GB+64GB 星云紫 全网通4G 全面屏拍照游戏智能手机','/uploads/goods/20190530\\92d9ac6992c3f0721ff934785071e02c.jpg'),(35,70,9,1,'1599.00','荣耀20i 3200万AI自拍 超广角三摄 全网通版6GB+64GB 渐变蓝 移动联通电信4G全面屏手机 双卡双待','/uploads/goods/20190530\\26e93b88f7d6cc9a3d7100c9d1c71cd8.jpg'),(36,71,11,1,'5999.00','三星 Galaxy S10 8GB+128GB皓玉白（SM-G9730）超感官全视屏骁龙855双卡双待全网通4G游戏手机','/uploads/goods/20190530\\f972ffbde9e64063dd634a172e8f0246.jpg');

/*Table structure for table `pyg_orderids` */

DROP TABLE IF EXISTS `pyg_orderids`;

CREATE TABLE `pyg_orderids` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `rnd` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000086 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_orderids` */

insert  into `pyg_orderids`(`id`,`rnd`) values (10000000,1476880000),(10000016,1560150000),(10000055,1560150000),(10000062,1560150000),(10000063,1560150000),(10000064,1560150000),(10000065,1560150000),(10000066,1560150000),(10000067,1560150000),(10000068,1560150000),(10000072,1560170000),(10000073,1560220000),(10000074,1560220000),(10000075,1561970000),(10000076,1561970000),(10000077,1561970000),(10000078,1561970000),(10000079,1563500000),(10000080,1563500000),(10000081,1563500000),(10000082,1563500000),(10000083,1563500000),(10000084,1563500000),(10000085,1563500000);

/*Table structure for table `pyg_orders` */

DROP TABLE IF EXISTS `pyg_orders`;

CREATE TABLE `pyg_orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单标识',
  `orderNo` varchar(20) NOT NULL COMMENT '订单编号',
  `userId` int(11) NOT NULL COMMENT '用户标识',
  `orderStatus` tinyint(4) NOT NULL DEFAULT '-2' COMMENT '订单状态( 3 待发货 -2 待付款 1 待收货 -1 订单取消)',
  `totalMoney` decimal(11,2) NOT NULL COMMENT '订单总金额',
  `payType` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付类型(1 在线支付 0 货到付款)',
  `isPay` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否支付',
  `userName` varchar(20) NOT NULL COMMENT '收货人',
  `userAddress` varchar(255) NOT NULL COMMENT '收获地址',
  `userPhone` char(11) DEFAULT NULL COMMENT '收货人电话',
  `needPay` decimal(11,2) DEFAULT '0.00',
  `isCancel` tinyint(4) DEFAULT '0' COMMENT '是否取消订单',
  `isRefund` tinyint(4) DEFAULT '0' COMMENT '是否退货',
  `isAppraise` tinyint(4) DEFAULT '0' COMMENT '是否评价',
  `isComplains` tinyint(4) DEFAULT '0' COMMENT '是否投诉',
  `cancelReason` int(11) DEFAULT '0' COMMENT '取消订单原因',
  `rejectReason` int(11) DEFAULT '0' COMMENT '拒绝取消订单原因',
  `rejectOtherReason` varchar(255) DEFAULT NULL,
  `isClosed` tinyint(4) DEFAULT '0' COMMENT '订单是否关闭',
  `goodsSearchKeys` text COMMENT '商品搜索关键词',
  `orderunique` varchar(50) NOT NULL,
  `receiveTime` datetime DEFAULT NULL COMMENT '发货时间',
  `takeTime` datetime DEFAULT NULL COMMENT '收货时间',
  `expressCode` char(50) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '快递编号',
  `tracking` char(50) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '快递单号',
  `tradeNo` varchar(100) DEFAULT NULL,
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`orderId`),
  KEY `userId` (`userId`,`dataFlag`),
  KEY `isRefund` (`isRefund`),
  KEY `orderStatus` (`orderStatus`),
  KEY `shopId` (`dataFlag`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

/*Data for the table `pyg_orders` */

insert  into `pyg_orders`(`orderId`,`orderNo`,`userId`,`orderStatus`,`totalMoney`,`payType`,`isPay`,`userName`,`userAddress`,`userPhone`,`needPay`,`isCancel`,`isRefund`,`isAppraise`,`isComplains`,`cancelReason`,`rejectReason`,`rejectOtherReason`,`isClosed`,`goodsSearchKeys`,`orderunique`,`receiveTime`,`takeTime`,`expressCode`,`tracking`,`tradeNo`,`dataFlag`,`createTime`) values (69,'100000832',16,2,'1599.00',0,1,'张艳新','北京市海淀区三环内 中关村软件园9号楼','15201251947','0.00',0,0,1,1,0,0,NULL,0,NULL,'156350260081776970','2019-07-19 10:18:07','2019-07-19 10:22:23','圆通快递','111111',NULL,1,'2019-07-19 10:16:40'),(70,'100000843',16,2,'1599.00',1,0,'张艳新','北京市海淀区三环内 中关村软件园9号楼','15201251947','0.00',0,0,0,1,0,0,NULL,0,NULL,'156350261230814966','2019-07-19 10:18:31','2019-07-19 10:22:30','圆通快递','1111',NULL,1,'2019-07-19 10:16:52'),(71,'100000854',16,2,'5999.00',1,0,'张艳新','北京市海淀区三环内 中关村软件园9号楼','15201251947','0.00',0,0,0,1,0,0,NULL,0,NULL,'156350265567327535','2019-07-19 10:22:14','2019-07-19 10:22:36','顺丰快递','1111',NULL,1,'2019-07-19 10:17:35');

/*Table structure for table `pyg_payment` */

DROP TABLE IF EXISTS `pyg_payment`;

CREATE TABLE `pyg_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '支付标识',
  `payCode` varchar(255) DEFAULT NULL COMMENT '支付编码',
  `payName` varchar(255) DEFAULT NULL COMMENT '支付名称',
  `payDesc` text COMMENT '支付描述',
  `payOrder` int(11) DEFAULT NULL COMMENT '排序号',
  `payConfig` text COMMENT '支付参数',
  `enabled` tinyint(4) DEFAULT '0' COMMENT '启用 禁用',
  `isOnline` tinyint(4) DEFAULT '0' COMMENT '是否在线支付',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_payment` */

insert  into `pyg_payment`(`id`,`payCode`,`payName`,`payDesc`,`payOrder`,`payConfig`,`enabled`,`isOnline`) values (1,'cod','货到付款','开通城市',1,'',1,0),(3,'weixinpays','微信支付','微信支付',2,'{\"appId\":\"111222\",\"mchId\":\"11\",\"apiKey\":\"111\",\"appsecret\":\"111\",\"payIcon\":\"\"}',1,1);

/*Table structure for table `pyg_user_address` */

DROP TABLE IF EXISTS `pyg_user_address`;

CREATE TABLE `pyg_user_address` (
  `addressId` int(11) NOT NULL AUTO_INCREMENT COMMENT '地址标识',
  `userId` int(11) NOT NULL COMMENT '用户标识',
  `userName` varchar(50) CHARACTER SET utf8mb4 NOT NULL COMMENT '收货人',
  `userPhone` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT '收货人电话',
  `district` char(20) DEFAULT NULL COMMENT '区',
  `city` char(20) DEFAULT NULL COMMENT '市',
  `province` char(20) DEFAULT NULL COMMENT '省',
  `userAddress` varchar(255) CHARACTER SET utf8mb4 NOT NULL COMMENT '收获地址',
  `isDefault` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否默认地址',
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '数据删除状态',
  `createTime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`addressId`),
  KEY `userId` (`userId`,`dataFlag`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `pyg_user_address` */

insert  into `pyg_user_address`(`addressId`,`userId`,`userName`,`userPhone`,`district`,`city`,`province`,`userAddress`,`isDefault`,`dataFlag`,`createTime`) values (5,16,'张艳新','15201251947','','','','北京市海淀区三环内 中关村软件园9号楼',1,1,'2019-06-05 10:28:03'),(6,16,'222224444','222222','越秀区','广州','广东','2222',0,1,'2019-07-04 08:55:55'),(8,16,'2222','2222','涟水县','淮安','江苏','22',0,1,'2019-07-04 09:35:31'),(9,16,'333','3333','涟水县','淮安','江苏','333',0,1,'2019-07-04 09:43:28'),(13,16,'333','333','涟水县','淮安','江苏','33',0,-1,'2019-07-04 09:51:35'),(14,16,'444','4444','涟水县','淮安','江苏','44',0,-1,'2019-07-04 09:53:07'),(15,16,'66','666','涟水县','淮安','江苏','66',0,-1,'2019-07-04 09:55:57'),(16,16,'44','4444','涟水县','淮安','江苏','444',0,1,'2019-07-04 17:24:40');

/*Table structure for table `pyg_user_ranks` */

DROP TABLE IF EXISTS `pyg_user_ranks`;

CREATE TABLE `pyg_user_ranks` (
  `rankId` int(11) NOT NULL AUTO_INCREMENT COMMENT '会员等级标识',
  `rankName` varchar(20) NOT NULL COMMENT '会员等级名称',
  `startScore` int(11) NOT NULL DEFAULT '0' COMMENT '积分下限',
  `endScore` int(11) NOT NULL DEFAULT '0' COMMENT '积分上限',
  `rankImg` varchar(150) DEFAULT NULL COMMENT '会员等级图标',
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1' COMMENT '删除标识',
  `createTime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`rankId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_user_ranks` */

insert  into `pyg_user_ranks`(`rankId`,`rankName`,`startScore`,`endScore`,`rankImg`,`dataFlag`,`createTime`) values (3,'钻石会员',3001,10000,'/uploads/ranks/20190527\\ee6647e57281cbe77956e53c2545f1ca.png',1,'2019-05-27 14:41:36'),(4,'高级会员',1000,3000,'/uploads/ranks/20190527\\1d5ee2a884ffe880e61e54313fbd32ad.png',1,'2019-05-27 14:42:07'),(5,'中级会员',500,1000,'/uploads/ranks/20190527\\4354d14981a3be7e5f86888692be894b.png',1,'2019-05-27 14:42:26'),(6,'初级会员',0,500,'/uploads/ranks/20190527\\5670bb8f7976003b52c9a1dd7a73b8ca.png',1,'2019-05-27 14:43:20');

/*Table structure for table `pyg_user_sign` */

DROP TABLE IF EXISTS `pyg_user_sign`;

CREATE TABLE `pyg_user_sign` (
  `signId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '标识',
  `uid` int(10) unsigned NOT NULL COMMENT '用户uid',
  `points` int(6) NOT NULL COMMENT '关联id',
  `num` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`signId`) USING BTREE,
  KEY `add_time` (`addtime`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户账单表';

/*Data for the table `pyg_user_sign` */

insert  into `pyg_user_sign`(`signId`,`uid`,`points`,`num`,`addtime`) values (6,16,6,1,1563897600);

/*Table structure for table `pyg_users` */

DROP TABLE IF EXISTS `pyg_users`;

CREATE TABLE `pyg_users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `loginName` varchar(20) NOT NULL COMMENT '登陆名称',
  `loginSecret` int(11) DEFAULT NULL COMMENT '密保',
  `loginPwd` varchar(255) NOT NULL COMMENT '密码',
  `userType` tinyint(4) DEFAULT '0' COMMENT '用户类型',
  `userSex` tinyint(4) DEFAULT '0' COMMENT '用户性别',
  `userName` varchar(20) DEFAULT NULL COMMENT '用户名',
  `nickName` varchar(20) DEFAULT NULL COMMENT '昵称',
  `trueName` varchar(100) DEFAULT NULL COMMENT '真实姓名',
  `brithday` date DEFAULT NULL COMMENT '生日',
  `userPhoto` varchar(150) DEFAULT '' COMMENT '用户头像',
  `userQQ` int(11) DEFAULT '0' COMMENT '用户QQ',
  `userPhone` char(11) DEFAULT '' COMMENT '用户电话',
  `userEmail` varchar(50) DEFAULT '' COMMENT '电子邮件',
  `userScore` int(11) DEFAULT '0' COMMENT '用户积分',
  `userTotalScore` int(11) DEFAULT '0' COMMENT '用户总积分',
  `lastIP` varchar(16) DEFAULT NULL COMMENT '最后登陆IP',
  `lastTime` datetime DEFAULT NULL COMMENT '最后登陆时间',
  `userStatus` tinyint(4) DEFAULT '1' COMMENT '用户状态',
  `integral` decimal(8,2) DEFAULT '0.00',
  `isInform` tinyint(4) DEFAULT '1' COMMENT '是否被禁止举报',
  `dataFlag` tinyint(4) DEFAULT '1' COMMENT '数据删除状态',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pyg_users` */

insert  into `pyg_users`(`userId`,`loginName`,`loginSecret`,`loginPwd`,`userType`,`userSex`,`userName`,`nickName`,`trueName`,`brithday`,`userPhoto`,`userQQ`,`userPhone`,`userEmail`,`userScore`,`userTotalScore`,`lastIP`,`lastTime`,`userStatus`,`integral`,`isInform`,`dataFlag`,`createTime`) values (16,'15201251947',1726,'e3ceb5881a0a1fdaad01296d7554868d',0,2,'手机用户','木头','张艳新','2020-07-10','',695860928,'','695860928@qq.com',0,0,'127.0.0.1','2019-07-24 14:05:10',1,'0.00',1,1,'2019-05-30 13:33:56');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
