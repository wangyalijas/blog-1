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
    ],
    function (Router $api) {

        $api->group(['middleware' => 'auth:api'], function (Router $api) {

            $api->get('user', function (Request $request) {
                return $request->user();
            });

        });

    }
);