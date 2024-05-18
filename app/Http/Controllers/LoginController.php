<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    // Formurio de login para sorteadores
    public function loginForm(){

        return view('auth.login');
    }

    // Formulario de login del admin para registrar sorteadores
    public function loginAdminForm(){

        return view('auth.loginAdmin');
    }

    public function login(Request $request){

        $messages = makeMessagesLogin();

        // Se validan los datos
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], $messages);

        // Intento de autenticar al usuario
        if (!auth()->attempt($validated, $request->remember)) {
            return back()->with('message', 'Usuario no registrado o contraseña incorrecta.');
        }

        $user = auth()->user();

        if ($user->is_admin && !$user->is_sorter) {
            return redirect()->route('registerForm');

        } else {
            return redirect()->route('enterLottery');
        }
    }
}
