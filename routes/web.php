<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
     These are taken care of by laravel
*/
// Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
// Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
// Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', [HomeController::class, 'index'])
     ->middleware('auth')
     ->name('home');


/*
     IF NOT LOGGED IN GOTO LOGIN ELSE GO HOME
*/
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('home')
        : redirect()->route('login');
});