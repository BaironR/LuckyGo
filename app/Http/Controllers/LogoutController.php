<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    // Cerrar sesion
    public function logout(){
        auth()->logout();
        return redirect()->route('loginForm');
    }
}
