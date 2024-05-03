<?php

namespace App\Http\Controllers;

use App\Models\Sorter;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registerForm(){

        return view('auth.register');
    }

    // Intento de iniciar sesion
    public function registerCreate(Request $request){

        $messages = makeMessages1();
        $password = random_int(1, 9) . random_int(0, 9) . random_int(0, 9) . random_int(0, 9) . random_int(0, 9) . random_int(0, 9);
        $age = (int)$request->age;

        // Se validan los datos
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'age' => ['required','integer','min:18','max:65'],
        ], messages: $messages);

        Sorter::create([
            'email' => $request->email,
            'name' => $request->name,
            'age' => $request->age,
            'password' => $password,
            'lotteries_entered' => 0,
            'status' => true
        ]);

        auth()->attempt([
            'email' => $request->email,
            'password' => $password,
        ]);

        return redirect()->route('sorters');
    }
}
