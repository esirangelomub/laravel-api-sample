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
Route::get('health', 'HealthController@health');
Route::post('/auth/login', 'AuthController@login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('criar-material-indireto', 'CriarMaterialIndiretoController')->only(['index','store']);
    Route::resource('material', 'CriarMaterialIndiretoController')->only(['index','store']);
});
