<?php

namespace tip\tipsystem;

use tip\tipsystem\Models\Blogcategory;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class TipSystemServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        
        $this->publishes([
            __DIR__ . '/components' => resource_path('assets/js/components'),
        ], 'tip-components');

        $this->publishes([
            __DIR__ . '/Middleware' => app_path('Http/Middleware'),
        ], 'tip-middleware-role');

        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
        ], 'tip-migrations');


        
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if (file_exists($file = __DIR__ .'/Helpers/TipSystemHelper.php')) {
            require $file;
        }


        if ((DB::connection()->getDatabaseName()) && (Schema::hasTable('tipcategories'))) {

            $tipcategories['all'] = TipCategory::all();

            app()->global = [

                'tipcategories' => $tipcategories,

            ];

            // Also share $tipcategories
            view()->share(compact('tipcategories'));

        }

    }


    public function register()
    {
        $this->app->bind('tipcategory','tip\tipsystem\TipsCategoriesController');
        $this->app->bind('tip','tip\tipsystem\TipsController');
        $this->app->make('tip\tipsystem\TipsCategoriesController');
        $this->app->make('tip\tipsystem\TipsController');

    }
}
