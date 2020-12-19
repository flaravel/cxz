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

namespace App\Models\Product;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBrand extends Model {
	use HasFactory,HasDateTimeFormatter,SoftDeletes;

	protected $fillable = [
		'brand_name', 'desc', 'logo_url', 'status'
	];

	protected $casts = [
		'status' => 'boolean'
	];
}
