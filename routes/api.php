<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

Route::post('/login',[LoginController::class, 'login'])->name('login');
Route::post('/register',[RegisterController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function(){
    //user profile
    Route::get('/profile/user', function (Request $request) {
        return $request->user();
    });
    //user dashboard
    Route::get('/home/user', [HomeController::class, 'userHome']);
});

Route::middleware('auth:sanctum', AdminMiddleware::class)->group(function(){
    //admin profile
    Route::get('/profile/admin', function (Request $request) {
        return $request->user();
    }); 
    //admin dashboard
    Route::get('/home/admin', [HomeController::class, 'adminHome']);
});