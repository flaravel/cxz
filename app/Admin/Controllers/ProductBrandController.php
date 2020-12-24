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
			$grid->column('on_sale')->switch();
			$grid->column('created_at');
			$grid->quickSearch(['brand_name'])->placeholder(admin_trans('cxz.please_enter_name'));
            $this->showRestore($grid);
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
