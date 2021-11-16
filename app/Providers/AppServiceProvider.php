<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        // config 설정
        Config::set('banner', [
                [ 'name' => '메인페이지상단', 'key' => 'main_top', 'page' => 'main', 'position' => 'top', 'image_size' => '720*572' ],
                [ 'name' => '메인페이지하단', 'key' => 'main_bottom', 'page' => 'main', 'position' => 'bottom', 'image_size' => '720*248' ],
                [ 'name' => '교환소상단', 'key' => 'shop_top', 'page' => 'shop', 'position' => 'top', 'image_size' => '720*300' ],
            ]);
    }
}
