<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\IsNewBatch;
use App\Models\Product\Product;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Traits\AdminTrait;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Tab;

class ProductController extends AdminController {
	use AdminTrait;
	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid() {
		return Grid::make(Product::with('category'), function (Grid $grid) {
			$grid->column('id')->sortable();
			$grid->column('product_image')->image('', 90, 90);
			$grid->column('category.category_name', admin_trans('product.fields.category_id'));
			$grid->column('product_name')->append(function () {
			    $new = Product::$newMap[$this->is_new];
			    return "<span class='badge badge-primary'>{$new}</span>";
            });
			$grid->column('price');
			$grid->column('market_price');
			$grid->column('sales', admin_trans('product.fields.sales'))->display(function () {
				/**@var $product Product*/
				$product = $this;
				return $product->sales_initial + $product->sales_actual;
			});
			$grid->column('sort')->editable();
			$grid->column('created_at');

			$grid->filter(function (Grid\Filter $filter) {
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

            // 状态查询和快捷状态TAB一起使用
            $this->showStatusFilter($grid,'on_sale', Product::ON_SALE());
			$grid->header(function () use ($grid) {
                //快捷状态TAB
                return $this->showStatusTab([1 => '出售中', 0 => '已下架'],Product::ON_SALE(),$grid,'on_sale');
			});

			// 恢复按钮
			$this->showRestore($grid);
			// 上下架按钮
			$this->showOnSaleButton($grid);
            // 是否上新按钮
			$grid->tools([
                request('_scope_') == 'trashed' ? '':new IsNewBatch(Product::class)
            ]);
		});
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form() {
		return Form::make(Product::with('properties'), function (Form $form) {
			$form->tab(admin_trans('cxz.goods.setting'), function (Form $form) {
				$form->select('category_id')->options(function () {
					return collect(ProductCategory::selectOptions())->forget(0);
				})->saving(function ($v) {
					return (int) $v;
				})->required();
				$form->select('brand_id')->options(ProductBrand::all()->pluck('brand_name', 'id'))->saving(function ($brandId) {
					return is_null($brandId) ? 0 : $brandId;
				});
				$form->text('product_name')->required();
				$form->textarea('selling_point')->saveAsString();
				$form->decimal('price')->default(0);
				$form->decimal('market_price')->default(0);
				$form->switch('on_sale');
				$form->switch('is_recommend')->help(admin_trans('cxz.goods.is_recommend_help'));
				$form->switch('is_new')->help(admin_trans('cxz.goods.is_new_help'));
				$form->number('sort')->min(0)->max(9999999)->help(admin_trans('cxz.goods_sort_help'))->default(0);
				$form->number('sales_initial')->min(0)->max(9999999)->help(admin_trans('cxz.goods_sales_help'))->default(0);
				$form->number('stock')->min(0)->help(admin_trans('cxz.goods_stock_help'));
			})->tab(admin_trans('cxz.goods.resource'), function (Form $form) {
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
					->options()
					->required()
					->limit(5)
					->maxSize(1 * 1024)
					->help(admin_trans('cxz.goods.more_image_max'));
				$form->editor('content')->required();
			})->tab(admin_trans('cxz.goods.attributes'), function (Form $form) {
				$form->hasMany('properties', '', function (Form\NestedForm $form) {
					$form->text('name');
					$form->text('value');
				});
			})->tab(admin_trans('cxz.goods.skus'), function (Form $form) {
			});
		});
	}
}
