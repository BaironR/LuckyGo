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

        $messages = makeMessages();

        // Se validan los datos
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], $messages);

        // Verificar credenciales específicas
        if ($validated['email'] !== 'antonio.barraza.guzman@gmail.com' || $validated['password'] !== 'Luckygo23') {
            return back()->with('message', 'Credenciales incorrectas.');
        }

        // Intento de autenticar al usuario
        if (!auth()->attempt($validated, $request->remember)) {
            return back()->with('message', 'Usuario no registrado o contraseña incorrecta.');
        }

        return redirect()->route('registerForm');
    }

    // Intento de iniciar sesion
    public function loginSorters(Request $request){

        $messages = makeMessages();

        // Se validan los datos
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], messages: $messages);

        // Intento de autenticar al usuario

        if(!auth()->attempt($request->only('email','password'), remember: $request->remember)){
            return redirect()->back()->with('message', 'Usuario no registrado o contraseña incorrecta.');
        }

        return redirect()->route('enterLottery');
    }
}
