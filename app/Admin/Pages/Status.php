<?php

namespace App\Admin\Pages;

use Dcat\Admin\Support\Helper;
use Illuminate\Contracts\Support\Renderable;

class Status implements Renderable
{
    protected $options = [];

    protected $default;

    public function render()
    {
        if (request('_scope_') != 'trashed') {
            return view('admin.status',$this->options)->render();
        }
    }

    public function default($default) {
        $this->options = array_merge($this->options, ['default' => $default]);
        return $this;
    }

    public function status(array $staus) {
        $this->options = array_merge($this->options, ['status' => Helper::array($staus)]);
        return $this;
    }
}
