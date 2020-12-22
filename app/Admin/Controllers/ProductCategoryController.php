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

			$grid->filter(function (Grid\Filter $filter) {
                $this->showFilterPanel($filter,true);
				$filter->equal('category_name')->width(3);
                $filter->equal('on_sale')->width(3)->select(ProductCategory::$saleMap);
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
