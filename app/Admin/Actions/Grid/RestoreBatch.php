<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Actions\Grid;

use App\Traits\BatchTrait;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RestoreBatch extends AbstractTool {
    use BatchTrait;
	public $model;
    protected $style = 'btn btn-success';
	public function __construct(string  $model = null) {
		$title       = admin_trans('cxz.restore');
		$this->model = $model;
		parent::__construct("<i class='feather icon-refresh-ccw'> {$title}</i>");
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
		$model = $request->get('model');
		foreach ($model::withTrashed()->find($keys) as $model) {
			$model->restore();
		}

        return $this->response()->success(admin_trans('cxz.successful_recovery'))->refresh();
	}

	/**
	 * @return string|void
	 */
	protected function href() {
		// return admin_url('auth/users');
	}

	/**
	 * @return string|array|void
	 */
	public function confirm() {
		return [admin_trans('cxz.confirm_restore_select_data')];
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
