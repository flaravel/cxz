<?php

namespace App\Providers;

use App\Models\Product\ProductCategory;
use App\Observers\Product\ProductCategoryObserve;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->listenObserve();
    }


    private function listenObserve() {
        // 监听产品分类
        ProductCategory::observe(new ProductCategoryObserve);
    }
}
