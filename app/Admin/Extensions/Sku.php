<?php

namespace App\Admin\Extensions;

use Dcat\Admin\Form\Field;

class Sku extends Field {

    protected $view = 'admin.sku';

    protected static $js = [
        'https://cdn.jsdelivr.net/npm/vue/dist/vue.js'
    ];
}
