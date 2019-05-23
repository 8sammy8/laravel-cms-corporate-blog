<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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
        Blade::directive('sort_link', function($expression){

            return "<?php echo \App\Repositories\Traits\SortableTrait::link_to(array ({$expression}));?>";

        });

//        DB::listen(function ($query) {
//            echo '<h3 style="color: red">' . $query->sql . '</h3>';
//        });
    }
}
