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
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Widgets\Tab;

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
	 * 状态查询
	 *
	 * @param Grid $grid
	 * @param string $model
	 * @param string $field
	 * @param string | int $fieldValue
	 */
	public function showStatusFilter(Grid $grid,string $field, $fieldValue) {
		if (request('_scope_') != 'trashed') {
			if (request()->has('_status')) {
				$grid->model()->where($field, request()->input('_status'));
			} else {
				$grid->model()->where($field, $fieldValue);
			}
		}
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

    /**
     * 展示快捷查询状态Tab
     *
     * @param array $status 状态展示数组
     * @param int $default  默认选中
     * @return Tab
     */
	public function showStatusTab(array $status,int $default = 1, Grid $grid = null,string $field = null) {
        $tab = Tab::make()->withCard();
        $tab->setHtmlAttribute('style','margin-top:20px');
        $script = <<<JS
                $('.nav-tabs').css('margin-bottom','0rem')
JS;
        Admin::script($script);
        foreach ($status as $key => $value) {
            if (request()->has('_status')) {
                $status = request()->input('_status') == $key;
            } else {
                $status = $key == $default;
            }
            if (!is_null($grid) && !is_null($field)) {
                $query = get_class($grid->model()->repository()->model())::query();
                $grid->model()->getQueries()->unique()->each(function ($value) use (&$query,$field,$key) {
                    if (in_array($value['method'], ['paginate', 'get', 'orderBy', 'orderByDesc','latest'], true)) {
                        return;
                    }
                    if ($value['method'] == 'where' && in_array($field,$value['arguments'])) {
                        $value['arguments'][1] = $key;
                    }
                    $query = call_user_func_array([$query, $value['method']], $value['arguments'] ?? []);
                });
                $count = $query->count();
            }
            $tab->addLink(isset($count) ? $value."($count)" : $value,url(request()->fullUrlWithQuery(['_status' => $key])),$status);
        }
        return $tab;
    }
}
