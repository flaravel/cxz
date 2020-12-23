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
use App\Traits\AdminTrait;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductCategoryController extends AdminController {
    use AdminTrait;

	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid() {
		return Grid::make(new ProductCategory(), function (Grid $grid) {
			$grid->column('id')->sortable();
			$grid->column('category_name')->tree(true);
			$grid->column('category_image')->image('', 45, 45);
			$grid->column('sort');
			$grid->column('on_sale')->switch();
			$grid->column('created_at');

            $grid->quickSearch(['category_name'])->placeholder(admin_trans('cxz.please_enter_name'));
			$this->showRestore($grid, ProductCategory::class);
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
				->maxSize(1 * 1024)
				->autoUpload()
                ->saveAsString()
				->saveFullUrl();
			$form->number('sort')->value(50);
			$form->switch('on_sale');

			$form->deleting(function (Form $form) {
				$count = ProductCategory::query()->where('parent_id', $form->getKey())->count();
				if ($count > 0) {
					return $form->response()->error(admin_trans('cxz.delete_category_check'));
				}
			});
		});
	}
}
