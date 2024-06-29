<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class TicketController extends Controller
{

    public function buyTickets(){
        return view('site.buyTickets');
    }

    public function store(Request $request)
    {
        $messages = makeMessagesTickets();
        $luck = $request->input('luck') == 1;
        $id = $request->input('id');
        // Obtener la fecha enviada en el request y convertirla al formato YYYY-MM-DD
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('purchase_date'))));

        // Obtener los números enviados en el request
        $selectedNumbers = $request->input('selected_numbers');

        // Separar los números por el separador '-' para obtener un array de números
        $numbersArray = explode(' - ', $selectedNumbers);

        // Asignar los números a las variables number_1 hasta number_5
        $number_1 = (int)$numbersArray[0];
        $number_2 = (int)$numbersArray[1];
        $number_3 = (int)$numbersArray[2];
        $number_4 = (int)$numbersArray[3];
        $number_5 = (int)$numbersArray[4];

        // Verificar si existe un sorteo para el domingo más próximo a la fecha 'date'
        $nextSunday = Carbon::parse($date)->next(Carbon::SUNDAY);
        $existingRaffle = Raffle::where('date_raffle', $nextSunday)->first();

        if (!$existingRaffle) {
            // Si no existe un sorteo para ese domingo, crear uno nuevo
            $total = $luck ? 3000 : 2000;
            $totalLuck = $luck ? 1000 : 0;
            $subtotalOfTickets = 2000;
            $totalOfTickets = 1;

            Raffle::create([
                'date_raffle' => $nextSunday,
                'number_of_tickets' => $totalOfTickets,
                'total' => $total,
                'total_luck' => $totalLuck,
                'subtotal_of_tickets' => $subtotalOfTickets,
                'status_raffle' => 0,
                'luck_raffle' => $luck,
                'entered_date' => null,
                'user_id' => null,
            ]);
        } else {
            // Si ya existe un sorteo para ese domingo, actualizarlo
            $totalOfTickets = $existingRaffle->number_of_tickets + 1;
            $total = $existingRaffle->total + ($luck ? 3000 : 2000);
            $totalLuck = $existingRaffle->total_luck + ($luck ? 1000 : 0);
            $subtotalOfTickets = $existingRaffle->subtotal_of_tickets + 2000;
            $luckRaffle = $luck ? 1 : $existingRaffle->luck_raffle;

            Raffle::where('date_raffle', $nextSunday)->update([
                'number_of_tickets' => $totalOfTickets,
                'total' => $total,
                'total_luck' => $totalLuck,
                'subtotal_of_tickets' => $subtotalOfTickets,
                'luck_raffle' => $luckRaffle,
            ]);
        }

        $validated = $request->validate([
            'id' => ['required', 'unique:tickets'],
            'purchase_date' => 'required',
            'selected_numbers' => 'required',
            'luck' => ['required', 'boolean']
        ], $messages);

        try {

            // Crear el ticket con los números asignados
            $ticket = Ticket::create([
                'id' => $id,
                'date' => $date,
                'number_1' => $number_1,
                'number_2' => $number_2,
                'number_3' => $number_3,
                'number_4' => $number_4,
                'number_5' => $number_5,
                'luck' => $luck,
                'is_winner' => false,
                'date_raffle' => $nextSunday
            ]);


        } catch (ValidationException $e) {
            // Manejar la excepción de validación
            dd($e->validator->errors()->all());
        }

        return back()->with([
            'purchase_successful' => true,
            'id' => $request->input('id'),
            'purchase_date' => $request->input('purchase_date'),
        ]);
    }

}
