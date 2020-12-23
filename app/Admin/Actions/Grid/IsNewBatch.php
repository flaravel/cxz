<?php

namespace App\Admin\Actions\Grid;

use App\Traits\BatchTrait;
use Dcat\Admin\Actions\Response;
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
    protected $style = 'btn btn-primary';

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
}
