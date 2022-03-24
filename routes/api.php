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
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware('cors')->group(function(){
    Route::get('/capsules', 'CapsulesAPIController@get_all_data');
    Route::get('/capsules/{capsule_serial}', 'CapsulesAPIController@get_with_serial');
});
