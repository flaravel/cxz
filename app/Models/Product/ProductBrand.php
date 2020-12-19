<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Models\Product;

use App\Traits\OnSaleTrait;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBrand extends Model {
	use HasFactory,HasDateTimeFormatter,SoftDeletes,OnSaleTrait;

	protected $fillable = [
		'brand_name', 'desc', 'logo_url', 'status'
	];
}
