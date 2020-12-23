<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Traits;

use Dcat\Admin\Admin;

trait OnSaleTrait {
	public static function DOWN_SALE() {
		return 0;
	}

	public static function ON_SALE() {
		return 1;
	}

	public static $saleMap = [
        1 => '已上架',
		0 => '已下架'
	];
}
