<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id', '!=', 1)->get();
        return view('raffletor.raffletorList', compact('users'));
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::find($id);

        if ($user){
            $user->status = $request->input('status');
            $user->save();

            return redirect()->route('raffletors')->with('success', 'Estado actualizado correctamente');
        }
    }

    public function changePasswordForm(){
        $user = auth()->user();
        return view('raffletor.changePassword');
    }

    public function changePassword(Request $request)
    {

        // Validación de los datos del formulario
        $request->validate([
            'new-password' => ['required', 'string', 'min:6'],
        ]);

        try {
            // Obtenemos el usuario autenticado
            $user = auth()->user();
            // Actualizamos la contraseña del usuario
            $user->password = Hash::make($request->input('new-password'));
            $user->save();

            return redirect()->route('enterRaffle')->with('success', 'Contraseña cambiada exitosamente');
        } catch (ValidationException $e) {
            // Manejar el caso específico de validación fallida
            return back()->withErrors($e->validator->errors())->withInput();
        } catch (Exception $e) {
            // Manejar otras excepciones inesperadas
            return back()->withErrors(['error' => 'Ha ocurrido un error al cambiar la contraseña.'])->withInput();
        }
    }
}
