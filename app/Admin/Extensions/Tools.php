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
}
