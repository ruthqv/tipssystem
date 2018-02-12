<?php
namespace tip\tipsystem;

use tip\tipsystem\Models\TipCategory;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class TipSystemServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        
        $this->publishes([
            __DIR__ . '/js' => resource_path('assets/js'),
        ], 'tip-js-components');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views'),
        ], 'tip-view-main');

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



    }


    public function register()
    {
        $this->app->bind('tip','tip\tipsystem\TipsController');

        $this->app->make('tip\tipsystem\TipsController');

    }
}
