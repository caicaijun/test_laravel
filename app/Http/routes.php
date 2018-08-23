<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* 路由和控制器关联 */

Route::any('admin/login', 'admin\LoginController@login');//登录页面
Route::get('index/captcha/{tmp}', 'admin\LoginController@captcha');//登录页面验证码
Route::get('mall', 'admin\AjaxImgController@mall');//邮件发送测试
Route::get('cache', 'CachetestController@test1');//缓存测试
Route::get('cdel', 'CachetestController@del');//缓存测试
Route::get('redis', 'RedistestController@test');//redis缓存测试
Route::get('log', 'LogstestController@test');//log记录测试
Route::get('que', 'QueuetestController@test');//队列测试

/* 中间件验证用户是否登录 */
Route::group(['middleware' => ['admins']], function () {
	// 后台路由
	Route::any('admin/loginout', 'admin\LoginController@loginOut');

	Route::any('admin/index', 'admin\IndexController@index');
	Route::any('admin/websetting', 'admin\IndexController@webSetting');//网站设置
	//ajax公共路由，后期类名改为AjaxCom
	Route::any('admin/ajaxuploads', 'admin\AjaxImgController@uploads');//统一AJAX文件上传
	Route::any('admin/city', 'admin\AjaxImgController@city');//请求city
	//Product 控制器路由
	Route::any('admin/prolist', 'admin\ProductController@proList');
	Route::any('admin/prodetail', 'admin\ProductController@proDetail');//添加产品
	Route::any('admin/proedit/{id?}', 'admin\ProductController@proEdit');//编辑产品
	Route::any('admin/uploads', 'admin\ProductController@upload');//文件上传
	Route::any('admin/prodelet/{id?}', 'admin\ProductController@proDelet');//文件上传

	//order  订单路由
	Route::any('admin/orderlist', 'admin\OrderController@orderList');//订单列表
	Route::any('admin/orderdetail/{id}', 'admin\OrderController@orderDetail');//订单详情

	//User  用户路由
	Route::any('admin/userlist', 'admin\UserController@userList');//用户列表
	Route::any('admin/useradd', 'admin\UserController@userAdd');//添加新用户
	Route::any('admin/userdetail/{id}', 'admin\UserController@userDetail');//用户详情
	Route::any('admin/userrank', 'admin\UserController@userRank');//会员等级列表
	Route::any('admin/rankdel/{id}', 'admin\UserController@rankDel');//会员等级删除
	Route::any('admin/userfunding/{id}', 'admin\UserController@userFunding');//用户资金
	Route::any('admin/uclosed/{id?}/{closed?}', 'admin\UserController@userClosed');//用户关闭开启

	//order express 订单物流
	Route::any('admin/expresslist', 'admin\OrderController@expressList');//快递列表
	Route::any('admin/expressadd', 'admin\OrderController@expressAdd');//快递添加
	Route::any('admin/expressedit/{express_id}', 'admin\OrderController@expressEdit');//快递修改
	Route::any('admin/expressdel/{express_id}', 'admin\OrderController@expressDel');//快递删除


	//order express 订单物流
	Route::any('admin/expresslist', 'admin\OrderController@expressList');//快递列表
	Route::any('admin/expressadd', 'admin\OrderController@expressAdd');//快递添加
	Route::any('admin/expressedit/{express_id}', 'admin\OrderController@expressEdit');//快递修改
	Route::any('admin/expressdel/{express_id}', 'admin\OrderController@expressDel');//快递删除

	//Pay 支付插件
	Route::any('admin/paylist', 'admin\PayController@payList');//支付列表
	Route::any('admin/payadd', 'admin\PayController@payAdd');//支付添加
	Route::any('admin/paydel/{payment_id}', 'admin\PayController@payDel');//支付删除

});

// 前台路由
Route::get('/', 'home\IndexController@index');










/* 路由请求类型 */
Route::get('test1', function () {
	return 'hello test1';
});

Route::post('test2', function () {
	return 'hello test2';
}); // 不能通过url直接访问

Route::match(['get', 'post'], 'test3', function () {
	return 'hello test3';
});// 指定多类型请求路由

Route::any('test4', function () {
	return 'hello test4';
}); // 包含所有类型请求路由

Route::get('test5/{id}', function ($id) {
	return 'hello test5--' . $id;
});// 必填的带参数路由

Route::get('test6/{name?}', function ($name = 666) {
	return 'hello test6--' . $name;
});// 可选的带参数路由

Route::get('test7/{id}/{name?}', function ($id, $name = 'cai') {
	return 'hello test7----number=' . $id . '----name=' . $name;
})->where(['id' => '[0-9]+']);// 多参数路由,where()方法验证字段

Route::get('test8/member-center', ['as' => 'center', function () {
	return 'test8-member-center';
}]);//路由别名,用法和之前的一样，具体效果不明

Route::get('test9/center', ['as' => 'center', function () {
	return route('center');
}]);//路由别名

Route::group(['prefix' => 'admin'], function () {
    Route::get('test1', function () {
        // 路由名称为 admin/test1
        return 'test1--路由群组';
    });
    Route::get('test9/center', ['as' => 'center', function () {
	return route('center') . '路由群组';
	}]);
});//路由群组，那么你可以在路由群组的属性数组中指定一个 as 关键字，这将允许你为路由群组中的所有路由设置相同的前缀名称：

Route::get('view', function () {
	return view('admin.login');
});//路由视图 view 辅助函数的第一个参数会对应到 resources/views 目录内视图文件的名称；传递到 view 辅助函数的第二个参数是一个能够在视图内取用的数据数组。
Route::auth();

Route::get('/home', 'HomeController@index');
