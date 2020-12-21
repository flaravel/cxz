<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Traits;

use App\Admin\Actions\Grid\Restore;
use App\Admin\Actions\Grid\RestoreMany;
use Dcat\Admin\Grid;

trait AdminTrait {
	/**
	 * 列表搜索展示为panel
	 * @param Grid\Filter $filter
	 * @param bool $withTrashed
	 */
	public function showFilterPanel(Grid\Filter $filter, $withTrashed = false) {
		$filter->panel();
		$filter->expand(true);
		!$withTrashed?:$filter->scope('trashed')->onlyTrashed();
	}

	/**
	 * 删除与恢复
	 *
	 * @param Grid $grid
	 * @param string $model
	 */
	public function showRestore(Grid $grid, string $model) {
		$grid->actions(function (Grid\Displayers\Actions $actions) use ($model) {
			if (request('_scope_') == 'trashed') {
				$actions->disableDelete();
				$actions->append(new Restore($model));
			}
		});
		$grid->batchActions(function (Grid\Tools\BatchActions $batch) use ($model) {
			if (request('_scope_') == 'trashed') {
				$batch->disableDelete();
				$batch->add(new RestoreMany($model));
			}
		});
	}
}
