<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Admin\Actions\Grid;

use App\Models\Product\Product;
use App\Traits\BatchTrait;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class IsNewBatch extends AbstractTool {
	use BatchTrait;

    /**
     * @var Product
     */
	protected $model;

	protected $style = 'dropdown-item';

	public function __construct(string $model = null) {
		$title       = admin_trans('cxz.new');
		parent::__construct("<i class='feather icon-star'> {$title}</i>");
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
        if ($model::query()->whereIn('id', $keys)->update(['is_new' =>  $request->input('is_new')])) {
            return $this->response()->success(admin_trans('cxz.action_success'))->refresh();
        } else {
            return $this->response()->error(admin_trans('cxz.action_error'))->refresh();
        }
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
    action.options.data.is_new = data.new;
}
JS;
    }

	protected function html() {
        $this->appendHtmlAttribute('class', $this->style);
		return <<<HTML
<div class="btn-group">
    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
       {$this->title()}
    </button>
    <div class="dropdown-menu">
      <a {$this->formatHtmlAttributes()} data-new="1" href="javascript:void(0)">设为新品</a>
      <a {$this->formatHtmlAttributes()} data-new="0" href="javascript:void(0)">取消新品</a>
    </div>
  </div>
HTML;
	}
}
