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

use Dcat\Admin\Admin;
use Dcat\Admin\Form;

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
