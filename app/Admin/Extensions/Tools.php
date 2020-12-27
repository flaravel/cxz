<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Extensions;

use App\Admin\Actions\Grid\StatusBatch;
use App\Models\Product\Product;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Widgets\Tab;

class Tools {
	/**
	 * 获取商品新品设置按钮
	 *
	 * @return StatusBatch
	 */
	public static function getProductNew() {
		return new StatusBatch(
			admin_trans('cxz.goods.new'),
			Product::class,
			'is_new',
			collect([1, 0])->combine(array_values(admin_trans('cxz.goods.new_data')))->toArray()
		);
	}

	/**
	 * 获取商品推荐设置按钮
	 *
	 * @return StatusBatch
	 */
	public static function getProductRecommend() {
		return new StatusBatch(
			admin_trans('cxz.goods.recommend'),
			Product::class,
			'is_recommend',
			collect([1, 0])->combine(array_values(admin_trans('cxz.goods.recommend_data')))->toArray()
		);
	}

	/**
	 * 状态快捷筛选
	 *
	 * @param Grid $grid    表格模型
	 * @param array $statusTab  筛选状态数组
	 * @param string $field     筛选字段
	 * @param int|bool|string $fieldDefault     筛选默认值
	 */
	public static function showStatusFilter(Grid $grid, array $statusTab, string $field, $fieldDefault) {
		// 状态查询和快捷状态TAB一起使用
		if (request('_scope_') != 'trashed') {
			if (request()->has('_status')) {
				$grid->model()->where($field, request()->input('_status'));
			} else {
				$grid->model()->where($field, $fieldDefault);
			}
		}
		$grid->header(function () use ($grid,$statusTab,$fieldDefault,$field) {
			$tab = Tab::make()->withCard();
			$tab->setHtmlAttribute('style', 'margin-top:20px');
			// 强迫症患者
			$script = <<<JS
                $('.nav-tabs').css('margin-bottom','0rem')
JS;
			Admin::script($script);
			foreach ($statusTab as $key => $value) {
				if (request()->has('_status')) {
					$status = request()->input('_status') == $key;
				} else {
					$status = $key == $fieldDefault;
				}
				if (!is_null($grid) && !is_null($field)) {
					$query = get_class($grid->model()->repository()->model())::query();
					$grid->model()->getQueries()->unique()->each(function ($value) use (&$query,$field,$key) {
						if (in_array($value['method'], ['paginate', 'get', 'orderBy', 'orderByDesc','latest'], true)) {
							return;
						}
						if ($value['method'] == 'where' && in_array($field, $value['arguments'])) {
							$value['arguments'][1] = $key;
						}
						$query = call_user_func_array([$query, $value['method']], $value['arguments'] ?? []);
					});
					if (request('_scope_') != 'trashed') {
						$count = $query->count();
					} else {
						$count = $query->onlyTrashed()->count();
					}
				}
				$tab->addLink(isset($count) ? $value."($count)" : $value, url(request()->fullUrlWithQuery(['_status' => $key])), $status);
			}
			return $tab;
		});
	}

	/**
	 * 双击弹出编辑弹窗
	 */
	public function dblclick() {
		$script = <<<JS
              $("#grid-table > tbody > tr").on("dblclick",function() {
                 var obj = $(this).find(".feather.icon-edit");
                 if (obj.length == 1) {
                     obj.trigger("click")
                 }
              })
JS;
		Admin::script($script);
	}
}
