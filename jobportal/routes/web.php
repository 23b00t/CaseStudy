<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Use of authentification middleware
Route::middleware('auth')->group(function () {
    // Auto-generated Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD routes
    Route::resource('positions', App\Http\Controllers\PositionController::class);
    Route::resource('companys', App\Http\Controllers\CompanyController::class);
    Route::resource('categorys', App\Http\Controllers\CategoryController::class);
});


require __DIR__.'/auth.php';
