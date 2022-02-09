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

Auth::routes();

Route::get("/", function() {
    return redirect("/input");
});

Route::get('/input', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/output', [App\Http\Controllers\HomeController::class, 'output'])->name('output');
Route::get('/auth/redirect', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('google.login');
Route::get('/auth/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('google.callback');