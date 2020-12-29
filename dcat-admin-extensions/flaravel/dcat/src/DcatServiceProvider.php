<?php

namespace Flaravel\Dcat;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Flaravel\Dcat\Http\Feild\Sku;

class DcatServiceProvider extends ServiceProvider
{
	public function register()
	{
        Form::extend('sku', Sku::class);
	}

	public function init()
	{
		parent::init();
	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
