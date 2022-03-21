<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
})->name('site.main');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/clients', 'AuthController@clients')->middleware(['auth'])->name('dashboard.clients');

Route::get('/login', function() {
    return view('auth.login');
})->middleware('guest')->name('login');
Route::post('/login', 'AuthController@login')->middleware('guest');

Route::post('/logout', 'AuthController@logout')->middleware('auth')->name('logout');