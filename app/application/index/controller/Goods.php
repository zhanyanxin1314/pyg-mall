<?php
namespace app\index\controller;
use app\common\controller\Base;
use app\index\model\Goods as M;
use app\common\model\History as H;
use think\Request;
use think\Db;

class Goods extends Base
{

    public function index()
    {
        return $this->fetch();
    }

    /**
     *  商品搜索
     */
    public function search(){

        //获取商品记录
        $m = new M();
        $data = [];
        $data['isStock'] = Input('isStock/d');
        $data['isNew'] = Input('isNew/d');
        $data['orderBy'] = Input('orderBy/d');
        $data['order'] = Input('order/d',1);
        $data['keyword'] = input('keyword');
        $data['minPrice'] = Input('minPrice/d');
        $data['maxPrice'] = Input('maxPrice/d');
        $data['goodsPage'] = $m->pageQuery();

         //品牌信息
        $brandInfo = Db::name('brands')->where(['dataFlag'=>1])->select();
        $data['brands'] = $brandInfo;
        $data['priceGrade'] = $m->getPriceGrade();
        $this->assign('keyword',$data['keyword']);
        return $this->fetch("lists",$data);
    }

    /**
     * 获取商品列表
    */
    public function lists()
    {
        $catId = (int)Input('cat/d');
        $goodsCatIds = [];
        if($catId>0){
            $goodsCatIds = model('GoodsCats')->getParentIs($catId);
        }
        //填充参数
        $data = [];
        $data['catId'] = $catId;
        $data['isStock'] = Input('isStock/d');
        $data['isNew'] = Input('isNew/d');
        $data['orderBy'] = Input('orderBy/d');
        $data['order'] = Input('order/d',1);
        $data['minPrice'] = Input('minPrice');
        $data['maxPrice'] = Input('maxPrice');

        //品牌信息
        $brandInfo = Db::name('brands')->where(['dataFlag'=>1])->select();
        $data['brands'] = $brandInfo;

        //获取商品记录
        $m = new M();
        $data['priceGrade'] = $m->getPriceGrade();
        $data['goodsPage'] = $m->pageQuery($goodsCatIds);
        $catPaths = model('goodsCats')->getParentNames($catId);

        $data['catNamePath'] = '全部商品分类';
        if(!empty($catPaths))$data['catNamePath'] = implode(' - ',$catPaths);
        $count = $data['goodsPage']['total'];
        $this->assign('count',$count);
        $this->assign('catId',$catId);
        return $this->fetch($catInfo['catListTheme']?$catInfo['catListTheme']:'lists',$data);
    }

    //查询商品
    public function getAjaxGoods(){
        $m = new M();
        $catId = (int)Input('cat/d');
        $goodsCatIds = [];
        if($catId>0){
            $goodsCatIds = model('GoodsCats')->getParentIs($catId);
        }
        $data = $m->pageQuery($goodsCatIds);
        return $data['data'];
    }
    /**
     * 商品详情
     */
    public function detail()
    {
        $m = new M();
        $goods = $m->getBySale(input('goodsId/d',0));
        if(!empty($goods)){
            //添加浏览历史记录
            $h = new H();
            $h->add();
            // 分类信息
            $catInfo = Db::name("goods_cats")->where(['catId'=>$goods['goodsCatId'],'dataFlag'=>1])->find();
            $this->assign('goods',$goods);
            return $this->fetch();
        } else {
            return $this->fetch("error_lost");
        }
    }

    /**
     *  记录对比商品
     */
    public function contrastGoods(){
        $id = (int)input('post.id');
        $contras = cookie("contras_goods");
        if($id>0){
            $m = new M();
            $goods = $m->getBySale($id);
            $catId = explode('_',$goods['goodsCatIdPath']);
            $catId = $catId[0];
            if(isset($contras['catId']) && $catId!=$contras['catId'])return PYGReturn('请选择同分类商品进行对比',-1);
            if(isset($contras['list']) && count($contras['list'])>3)return PYGReturn('商品对比栏已满',-1);
            if(!isset($contras['catId']))$contras['catId'] = $catId;
            $contras['list'][$id] = $id;
            cookie("contras_goods",$contras,25920000);
        }
        if(isset($contras['list'])){
            $m = new M();
            $list = [];
            foreach($contras['list'] as $k=>$v){
                $list[] = $m->getBySale($v);
            }
            return PYGReturn('',1,$list);
        } else {
            return PYGReturn('',1);
        }
    }

    /**
     *  删除对比商品
     */
    public function contrastDel(){
        $id = (int)input('post.id');
        $contras = cookie("contras_goods");
        if($id>0 && isset($contras['list'])){
            unset($contras['list'][$id]);
            cookie("contras_goods",$contras,25920000);
        } else {
            cookie("contras_goods", null);
        }
        return PYGReturn('删除成功',1);
    }

    /**
     *  商品对比
     */
    public function contrast(){
        $contras = cookie("contras_goods");
        $list = [];
        $list = $lists = $score = $brand  = [];
        if(isset($contras['list'])){
            $m = new M();
            foreach($contras['list'] as $key=>$value){
                $dara = $m->getBySale($value);
                $list[] = $dara;
            }
            //第一个商品信息
            $goods = $list[0];
            //对比处理
             $scores['identical'] = $brands['identical'] = 1;
            foreach($list as $k=>$v){
                $score[$v['goodsId']] = $v['scores']['totalScores'];
                if($goods['scores']['totalScores']!=$v['scores']['totalScores'])$scores['identical'] = 0;
                $brand[$v['goodsId']] = $v['brandName'];
                if($goods['brandId']!=$v['brandId'])$brands['identical'] = 0;
            }
            $scores['name'] = '商品评分';
            $scores['type'] = 'score';
            $scores['info'] =  $score;
            $lists[] = $scores;
            $brands['name'] = '品牌';
            $brands['type'] = 'brand';
            $brands['info'] =  $brand;
            $lists[] = $brands;
        }
        $data['list'] = $list;
        $data['lists'] = $lists;
        $this->assign('data',$data);
        return $this->fetch();
    }
}
