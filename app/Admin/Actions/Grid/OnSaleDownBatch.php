<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Form\AbstractTool;
use Dcat\Admin\Grid\BatchAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OnSaleDownBatch extends AbstractTool {
	/**
	 * @var string
	 */
	protected $model;

	protected $style = 'btn btn-primary';

	public function __construct(string $model = null) {
		$title       = admin_trans('cxz.on_sale_down');
		parent::__construct("<i class='feather icon-arrow-down'> {$title}</i>");
		$this->model = $model;
	}

	/**
	 * Handle the action request.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function handle(Request $request) {
		$keys  = $this->getKey();
		if (empty($keys)) {
            return $this->response()->warning(admin_trans('cxz.please_choose'))->refresh();
        }
		$model = $request->get('model');
		if ($model::query()->whereIn('id', $keys)->update(['on_sale' => $model::DOWN_SALE()])) {
			return $this->response()->success(admin_trans('cxz.action_success'))->refresh();
		} else {
			return $this->response()->error(admin_trans('cxz.action_error'))->refresh();
		}
	}

	/**
	 * @return string|array|void
	 */
	public function confirm() {
		return [admin_trans('cxz.on_sale_down_confirm')];
	}

	/**
	 * @param Model|Authenticatable|HasPermissions|null $user
	 *
	 * @return bool
	 */
	protected function authorize($user): bool {
		return true;
	}

	/**
	 * @return array
	 */
	protected function parameters() {
		return [
			'model' => $this->model,
		];
	}

    protected function actionScript()
    {
        $warning = admin_trans('cxz.please_choose');

        return <<<JS
function (data, target, action) {
    var key = {$this->getSelectedKeysScript()}

    if (key.length === 0) {
        Dcat.warning('{$warning}');
        return false;
    }

    // 设置主键为复选框选中的行ID数组
    action.options.key = key;
}
JS;
    }

    /**
     * @return string
     */
    public function getSelectedKeysScript()
    {
        return "Dcat.grid.selected();";
    }
}
