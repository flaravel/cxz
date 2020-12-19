<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\MigrateTrait;


class ProductBrand extends Migration
{
    use MigrateTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_brand', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->comment('品牌名称')->default('');
            $table->string('desc')->comment('品牌描述')->default('');
            $table->string('logo_url')->comment('品牌LOGO')->default('');
            $table->boolean('on_sale')->comment('0-下架 1-上架')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        $this->createTableName('product_brand','品牌表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
