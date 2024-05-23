<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin, 0')->latest()->paginate(50);
        return view (view:'index');


    }
}
