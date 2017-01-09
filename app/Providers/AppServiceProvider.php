<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    public function map(Router $router, Request $request) {
        $locale = $request->segment(1);
        $this->app->setLocale($locale);

        $router->group(['namespace' => $this->namespace, 'prefix' => $locale], function($router) {
            require app_path('Http/routes.php');
        });
    }

}
