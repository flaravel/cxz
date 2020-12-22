<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\BatchAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OnSaleUpBatch extends BatchAction {
	/**
	 * @var string
	 */
	protected $model;

	public function __construct(string $model = null) {
		$title       = admin_trans('cxz.on_sale_up');
		parent::__construct("<i class='feather icon-arrow-up'> {$title}</i>");
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
		if ($model::query()->whereIn('id', $keys)->update(['on_sale' => $model::ON_SALE()])) {
			return $this->response()->success(admin_trans('cxz.action_success'))->refresh();
		} else {
			return $this->response()->error(admin_trans('cxz.action_error'))->refresh();
		}
	}

	/**
	 * @return string|array|void
	 */
	public function confirm() {
		return [admin_trans('cxz.on_sale_up_confirm')];
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
}
