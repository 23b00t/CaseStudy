<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('positions', App\Http\Controllers\PositionController::class);
Route::resource('companys', App\Http\Controllers\CompanyController::class);
Route::resource('categorys', App\Http\Controllers\CategoryController::class);
