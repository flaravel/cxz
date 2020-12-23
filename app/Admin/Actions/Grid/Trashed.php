<?php

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Trashed extends AbstractTool
{
    /**
     * @return string
     */
    protected $style = 'btn btn-primary';

    protected $resource;

    public function __construct(string  $resource = null) {
        $title       = admin_trans('cxz.trashed');
        $this->resource = $resource;
        parent::__construct("<i class='feather icon-trash-2'> {$title}</i>");
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
            ->redirect($request->resource.'?_scope_=trashed');
    }
    /**
     * @return string|void
     */
    protected function href()
    {
         return admin_url(request()->route()->uri().'?_scope_=trashed');
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
            'resource' => $this->resource
        ];
    }
}
