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

/**
 * App\Models\Product\ProductBrand
 *
 * @property int $id
 * @property string $brand_name 品牌名称
 * @property string $desc 品牌描述
 * @property string $logo_url 品牌LOGO
 * @property int $on_sale 0-下架 1-上架
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductBrand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereLogoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductBrand withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductBrand withoutTrashed()
 */
class ProductBrand extends Model {
	use HasFactory,HasDateTimeFormatter,SoftDeletes,OnSaleTrait;

	protected $fillable = [
		'brand_name', 'desc', 'logo_url', 'on_sale'
	];
}
