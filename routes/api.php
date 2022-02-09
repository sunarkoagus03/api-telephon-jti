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

Route::get("/read", [App\Http\Controllers\ListTelephoneController::class, "index"]);
Route::get("/read/{id}", [App\Http\Controllers\ListTelephoneController::class, "detail"]);
Route::get("/generate", [App\Http\Controllers\ListTelephoneController::class, "generate"]);
Route::post("/create", [App\Http\Controllers\ListTelephoneController::class, "create"]);
Route::put("/update/{id}", [App\Http\Controllers\ListTelephoneController::class, "update"]);
Route::delete("/delete/{id}", [App\Http\Controllers\ListTelephoneController::class, "delete"]);