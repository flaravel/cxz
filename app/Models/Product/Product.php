<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Models\Product;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Product\Product
 *
 * @property int $id
 * @property int $brand_id 品牌ID
 * @property int $category_id 分类ID
 * @property int $delivery_id 配送模版ID
 * @property string $product_name 产品名称
 * @property string $selling_point 产品卖点
 * @property string $product_image 产品主图
 * @property string $product_banner 产品Banner 逗号分割
 * @property string $price 产品售价
 * @property string $market_price 产品市场价格
 * @property int $on_sale 是否上架 0-下架 1-上架
 * @property int $sort 排序 数字越大越靠前
 * @property int $stock 库存
 * @property int $is_new 是否新品 0-否 1-是
 * @property int $sales_actual 实际销量
 * @property int $sales_initial 初始销量
 * @property string $content 产品详情
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Query\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Product withoutTrashed()
 */
class Product extends Model {
	use HasFactory,HasDateTimeFormatter,SoftDeletes;

	protected $casts = [
	    'product_banner' => 'json'
    ];
	/**
	 * 分类
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category() {
		return $this->belongsTo(ProductCategory::class);
	}

	/**
	 * 品牌
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function brand() {
		return $this->belongsTo(ProductBrand::class);
	}

    /**
     * 属性
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function properties() {
        return $this->hasMany(ProductProperties::class,'product_id','id');
    }
}
