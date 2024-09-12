<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResources([
    'positions' => App\Http\Controllers\PositionController::class,
    'companys' => App\Http\Controllers\CompanyController::class,
    'categorys' => App\Http\Controllers\CategoryController::class,
]);
