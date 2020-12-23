<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_new')->comment('是否新品 0-否 1-是')->after('on_sale')->default(0);
            $table->boolean('is_recommend')->comment('是否推荐 0-否 1-是')->after('on_sale')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('is_new');
            $table->dropColumn('is_recommend');
        });
    }
}
