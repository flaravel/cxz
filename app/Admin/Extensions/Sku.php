<?php

namespace App\Admin\Extensions;

use Dcat\Admin\Form\Field;

class Sku extends Field
{

    protected static $js = [
        '/js/app.js'
    ];

    protected $view = 'admin.sku';
}
