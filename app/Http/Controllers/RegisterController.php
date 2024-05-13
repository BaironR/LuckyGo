<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\PasswordMailable;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function registerForm(){

        return view('auth.register');
    }

    // Intento de iniciar sesion
    public function registerCreate(Request $request){
        if (connection_status()){
            $messages = makeMessages1();
            $password = mt_rand(100000,999999);
            $age = (int)$request->age;

            // Se validan los datos
            $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'age' => ['required','integer','min:18','max:65'],

            ], messages: $messages);

            $sorter = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'age' => $request->age,
            'password' => $password,
            'lotteries_entered' => 0,
            'status' => true,
            'is_admin' => false,
            'is_sorter' => true
            ]);
        
            Mail::to($request->email)->send(new PasswordMailable($password));

            auth()->attempt([
            'email' => $request->email,
            'password' => $password,
            ]);

            return redirect()->route('sorters');
        }
        return redirect()->route('registerForm');
    }
}
