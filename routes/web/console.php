<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Administrator routes
Route::group(['prefix' => 'console', 'middleware' => 'auth:console'], function () {

    Route::get('/', 'HomeController@index')->name('console.home');

});

// Guest routes
Route::group(['prefix' => 'console'], function () {

    Route::group(['namespace' => 'Auth'], function () {
        // Authentication Routes...
        $this->get('login', 'LoginController@showLoginForm')->name('console.login');
        $this->post('login', 'LoginController@login');
        $this->post('logout', 'LoginController@logout')->name('console.logout');

        // Registration Routes...
        $this->get('register', 'RegisterController@showRegistrationForm')->name('console.register');
        $this->post('register', 'RegisterController@register');

        // Password Reset Routes...
        $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('console.password.request');
        $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('console.password.email');
        $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('console.password.reset');
        $this->post('password/reset', 'ResetPasswordController@reset');
    });

});
