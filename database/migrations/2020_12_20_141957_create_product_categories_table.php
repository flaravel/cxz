<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    use \App\Traits\MigrateTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级菜单ID');
            $table->string('category_name',30)->comment('分类名称')->default('');
            $table->string('category_image')->comment('分类图片')->default('');
            $table->unsignedInteger('sort')->comment('排序')->default(0);
            $table->text('path')->comment('父级菜单id 1-2-3-4');
            $table->boolean('on_sale')->default(0)->comment('是否展示菜单 0不展示 1展示');
            $table->timestamps();
            $table->softDeletes();
            $table->index('parent_id','idx_parent_id');
        });
        $this->createTableName('product_categories','产品分类表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}
