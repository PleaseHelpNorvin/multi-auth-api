<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::post('/login',[LoginController::class, 'login'])->name('login');
Route::post('/register',[RegisterController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::middleware('auth:sanctum', AdminMiddleware::class)->group(function(){

    Route::get('/admin', function (Request $request) {
        return $request->user();
    }); 
});