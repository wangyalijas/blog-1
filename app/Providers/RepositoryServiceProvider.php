<?php

namespace App\Providers;

use App\Repositories\Eloquent\{
    ArticleRepositoryEloquent, UserRepositoryEloquent
};
use App\Repositories\Interfaces\{
    ArticleRepository, UserRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(ArticleRepository::class, ArticleRepositoryEloquent::class);
        //:end-bindings:
    }
}
