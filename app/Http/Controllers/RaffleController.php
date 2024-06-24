<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function index(){
        $raffles = Raffle::all();
        return view('raffles.rafflesList', compact('raffles'));
    }
}
