<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    use \App\Traits\MigrateTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->comment('品牌ID')->default(0);
            $table->unsignedBigInteger('category_id')->comment('分类ID')->default(0);
            $table->unsignedBigInteger('delivery_id')->comment('配送模版ID')->default(0);
            $table->string('product_name')->comment('产品名称')->default('');
            $table->string('selling_point')->comment('产品卖点')->default('');
            $table->string('product_image')->comment('产品主图')->default('');
            $table->text('product_banner')->comment('产品Banner 逗号分割');
            $table->decimal('price',10,2)->comment('产品售价')->default(0);
            $table->decimal('market_price',10,2)->comment('产品市场价格')->default(0);
            $table->boolean('on_sale')->default(0)->comment('是否上架 0-下架 1-上架');
            $table->unsignedInteger('sort')->default(0)->comment('排序 数字越大越靠前');
            $table->unsignedInteger('stock')->default(0)->comment('库存');
            $table->unsignedInteger('sales_actual')->default(0)->comment('实际销量');
            $table->unsignedInteger('sales_initial')->default(0)->comment('初始销量');
            $table->text('content')->comment('产品详情');
            $table->timestamps();
            $table->softDeletes();
            $table->index('category_id','idx_category_id');
            $table->index('on_sale','idx_on_sale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
