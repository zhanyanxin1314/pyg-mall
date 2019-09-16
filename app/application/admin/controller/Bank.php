<?php

// +----------------------------------------------------------------------
// | 银行信息
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\Adminbase;
use app\admin\model\Bank as BK;
use think\Db;

class Bank extends Adminbase
{

    /**
     * 银行信息-展示页面
     */
    public function index()
    {
        $this->assign("p",(int)input("p"));
        return $this->fetch();
    }

    /**
     * 获取分页 - 银行信息
     */
    public function pageQuery()
    {
        $bk = new BK();
        $rs =  $bk->pageQuery();
        return PYGGrid($rs);
    }




    //通用缩略图上传接口
    public function upload()
    {
       if($this->request->isPost()){
                 $dir = Input('param.dir');
                 $res['code']=1;
                 $res['msg'] = '上传成功！';
                 $file = $this->request->file('file');
                 $info = $file->move('../public/uploads/'.$dir);
                 //halt( $info);
                 if($info){
                     $res['name'] = $info->getFilename();
                     $res['filepath'] = '/uploads/goods/'.$info->getSaveName();
                 }else{
                     $res['code'] = 0;
                     $res['msg'] = '上传失败！'.$file->getError();
                 }
                 return $res;
             }
    }


    /**
     * 新增
     */
    public function add()
    {
        $bk = new BK();
        return $bk->add();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $bk = new BK();
        return $bk->edit();
    }

    /*
    * 获取数据
    */
    public function get()
    {
        $bk = new BK();
        $rs = $bk->getById(Input("id/d",0));
        return $rs;
    }

    /**
     * 删除
     */
    public function del()
    {
        $bk = new BK();
        return $bk->del();
    }
}
