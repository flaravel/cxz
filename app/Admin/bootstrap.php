<?php

/**
 * This file is part of Cxz
 *
 * (c) Flaravel 2020 <https://github.com/flaravel/cxz>
 *
 *  document https://learnku.com/blog/FLaravel
 *
 * visited
 */

use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Grid;
use App\Admin\Extensions\Sku;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
Filter::resolving(function (Filter $filter) {
    $filter->panel();
    $filter->expand();
});

Grid::resolving(function (Grid $grid) {
    $grid->model()->latest('id');
    $grid->disableViewButton();
    $grid->showQuickEditButton();
    $grid->enableDialogCreate();
    $grid->disableRefreshButton();
    $grid->disableFilterButton();
    $grid->disableBatchActions();
    $grid->actions(function (Grid\Displayers\Actions $actions) {
        $actions->disableView();
        $actions->disableEdit();
    });
    $grid->option('dialog_form_area',['60%','80%']);
    $grid->toolsWithOutline(false);
    if (request('_scope_') == 'trashed') {
        $grid->disableCreateButton();
    }
});

Form::resolving(function (Form $form) {
    $form->disableViewButton();
    $form->disableDeleteButton();
    $form->disableEditingCheck();
    $form->disableViewCheck();
    $form->disableCreatingCheck();
});

Form::extend('sku', Sku::class);
Form::extend('ueditor', \App\Admin\Extensions\Ueditor::class);

