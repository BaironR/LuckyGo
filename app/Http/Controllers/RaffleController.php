<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function index(){
        $raffles = Raffle::all();

        $currentDate = Carbon::now();

        foreach ($raffles as $raffle) {

            $raffleSunday = $raffle->date_raffle;

            if ($currentDate->greaterThan($raffleSunday) && $raffle->status == 0) {
                $raffle->status_raffle = 1;
                $raffle->save();
            }
        }
        return view('raffles.rafflesList', compact('raffles'));
    }

    public function enterNumbersForm($date_raffle){
        $raffle = Raffle::find($date_raffle);

        $formattedDate = ucfirst(Carbon::parse($raffle->date_raffle)->locale('es')->isoFormat('dddd D [de] MMMM [del] YYYY'));
        return view('raffles.registerLottery', compact('raffle', 'formattedDate'));
    }

    public function enterNumbers($request, $raffle){

        dd($request);
        $formattedDate = ucfirst(Carbon::parse($raffle->date_raffle)->locale('es')->isoFormat('dddd D [de] MMMM [del] YYYY'));
        return view('raffles.registerLottery', compact('raffle', 'formattedDate'));
    }
}
