<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Traits;

use App\Admin\Actions\Grid\OnSaleDownBatch;
use App\Admin\Actions\Grid\Restore;
use App\Admin\Actions\Grid\RestoreBatch;
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
				$actions->append(new Restore($model));
			}
		});
		$grid->batchActions(function (Grid\Tools\BatchActions $batch) use ($model) {
			if (request('_scope_') == 'trashed') {
				$batch->disableDelete();
				$batch->add(new RestoreBatch($model));
			}
		});
	}

	/**
	 * 批量上下架操作
	 *
	 * @param Grid $grid
	 * @param string $model
	 */
	public function showBatchOnSale(Grid $grid, string $model) {
		$grid->tools(new OnSaleDownBatch($model));
	}
}
