<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view(view: 'site.buyTickets');
});

Route::post('/tickets', [TicketController::class, 'store']);



// Ruta página de venta de billetes
Route::get('/comprar-billete', [TicketController::class, 'buyTickets'])->name('buyTickets');
Route::post('/comprar-billete', [TicketController::class, 'store'])->name('buyTicket');

// Login y logout de usuarios
Route::get('/iniciar-sesion', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/iniciar-sesion', [LoginController::class, 'login'])->name('login');
Route::get('/cerrar-sesion', [LogoutController::class, 'logout'])->name('logout');

// Revisar billete
Route::get('/revisar-billete', [TicketController::class, 'viewTicket'])->name('viewTicket');

Route::post('/revisar-billete', [TicketController::class, 'checkTicket'])->name('checkTicket');


// Registro

// Validar autenticación al ingresar url
Route::middleware('auth')->group(callback: function(){
    Route::post('/registrar', [RegisterController::class, 'registerCreate'])->name('registerCreate');
    Route::get('/registrar', [RegisterController::class, 'registerForm'])->name('registerForm');
    Route::get('/raffletors', [UserController::class, 'index'])->name('raffletors');
    Route::get('/ingresar-sorteos', [RaffleController::class, 'index'])->name('enterRaffle');
    Route::get('/numeros-ganadores/{date_raffle}', [RaffleController::class, 'enterNumbersForm'])->name('enterNumbersForm');
    Route::post('/numeros-ganadores/{date_raffle}', [RaffleController::class, 'enterNumbers'])->name('enterNumbers');
    Route::post('/actualizar-estado/{id}', [UserController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/cambiar-contraseña', [UserController::class, 'changePasswordForm'])->name('changePasswordForm');
    Route::post('/cambiar-contraseña', [UserController::class, 'changePassword'])->name('changePassword');
});
