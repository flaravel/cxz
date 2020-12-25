<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Traits;

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
	 */
	public function showRestore(Grid $grid) {
        $model = get_class($grid->model()->repository()->model());
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
		$grid->tools(request('_scope_') == 'trashed' ? new Trashed($grid->resource(),0,$model) :new Trashed($grid->resource(),1,$model));
		$grid->tools(request('_scope_') == 'trashed' ? new RestoreBatch($model) : '');
	}

    /**
     * 根据状态展示上下架按钮
     *
     * @param Grid $grid
     * @param $model
     */
	public function showOnSaleButton(Grid $grid) {
        if (request('_scope_') != 'trashed') {
            $model = get_class($grid->model()->repository()->model());
            $grid->tools([
                !request()->input('_status') &&
                !is_null(request()->input('_status'))  ? new OnSaleBatch($model) : new OnSaleBatch($model,0)
            ]);
        }
    }
}
