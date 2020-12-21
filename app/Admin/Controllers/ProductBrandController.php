<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\Restore;
use App\Admin\Actions\Grid\RestoreMany;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Traits\RestoreTrait;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\Tools;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductBrandController extends AdminController {
    use RestoreTrait;
	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid() {
		return Grid::make(new ProductBrand(), function (Grid $grid) {
			$grid->column('id')->sortable();
            $grid->column('logo_url')->image('',45,45);
            $grid->column('brand_name');
			$grid->column('desc')->limit(30);
			$grid->column('status')->using(ProductBrand::$saleMap)->dot(ProductBrand::$dotMap);
			$grid->column('created_at');

			$grid->filter(function (Grid\Filter $filter) {
                $filter->scope('trashed')->onlyTrashed();
				$filter->equal('brand_name');
				$filter->equal('status')->select(ProductBrand::$saleMap);
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
		return Show::make($id, new ProductBrand(), function (Show $show) {
			$show->field('id');
			$show->field('brand_name');
			$show->field('desc');
			$show->field('logo_url')->image('',45,45);
			$show->field('status')->using(ProductBrand::$saleMap)->dot(ProductBrand::$dotMap);;
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
		return Form::make(new ProductBrand(), function (Form $form) {
			$form->text('brand_name')->required();
			$form->textarea('desc');
			$form->image('logo_url')
                ->uniqueName()
                ->maxSize(2 * 1024)
                ->saveAsString()
                ->autoUpload()
                ->saveFullUrl();
			$form->switch('status')->options(ProductBrand::$saleMap);
		});
	}
}
