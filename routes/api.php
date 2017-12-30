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

        $api->group(['middleware' => 'auth:api'], function (Router $api) {

            $api->group(['prefix' => 'user'], function (Router $api) {
                $api->get('user', 'UsersController@me')->name('auth.user');
            });

            $api->group(['prefix' => 'users'], function (Router $api) {
                $api->get('/', 'UsersController@index')->name('users.index');
                $api->get('/{id}', 'UsersController@show')->name('users.show');
                $api->post('/', 'UsersController@store')->name('users.store');
                $api->put('/{id}', 'UsersController@update')->name('users.update');
                $api->delete('/{id}', 'UsersController@destroy')->name('users.destroy');
            });

        });

    }
);
