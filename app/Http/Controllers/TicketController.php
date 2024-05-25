<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Validation\ValidationException;
class TicketController extends Controller
{
    public function store(Request $request)
    {

        $luck = $request->input('luck') == 1;
        $id = $request->input('ticket_number');
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

        try {
            $validated = $request->validate([
                'ticket_number' => 'required',
                'purchase_date' => 'required',
                'selected_numbers' => 'required',
                'luck' => 'required'
            ]);

        } catch (ValidationException $e) {
            // Manejar la excepción de validación
            dd($e->validator->errors()->all());
        }

        // Crear el ticket con los números asignados
        $ticket = Ticket::create([
            'id' => $id,
            'date' => $date, // Usar la fecha convertida al formato correcto
            'number_1' => $number_1,
            'number_2' => $number_2,
            'number_3' => $number_3,
            'number_4' => $number_4,
            'number_5' => $number_5,
            'luck' => $luck
        ]);

        return back();
    }
}
