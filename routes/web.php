<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SorterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view(view: 'auth.login');
});

// Login y logout de usuarios
Route::get('/login-sorters', [LoginController::class, 'loginForm'])->name('loginForm');
Route::get('/login-admin', [LoginController::class, 'loginAdminForm'])->name('loginAdminForm');
Route::post('/login-sorters', [LoginController::class, 'loginSorters'])->name('loginSorters');
Route::post('/login-admin', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Registro

// Validar autenticación al ingresar url
Route::middleware('auth')->group(callback: function(){
    Route::post('/register', [RegisterController::class, 'registerCreate'])->name('registerCreate');
    Route::get('/register', [RegisterController::class, 'registerForm'])->name('registerForm');
    Route::get('/sorters', [SorterController::class, 'index'])->name('sorters');
    Route::get('/enter-lottery', [PageController::class, 'page'])->name('enterLottery');
});
