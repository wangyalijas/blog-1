<?php

use Dingo\Api\Routing\Router;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** @var Router $api */
$api->version(
    'v1',
    [
        'middleware' => ['api',],
        'namespace' => '\\App\\Http\\API\\Controllers',
    ],
    function (Router $api) {

        $api->group(['middleware' => 'auth:api,console_api'], function (Router $api) {

            $api->group(['prefix' => 'user'], function (Router $api) {
                $api->get('user', 'UsersController@me')->name('auth.user');
            });

            $api->group(['prefix' => 'users'], function (Router $api) {
                $api->get('/', 'UsersController@index')->name('users.list');
                $api->get('/{id}', 'UsersController@show')->name('users.show');
                $api->post('/', 'UsersController@store')->name('users.store');
                $api->put('/{id}', 'UsersController@update')->name('users.update');
                $api->delete('/{id}', 'UsersController@destroy')->name('users.destroy');
            });

            $api->group(['prefix' => 'articles'], function (Router $api) {
                $api->get('/', 'ArticlesController@index')->name('articles.list');
                $api->get('/{id}', 'ArticlesController@show')->name('articles.show');
                $api->post('/', 'ArticlesController@store')->name('articles.store');
                $api->put('/{id}', 'ArticlesController@update')->name('articles.update');
                $api->delete('/{id}', 'ArticlesController@destroy')->name('articles.destroy');
                $api->delete('/', 'ArticlesController@destroyMany')->name('articles.destroy_many');
            });

        });

    }
);
