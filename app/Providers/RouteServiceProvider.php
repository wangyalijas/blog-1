<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Web\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $route = Route::middleware('web');

        // Front end routers
        $route->namespace($this->getFrontEndNamespace())
            ->group(base_path('routes/web/front_end.php'));

        // Back end routers
        $route->namespace($this->getConsoleNamespace())
            ->group(base_path('routes/web/console.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $api = app('Dingo\\Api\\Routing\\Router');

        require base_path('routes/api.php');
    }

    private function getFrontEndNamespace()
    {
        return "{$this->namespace}\\FrontEnd";
    }

    private function getConsoleNamespace()
    {
        return "{$this->namespace}\\Console";
    }
}
