<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResources([
    'positions' => PositionController::class,
    'companys' => CompanyController::class,
    'categorys' => CategoryController::class,
]);
