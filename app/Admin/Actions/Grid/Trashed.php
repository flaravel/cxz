<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Actions\Grid;

use App\Models\Product\Product;
use App\Models\Product\ProductBrand;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Trashed extends AbstractTool {
	/**
	 * @return string
	 */
	protected $style = 'btn btn-primary';

	protected $resource;

	protected $type;  // 1回收站 0 返回

	public function __construct(string  $resource = null,int $type = 1,string $model = null) {
		$title          = $type ? admin_trans('cxz.trashed') : admin_trans('cxz.back');
        $icon           = $type ? 'icon-trash-2' : 'icon-repeat';
		$this->resource = $resource;
		$this->type = $type;
        $count = is_null($model) ? 0 : $model::query()->onlyTrashed()->count();
        $title = $count > 0 ? $title."({$count})" : $title;
		parent::__construct("<i class='feather {$icon}'> {$title}</i>");
	}
	/**
	 * Handle the action request.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function handle(Request $request) {
	    if ($request->input('type')) {
            return $this->response()
                ->redirect($request->resource.'?_scope_=trashed');
        } else {
            return $this->response()
                ->redirect($request->resource);
        }
	}
	/**
	 * @return string|void
	 */
	protected function href() {
		return admin_url(request()->route()->uri().'?_scope_=trashed');
	}

	/**
	 * @return string|array|void
	 */
	public function confirm() {
		// return ['Confirm?', 'contents'];
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
			'resource' => $this->resource,
			'type' => $this->type,
		];
	}
}
