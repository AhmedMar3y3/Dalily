<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PlaceController;

Route::get('/', [AuthController::class, 'loadLoginPage'])->name('loginPage');
Route::post('/login-admin', [AuthController::class, 'loginUser'])->name('loginUser');

//protected routes
Route::middleware(['auth.admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout'); 
    Route::get('/dashboard', [HomeController::class, 'stats'])->name('admin.dashboard');

    //category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/category/{id}/places', [CategoryController::class, 'viewPlaces'])->name('admin.categories.show');

    //place routes
    Route::get('/place', [PlaceController::class, 'index'])->name('admin.places.index');
    Route::get('/show-place/{id}', [PlaceController::class, 'show'])->name('admin.places.show');
    Route::get('/create-place', [PlaceController::class, 'create'])->name('admin.places.create');
    Route::post('/place', [PlaceController::class, 'store'])->name('admin.places.store');
    Route::get('/edit-place/{id}', [PlaceController::class, 'edit'])->name('admin.places.edit');
    Route::put('/update-place/{id}', [PlaceController::class, 'update'])->name('admin.places.update');
    Route::delete('/delete-place/{id}', [PlaceController::class, 'destroy'])->name('admin.places.destroy');

});

