<?php

namespace App\Admin\Actions\Grid;

use App\Traits\BatchTrait;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class IsNewBatch extends AbstractTool
{
    use BatchTrait;
    /**
     * @return string
     */
    protected $model;

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
    public function handle(Request $request)
    {
        return $this->response()
            ->success('Processed successfully.')
            ->redirect('/');
    }

    /**
     * @return string|void
     */
    protected function href()
    {
        // return admin_url('auth/users');
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		// return ['Confirm?', 'contents'];
	}

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [
            'model' => $this->model,
        ];
    }

    protected function script()
    {
        $script = <<<JS

    $("#set_new").on("click",function() {
         var obj = $(this);
         console.log(1)
    })

    $("#cancel_new").on("click",function() {
         var obj = $(this);

    })
JS;
        Admin::script($script);
    }

    protected function html()
    {
        $this->appendHtmlAttribute('class', $this->style);
        dd($this->formatHtmlAttributes());

        return <<<HTML
<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
       {$this->title()}
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item " href="#">设为新品</a>
      <a class="dropdown-item" id="cancel_new" href="#">取消新品</a>
    </div>
  </div>
HTML;
    }
}
