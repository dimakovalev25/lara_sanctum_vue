<?php

use App\Http\Controllers\Post\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/get', \App\Http\Controllers\GetController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/get', \App\Http\Controllers\GetController::class);
});


Route::group(['namespace' => 'App\Http\Controllers\Post', 'prefix' => 'posts'], function () {
    Route::post('/', StoreController::class);
     Route::get('/', IndexController::class);
        /*  Route::get('/{post}', PostShowController::class);
        Route::patch('/{post}', PostEditController::class);
         Route::delete('/{post}', PostDeleteController::class);*/
});