<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Settings;
use App\Models\Category;
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
     
     if(\Schema::hasTable('settings')){
        View::share('Setting',Settings::first());
    }

    if(\Schema::hasTable('categories')){
$cats=Category::limit(3)->get();

        View::share('categories',$cats);
}

    }
}
