<?php

use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(
    ['namespace' => 'Admin\V1', 'prefix' => 'admin/v1'],
    function () {
        Route::get('article', 'ArticleController@index');
        Route::post('article', 'ArticleController@store');
        Route::get('article/{id}', 'ArticleController@show');
        Route::delete('article/{id}', 'ArticleController@destroy');
        Route::put('article/{id}', 'ArticleController@update');
    }
);
