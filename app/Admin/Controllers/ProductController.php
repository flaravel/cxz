<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Controllers;

use App\Models\Product\Product;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Traits\AdminTrait;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductController extends AdminController {
	use AdminTrait;
	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid() {
		return Grid::make(Product::with('category'), function (Grid $grid) {
			$grid->model()->latest();
			$grid->column('id')->sortable();
			$grid->column('product_image')->image('', 90, 90);
			$grid->column('category.category_name', admin_trans('product.fields.category_id'));
			$grid->column('product_name');
			$grid->column('price');
			$grid->column('market_price');
			$grid->column('on_sale')->using(Product::$saleMap)->dot(Product::$dotMap);
			$grid->column('sort');
			$grid->column('sales', admin_trans('product.fields.sales'))->display(function () {
				/**@var $product Product*/
				$product = $this;
				return $product->sales_initial + $product->sales_actual;
			});
			$grid->column('created_at');

			$grid->filter(function (Grid\Filter $filter) {
			    $this->showFilterPanel($filter,true);
				$tree = collect(ProductCategory::selectOptions())->forget(0);
				$filter->like('product_name')->width(3);
				$filter->where('category_id', function ($query) {
					$cateId = request()->get('category_id');
					$pCate = ProductCategory::query()->where('id', $cateId)->first();
					$categoryId = ProductCategory::query()
						->where('path', 'like', $pCate->path.$pCate->id.'-%')
						->get(['id'])
						->pluck('id')
						->push((int)$cateId)
						->toArray();
					$query->whereIn('category_id', $categoryId);
				})->width(3)->select($tree);
			});
			$this->showRestore($grid, Product::class);

            $grid->disableViewButton();
        });
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form() {
		return Form::make(new Product(), function (Form $form) {
			$form->select('category_id')->options(function () {
                return collect(ProductCategory::selectOptions())->forget(0);
            })->saving(function ($v) {
                return (int) $v;
            })->required();
            $form->select('brand_id')->options(ProductBrand::all()->pluck('brand_name','id'));
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

			$form->disableViewButton();
		});
	}
}
