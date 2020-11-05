<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// login and register users
Route::middleware('return-json:api')->post('register', 'App\Http\Controllers\RegisterController@register');
    
Route::middleware('return-json:api')->post('login', 'App\Http\Controllers\RegisterController@login');


Route::group(['middleware' => ['return-json:api', 'auth:api']], function(){

    Route::get('grants', 'App\Http\Controllers\GrantController@fetchAllGrants');

    Route::get('grants/{name}', 'App\Http\Controllers\GrantController@getGrant');

    Route::post('grants', 'App\Http\Controllers\GrantController@createGrant');

    Route::put('grants/{name}', 'App\Http\Controllers\GrantController@updateGrant' );

    Route::delete('grants/{name}', 'App\Http\Controllers\GrantController@deleteGrant');


});
