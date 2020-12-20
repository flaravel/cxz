<?php

namespace App\Observers\Product;

use App\Models\Product\ProductCategory;

class ProductCategoryObserve
{
    public function creating(ProductCategory $category) {
        if (is_null($category->parent_id) || $category->parent_id == 0) {
            $category->path  = '-';
        } else {
            $category->path  = $category->parent->path.$category->parent_id.'-';
        }
    }
}
