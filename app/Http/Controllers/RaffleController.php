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

            if ($currentDate->greaterThan($raffleSunday) && $raffle->status_raffle == 0) {
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

    public function enterNumbers(Request $request, $date_raffle){

        $raffle = Raffle::find($date_raffle);
        $user = auth()->user();
        $entered_date = Carbon::now()->setTimezone('America/Santiago')->format('d/m/Y H:i');

        if($raffle->luck_raffle){
            $raffleNumbers = $request->input('raffle_numbers');
            // Separar los números por el separador ',' para obtener un array de números
            $raffleNumbersArray = explode(',', $raffleNumbers);
            // Asignar los números a las variables number_1 hasta number_5
            $number_1 = (int)$raffleNumbersArray [0];
            $number_2 = (int)$raffleNumbersArray [1];
            $number_3 = (int)$raffleNumbersArray [2];
            $number_4 = (int)$raffleNumbersArray [3];
            $number_5 = (int)$raffleNumbersArray [4];

            $luckNumbers = $request->input('luck_numbers');
            // Separar los números por el separador ',' para obtener un array de números
            $luckNumbersArray = explode(',', $luckNumbers);
            // Asignar los números a las variables number_1 hasta number_5
            $number_6 = (int)$luckNumbersArray [0];
            $number_7 = (int)$luckNumbersArray [1];
            $number_8 = (int)$luckNumbersArray [2];
            $number_9 = (int)$luckNumbersArray [3];
            $number_10 = (int)$luckNumbersArray [4];

            $raffle->winnerNumbers()->createMany([
                ['winner_number' => $number_1],
                ['winner_number' => $number_2],
                ['winner_number' => $number_3],
                ['winner_number' => $number_4],
                ['winner_number' => $number_5]
            ]);

            $raffle->luckWinnerNumbers()->createMany([
                ['luck_winner_number' => $number_6],
                ['luck_winner_number' => $number_7],
                ['luck_winner_number' => $number_8],
                ['luck_winner_number' => $number_9],
                ['luck_winner_number' => $number_10]
            ]);

        } else {
            $raffleNumbers = $request->input('raffle_numbers');
            // Separar los números por el separador ',' para obtener un array de números
            $raffleNumbersArray = explode(',', $raffleNumbers);
            // Asignar los números a las variables number_1 hasta number_5
            $number_1 = (int)$raffleNumbersArray [0];
            $number_2 = (int)$raffleNumbersArray [1];
            $number_3 = (int)$raffleNumbersArray [2];
            $number_4 = (int)$raffleNumbersArray [3];
            $number_5 = (int)$raffleNumbersArray [4];

            $raffle->winnerNumbers()->createMany([
                ['winner_number' => $number_1],
                ['winner_number' => $number_2],
                ['winner_number' => $number_3],
                ['winner_number' => $number_4],
                ['winner_number' => $number_5]
            ]);
        }

        $raffle->user_id = $user->id;
        $raffle->status_raffle = 2;
        $raffle->entered_date = $entered_date;
        $raffle->save();
        $user->raffles_entered = $user->raffles_entered + 1;
        $user->save();
    }
}
