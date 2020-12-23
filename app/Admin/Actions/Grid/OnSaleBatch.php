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
use Dcat\Admin\Form\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OnSaleBatch extends AbstractTool {
    use BatchTrait;
	/**
	 * @var string
	 */
	protected $model;

    protected $style = 'btn btn-primary';

    protected $type = null;  // 1上架 0 下架

	public function __construct(string $model = null,int $type = 1) {
		$title       = $type ? admin_trans('cxz.on_sale_up') : admin_trans('cxz.on_sale_down');
		$icon        = $type ? 'icon-arrow-up' : 'icon-arrow-down';
		parent::__construct("<i class='feather {$icon}'> {$title}</i>");
		$this->model = $model;
		$this->type = $type;
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
		$model = $request->input('model');
        $status = $request->input('type') ? $model::ON_SALE() : $model::DOWN_SALE();
		if ($model::query()->whereIn('id', $keys)->update(['on_sale' => $status])) {
			return $this->response()->success(admin_trans('cxz.action_success'))->refresh();
		} else {
			return $this->response()->error(admin_trans('cxz.action_error'))->refresh();
		}
	}

	/**
	 * @return string|array|void
	 */
	public function confirm() {
		return [$this->type ? admin_trans('cxz.on_sale_up_confirm') : admin_trans('cxz.on_sale_down_confirm')];
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
			'type' => $this->type,
		];
	}
}
