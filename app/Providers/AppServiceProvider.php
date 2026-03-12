<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Routing\Router;
use Illuminate\Routing\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // customizing api route by ignoring default routes
        //Scramble::ignoreDefaultRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');

            });
//        Scramble::configure()
//            ->expose(
//                ui: fn (Router $router, $action) => $router
//                    ->domain('docs.example.com')
//                    ->get('docs/api/v1', $action),
//                document: fn (Router $router, $action) => $router
//                    ->domain('docs.example.com')
//                    ->get('docs/v1/openapi.json', $action),
//            );
    }
}
