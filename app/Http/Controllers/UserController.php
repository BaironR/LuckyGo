<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    public function changePasswordForm()
    {
        return view('raffletor.changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with('status', '¡Contraseña cambiada exitosamente! Por favor, inicie sesión con su nueva contraseña.');
    }


    public function editProfileForm()
    {
        return view('raffletor.changePersonalData');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:65',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->age = $request->age;
        $user->save();

        return redirect()->route('enterRaffle')->with('status', '¡Perfil actualizado exitosamente!');
    }
}
