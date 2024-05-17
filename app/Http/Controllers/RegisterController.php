<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\PasswordMailable;
use Illuminate\Support\Facades\Mail;
use Exception;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    // Función para generar los mensajes de validación personalizados
    private function makeMessagesRegister()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'age.required' => 'La edad es obligatoria.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'Debe tener al menos 18 años.',
            'age.max' => 'No puede tener más de 65 años.',
        ];
    }

    public function registerCreate(Request $request)
    {
        $messages = $this->makeMessagesRegister();
        $password = mt_rand(100000, 999999);
        $age = (int)$request->age;

        // Se validan los datos
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'age' => ['required', 'integer', 'min:18', 'max:65'],
        ], $messages);

        try {
            // Intenta enviar un correo de prueba para verificar la conexión
            Mail::to($request->email)->send(new PasswordMailable($password));

            // Si el envío del correo fue exitoso, registra al usuario
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

            auth()->attempt([
                'email' => $request->email,
                'password' => $password,
            ]);

            return redirect()->route('sorters');

        } catch (Exception $e) {
            // Si hay una excepción, retorna con un mensaje de error
            if ($e->getCode() == 0) {
                return back()->with('error', 'No hay conexión a internet.');
            }
            return back()->with('error', 'Ocurrió un error al enviar el correo.');
        }
    }
}
