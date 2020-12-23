<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Traits;

use App\Admin\Actions\Grid\Back;
use App\Admin\Actions\Grid\OnSaleDownBatch;
use App\Admin\Actions\Grid\OnSaleBatch;
use App\Admin\Actions\Grid\Restore;
use App\Admin\Actions\Grid\RestoreBatch;
use App\Admin\Actions\Grid\Trashed;
use Dcat\Admin\Grid;

trait AdminTrait {
	/**
	 * 删除与恢复
	 *
	 * @param Grid $grid
	 * @param string $model
	 */
	public function showRestore(Grid $grid, string $model) {
		$grid->filter(function (Grid\Filter $filter) {
			$filter->scope('trashed')->onlyTrashed();
		});
		$grid->actions(function (Grid\Displayers\Actions $actions) use ($model) {
			if (request('_scope_') == 'trashed') {
				$actions->disableDelete();
				$actions->disableQuickEdit();
				$actions->append(new Restore($model));
			}
		});
		$grid->tools(request('_scope_') == 'trashed' ? new Trashed($grid->resource(),0) :new Trashed($grid->resource()));
		$grid->tools(request('_scope_') == 'trashed' ? new RestoreBatch($model) : '');
	}

	/**
	 * 上下架操作
	 *
	 * @param Grid $grid
	 * @param string $model
	 * @param string $field
	 * @param string | int $fieldValue
	 */
	public function showBatchOnSale(Grid $grid, string $model, string $field, $fieldValue) {
		if (request('_scope_') != 'trashed') {
			if (request()->has('_status')) {
				$grid->model()->where($field, request()->input('_status'));
			} else {
				$grid->model()->where($field, $fieldValue);
			}
			$grid->tools([
				request()->input('_status') == 0 &&
				!is_null(request()->input('_status'))  ? new OnSaleBatch($model) : new OnSaleBatch($model,0)
			]);
		}
	}
}
