<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Restore extends RowAction {
	/**
	 * @var string
	 */
	protected $model;

	public function __construct(string $model = null) {
		parent::__construct('<i class="feather icon-refresh-ccw"></i>');
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
		$key   = $this->getKey();
		$model = $request->get('model');

		$model = $model::withTrashed()->findOrFail($key);
		$model->restore();

		return $this->response()->success(admin_trans('cxz.successful_recovery'))->refresh();
	}

	/**
	 * @return string|array|void
	 */
	public function confirm() {
		return [admin_trans('cxz.confirm_restore_data')];
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
