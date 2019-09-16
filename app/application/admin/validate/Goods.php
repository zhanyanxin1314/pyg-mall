<?php
namespace app\admin\validate;
use think\Validate;

/**
 * 商品验证器
 */
class Goods extends Validate{
	protected $rule = [
		'goodsName' => 'require|max:100',
		'goodsImg' => 'require',
		'goodsType' => 'in:,0,1',
		'goodsSn' => 'checkGoodsSn:1',
		'goodsUnit' => 'require',
		'isSale' => 'in:,0,1',
		'isRecom' => 'in:,0,1',
		'isBest' => 'in:,0,1',
		'isNew' => 'in:,0,1',
		'isHot' => 'in:,0,1',
		'goodsDesc' => 'require',
	];
	
	protected $message  =  [
		'goodsName.require' => '请输入商品名称',
		'goodsName.max' => '商品名称不能超过100个字符',
		'goodsImg.require' => '请上传商品图片',
		'goodsSn.checkGoodsSn' => '请输入商品编号',
		'goodsUnit.require' => '请输入商品单位',
		'isSale.in' => '无效的上架状态',
		'isRecom.in' => '无效的推荐状态',
		'isBest.in' => '无效的精品状态',
		'isNew.in' => '无效的新品状态',
		'isHot.in' => '无效的热销状态',
		'goodsDesc.require' => '请输入商品描述',
	];

    /**
     * 检测商品编号
     */
    protected function checkGoodsSn($value){
    	$goodsId = Input('post.goodsId/d',0);
    	$key = Input('post.goodsSn');
    	if($key=='')return '请输入商品编号';
    	$isChk = model('Goods')->checkExistGoodsKey('goodsSn',$key,$goodsId);
    	if($isChk)return '对不起，该商品编号已存在';
    	return true;
    }
}