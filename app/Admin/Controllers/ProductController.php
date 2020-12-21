<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Controllers;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductController extends AdminController {
	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid() {
		return Grid::make(new Product(), function (Grid $grid) {
			$grid->column('id')->sortable();
            $grid->column('product_image')->image('',45,45);
            $grid->column('product_name');
			$grid->column('price');
			$grid->column('market_price');
			$grid->column('on_sale')->using(Product::$saleMap)->dot(Product::$dotMap);
			$grid->column('sort');
			$grid->column('sales',admin_trans('product.fields.sales'))->display(function () {
			    /**@var $product Product*/
			    $product = $this;
			    return $product->sales_initial + $product->sales_actual;
            });
			$grid->column('created_at');

			$grid->filter(function (Grid\Filter $filter) {
				$filter->equal('id');
				$filter->like('product_name');
			});
		});
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form() {
		return Form::make(new Product(), function (Form $form) {
			$form->display('id');
			$form->select('category_id')->options(function () {
                return collect(ProductCategory::selectOptions())->forget(0);
            })->saving(function ($v) {
                return (int) $v;
            })->required();
			$form->text('product_name')->required();
			$form->textarea('selling_point');
			$form->image('product_image')
                ->uniqueName()
                ->autoUpload()
                ->saveFullUrl()
                ->required()
                ->maxSize(1 * 1024);
			$form->multipleImage('product_banner')
                ->uniqueName()
                ->autoUpload()
                ->saveFullUrl()
                ->required()
                ->limit(5)
                ->maxSize(1 * 1024);
			$form->decimal('price')->required();
			$form->decimal('market_price')->default(0);
			$form->switch('on_sale')->required();
			$form->number('sort')->min(0)->max(9999999)->help(admin_trans('cxz.goods_sort_help'))->default(0);
			$form->number('sales_initial')->min(0)->max(9999999)->help(admin_trans('cxz.goods_sales_help'))->default(0);
			$form->number('stock')->min(0)->help(admin_trans('cxz.goods_stock_help'));
			$form->editor('content');
		});
	}
}
