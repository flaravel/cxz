<?php

/**
 * This file is part of Cxz
 *
 * (c) Flaravel 2020 <https://github.com/flaravel/cxz>
 *
 *  document https://learnku.com/blog/FLaravel
 *
 * visited
 */

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
	'prefix'        => config('admin.route.prefix'),
	'namespace'     => config('admin.route.namespace'),
	'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
	$router->get('/', 'HomeController@index');

	// 文件
	$router->resource('file', 'FileController');

	// 产品相关
	$router->group(['prefix' => 'product'], function (Router $router) {

	    // 品牌
	    $router->resource('brand','ProductBrandController');

	    // 分类
	    $router->resource('category','ProductCategoryController');

	    // 商品
	    $router->resource('goods','ProductController')->except(['show']);
    });
});
