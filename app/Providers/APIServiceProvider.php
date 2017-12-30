<?php

namespace App\Providers;

use Dingo\Api\Exception\Handler;
use Dingo\Api\Exception\ResourceException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ServiceProvider;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class APIServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $handler = $this->app->make(Handler::class);

        $handler->register(function (AuthenticationException $exception) {
            throw new UnauthorizedHttpException(null, $exception->getMessage(), $exception);
        });

        $handler->register(function (AuthorizationException $exception) {
            throw new AccessDeniedHttpException($exception->getMessage(), $exception);
        });

        $handler->register(function (ModelNotFoundException $exception) {
            throw new NotFoundHttpException(trans("No results found."), $exception);
        });

        $handler->register(function (ValidatorException $exception) {
            $messageBag = $exception->getMessageBag();
            throw new ResourceException($messageBag->first(), $messageBag->all(), $exception);
        });
    }
}
