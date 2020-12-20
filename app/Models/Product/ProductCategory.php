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
use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductCategory
 *
 * @package App\Models\Product
 * @property int $id
 * @property int $parent_id 父级菜单ID
 * @property string $category_name 分类名称
 * @property string $category_image 分类图片
 * @property int $sort 排序
 * @property string $path 父级菜单id 1-2-3-4
 * @property int $on_sale 是否展示菜单 0不展示 1展示
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCategoryImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereOnSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ProductCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductCategory withoutTrashed()
 * @mixin \Eloquent
 * @property-read ProductCategory $parent
 */
class ProductCategory extends Model {
	use HasFactory,HasDateTimeFormatter,OnSaleTrait,SoftDeletes,ModelTree;

    protected $titleColumn = 'category_name';

    protected $orderColumn = 'sort';

    protected $parentColumn = 'parent_id';

	protected $fillable = [
		'parent_id', 'category_name', 'category_image', 'sort', 'path', 'on_sale'
	];

	/**
	 * 获取父级
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parent() {
		return $this->belongsTo(ProductCategory::class);
	}
}
