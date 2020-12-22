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

class ProductBrandController extends AdminController {
    use AdminTrait;
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
			$grid->column('on_sale')->bool();
			$grid->column('created_at');

			$grid->filter(function (Grid\Filter $filter) {
				$filter->equal('brand_name')->width(3);
				$filter->equal('on_sale')->select(ProductBrand::$saleMap)->width(3);
			});
            $this->showRestore($grid, ProductBrand::class);
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
			$show->field('on_sale')->using(ProductBrand::$saleMap)->dot(ProductBrand::$dotMap);;
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
			$form->textarea('desc')->saveAsString();
			$form->image('logo_url')
                ->uniqueName()
                ->maxSize(1 * 1024)
                ->saveAsString()
                ->autoUpload()
                ->saveFullUrl();
			$form->switch('on_sale');
		});
	}
}
