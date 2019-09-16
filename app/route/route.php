<?php

// +----------------------------------------------------------------------
// | 全局路由
// +----------------------------------------------------------------------
Route::rules([
    'category-:cat'=>'index/goods/lists',
    'search'=>'index/goods/search',
    'inform'=>'index/center/inform',    
    'cart'=>'index/carts/index',
    'seckill'=>'index/seckill/index',
    'index'=>'index/center/index',
    'order'=>'index/center/order',
    'cancel'=>'index/center/cancel',
    'favorites'=>'index/center/favorites',
    'appraise'=>'index/center/appraise',
    'complains'=>'index/center/complains',
    'safe'=>'index/center/safe',
    'history'=>'index/center/history',
    'info'=>'index/center/info',
    'address'=>'index/center/address',
    'settlement'=>'index/carts/settlement',
    'goods-:goodsId'=>'index/goods/detail',
    'seckill-:goodsId'=>'index/seckill/detail',
    'addinform-:gId'=>'index/center/addinform',
    'login'=>'index/users/login',
    'regist'=>'index/users/regist',
]);