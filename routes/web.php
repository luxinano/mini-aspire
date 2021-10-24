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
Route::post('session', [\App\Http\Controllers\SessionController::class, 'store'])
    ->name('api.session.store');

Route::delete('session', [\App\Http\Controllers\SessionController::class, 'destroy'])
    ->name('api.session.destroy');

Route::get('/', function () {
    return view('welcome');
});
