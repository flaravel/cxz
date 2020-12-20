<?php

namespace App\Traits;

use App\Admin\Actions\Grid\Restore;
use App\Admin\Actions\Grid\RestoreMany;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use Dcat\Admin\Grid;
use Illuminate\Http\Request;

trait RestoreTrait
{
    /**
     * 删除与恢复
     *
     * @param Grid $grid
     * @param string $model
     */
    public function showRestore(Grid $grid, string $model) {
        $grid->actions(function (Grid\Displayers\Actions $actions) use ($model) {
            if (request('_scope_') == 'trashed') {
                $actions->disableDelete();
                $actions->append(new Restore($model));
            }
        });
        $grid->batchActions(function (Grid\Tools\BatchActions $batch) use ($model) {
            if (request('_scope_') == 'trashed') {
                $batch->disableDelete();
                $batch->add(new RestoreMany($model));
            }
        });
    }
}
