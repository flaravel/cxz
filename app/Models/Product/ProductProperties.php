<?php

namespace App\Models\Product;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProperties extends Model
{
    use HasFactory,HasDateTimeFormatter;

    protected $fillable = [
        'name', 'value'
    ];
}
