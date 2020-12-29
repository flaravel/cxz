<?php
namespace Flaravel\Dcat\Http\Feild;

use Dcat\Admin\Form\Field;

class Sku extends Field {

    protected $view = 'flaravel.dcat::index';

    protected static $js = [
        'https://cdn.jsdelivr.net/npm/vue/dist/vue.js'
    ];
}
