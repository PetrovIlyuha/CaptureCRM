<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModularProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $modules = config('modular.modules');
        $path = config('modular.path');

        if ($modules) {
            Route::group(['prefix' => ''], function() use ($modules, $path) {
               foreach ($modules as $module => $submodules) {
                   foreach ($submodules as $key => $submodule) {
                       $relativePath = "/$module/$submodule";
                       Route::middleware('web')
                           ->group(function() use ($module, $submodule, $relativePath, $path) {
                               $this->getWebRoutes($module, $submodule, $relativePath, $path);
                           });
                       Route::prefix('api')
                           ->middleware('api')
                           ->group(function() use ($module, $submodule, $relativePath, $path) {
                               $this->getApiRoutes($module, $submodule, $relativePath, $path);
                           });

                   }
               }
            });
        }
    }

    private function getWebRoutes(string $module, $submodule, string $relativePath, $path)
    {
        $routesPath = $path.$relativePath."/Routes/web.php";
        if (file_exists($routesPath)) {
            if ($module != config('modular.groupWithoutPrefix')) {
                Route::group(
                    [
                        'prefix' => strtolower($module),
                        'middleware' => $this->getMiddleware($module, 'web')
                    ]
                    ,
                    function() use ($module, $submodule, $routesPath) {
                        Route::namespace("App\Modules\\$module\\$submodule\\Controllers")->
                        group($routesPath);
                });
            } else {
                Route::namespace("App\Modules\\$module\\$submodule\\Controllers")
                    ->middleware($this->getMiddleware($module, 'web'))
                    ->group($routesPath);
            };
        }

    }


    private function getApiRoutes(string $module, $submodule, string $relativePath, $path)
    {
        $routesPath = $path.$relativePath."/Routes/api.php";
        if (file_exists($routesPath)) {
            Route::group(
                [
                    'prefix' => strtolower($module),
                    'middleware' => $this->getMiddleware($module, 'api')
                ]
            , function() use ($module, $submodule, $routesPath) {
                    Route::namespace("App\Modules\\$module\\$submodule\Controllers")->group($routesPath);
            });
        }
    }

    private function getMiddleware(string $module, string $type = 'web'): array
    {
        $middleware = [];
        $config = config('modular.groupMiddleware');
        if (isset($config[$module])) {
            if (array_key_exists($type, $config[$module])) {
                $middleware = array_merge($middleware, $config[$module][$type]);
            }

        }
        return $middleware;
    }
}
