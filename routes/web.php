<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/planes', function () {
        return view('planes');
    })->name('planes');

    Route::get('/sesiones', function () {
        return view('sesiones');
    })->name('sesiones');

    Route::get('/bloques', function () {
        return view('bloques');
    })->name('bloques');

    Route::get('/resultados', function () {
        return view('resultados');
    })->name('resultados');

    Route::get('/editarperfil', function () {
        return view('editarperfil');
    })->name('editarperfil');

    Route::get('/CrearBloque', function () {
        return view('crearbloque');
    })->name('crearbloque');

});

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('home')
        : redirect()->route('login');
});
