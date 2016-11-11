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
Route::group(["namespace" => 'User',"prefix" => "user","middleware" => "web"], function()
{
    Route::get('/', ['as' => 'user.login', 'uses' => 'LoginController@index']);
    Route::get('logout', ['as' => 'user.logout', 'uses' => 'LoginController@logout']);

});

//Social Login
Route::group(["namespace" => 'User', 'middlewareGroups' => ["web"]], function()
{
    Route::get('/redirect/{provider}', ['uses' => 'SocialLoginController@redirect', 'as' => 'social.login']);
    Route::get('/callback/{provider}', ['uses' => 'SocialLoginController@callback']);

});

//After Login Panel
Route::group(["namespace" => 'User', 'middleware' => ['web','auth.user'], 'prefix' => 'user'], function() {

    //region Event Routes
    Route::resource('event', 'EventController', ["as" => "user"]);
    //endregion
});