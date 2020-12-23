<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Traits;

trait BatchTrait {

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
}
JS;
    }

    /**
     * @return string
     */
    public function getSelectedKeysScript()
    {
        return "Dcat.grid.selected();";
    }
}
