<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Controllers;

use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Traits\RestoreTrait;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductCategoryController extends AdminController {
	use RestoreTrait;

	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid() {
		return Grid::make(new ProductCategory(), function (Grid $grid) {
			$grid->column('id')->sortable();
			$grid->column('category_name')->tree();
			$grid->column('category_image')->image('', 45, 45);
			$grid->column('sort');
			$grid->column('on_sale')->using(ProductBrand::$saleMap)->dot(ProductBrand::$dotMap);
			$grid->column('created_at');

			$grid->filter(function (Grid\Filter $filter) {
				$filter->scope('trashed')->onlyTrashed();
				$filter->equal('category_name');
			});

			$this->showRestore($grid, ProductCategory::class);
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
		return Show::make($id, ProductCategory::with('parent'), function (Show $show) {
			$show->field('id');
			$show->field('category_name');
			$show->field('category_image')->image('', 45, 45);
			$show->field('sort');
			$show->field('path');
			$show->field('on_sale')->using(ProductCategory::$saleMap)->dot(ProductBrand::$dotMap);
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
		return Form::make(new ProductCategory(), function (Form $form) {
			$form->select('parent_id', trans('admin.parent_id'))
				->options(function () {
					return ProductCategory::selectOptions();
				})->saving(function ($v) {
					return (int) $v;
				})->required();
			$form->text('category_name')->required();
			$form->image('category_image')
				->uniqueName()
				->maxSize(2 * 1024)
				->autoUpload()
                ->saveAsString()
				->saveFullUrl();
			$form->number('sort')->value(50);
			$form->radio('on_sale')->options(ProductCategory::$saleMap)->required();

			$form->deleting(function (Form $form) {
				$count = ProductCategory::query()->where('parent_id', $form->getKey())->count();
				if ($count > 0) {
					return $form->response()->error(admin_trans('cxz.delete_category_check'));
				}
			});
		});
	}
}
