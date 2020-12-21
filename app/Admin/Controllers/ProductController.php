<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Controllers;

use App\Models\Product\Product;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductController extends AdminController {
	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid() {
		return Grid::make(Product::with(['brand','category']), function (Grid $grid) {
			$grid->column('id')->sortable();
            $grid->column('product_image');
            $grid->column('product_name');
            $grid->column('brand.name',admin_trans('product.fields.brand_id'));
			$grid->column('category.category_name',admin_trans('product.fields.category_id'));
			$grid->column('price');
			$grid->column('market_price');
			$grid->column('on_sale');
			$grid->column('sort');
			$grid->column('sales_actual');
			$grid->column('sales_initial');
			$grid->column('created_at');

			$grid->filter(function (Grid\Filter $filter) {
				$filter->equal('id');
			});
		});
	}

	/**
	 * Make a show builder.
	 *
	 * @param mixed $id
	 *
	 * @return Show
	 */
	protected function detail($id) {
		return Show::make($id, new Product(), function (Show $show) {
			$show->field('id');
			$show->field('brand_id');
			$show->field('category_id');
			$show->field('delivery_id');
			$show->field('product_name');
			$show->field('selling_point');
			$show->field('product_image');
			$show->field('product_banner');
			$show->field('price');
			$show->field('market_price');
			$show->field('on_sale');
			$show->field('sort');
			$show->field('sales_actual');
			$show->field('sales_initial');
			$show->field('content');
			$show->field('created_at');
			$show->field('updated_at');
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
			$form->text('brand_id');
			$form->text('category_id');
			$form->text('delivery_id');
			$form->text('product_name');
			$form->text('selling_point');
			$form->text('product_image');
			$form->text('product_banner');
			$form->text('price');
			$form->text('market_price');
			$form->text('on_sale');
			$form->text('sort');
			$form->text('sales_actual');
			$form->text('sales_initial');
			$form->text('content');

			$form->display('created_at');
			$form->display('updated_at');
		});
	}
}
