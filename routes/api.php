<?php

use App\Http\Controllers\User\PlaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RatingController;
use App\Http\Controllers\User\FavoriteController;
use App\Http\Controllers\User\LocationController;

Route::post('/register-admin', 'App\Http\Controllers\Admin\AuthController@register');

///////////////////////////////////////User Public Routes///////////////////////////////////////
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/forgot-password',[AuthController::class,'forgotPassword']);
Route::post('/reset-password',[AuthController::class,'resetPassword']);

///////////////////////////////////////User Protected Routes////////////////////////////////////
Route::group(['middleware'=>['auth:sanctum']], function(){

//profile Routes
Route::post('/store-location',[LocationController::class,'storeLocation']);
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/profile',[ProfileController::class,'getProfile']);
Route::post('/update-profile',[ProfileController::class,'updateProfile']);
Route::post('/change-password',[ProfileController::class,'changePassword']);
Route::delete('/delete-account',[ProfileController::class,'deleteAccount']);

//Review Routes
Route::post('/place/{placeId}/store-review',[ReviewController::class,'store']);
Route::delete('/place/{placeId}/delete-review',[ReviewController::class,'destroy']);

//Places Routes
Route::get('/all-places',[PlaceController::class,'index']);
Route::get('/search',[PlaceController::class,'search']);
Route::get('/place/{id}',[PlaceController::class,'show']);
Route::get('/top-rated-places',[PlaceController::class,'topRated']);
Route::get('/new-places',[PlaceController::class,'newPlaces']);
Route::get('/nearby-places',[PlaceController::class,'getNearbyPlaces']);

// Rating Routes
Route::post('/place/{placeId}/rate',[RatingController::class,'rate']);

// Favorites Routes
Route::get('/favorites',[FavoriteController::class,'index']);
Route::post('/favorites/{placeId}/toggle', [FavoriteController::class, 'toggleFavorite']);

});