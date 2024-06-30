<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Billetes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="container mx-auto bg-white shadow-lg rounded-lg p-8 relative">
    <a href="{{ route('buyTickets') }}" class="absolute top-4 right-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Volver</a>
    <h1 class="text-3xl font-bold text-center mb-4">Verificador de Billetes</h1>
    <form class="text-center mb-6" method="POST" action="{{route('checkTicket')}}">
        @csrf
        <label for="id" class="block text-lg mb-2">Ingresa el código de tu billete:</label>
        <input type="text" id="id" name="id" class="border border-gray-300 rounded px-4 py-2 mb-4">
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Verificar</button>
    </form>

    <!-- Manejo de errores -->
    @if ($errors->any())
        <div class="text-red-500 text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="result">
        <h2 class="text-2xl font-bold text-center mb-4">Detalles de tu Billete</h2>
        <table class="w-full mb-4 border-collapse border border-gray-300">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Fecha del Billete</th>
                <th class="border border-gray-300 px-4 py-2">Números Jugados</th>
            </tr>
            <tr>
                <td id="fechaBillete" class="border border-gray-300 px-4 py-2">{{$ticket->date}}</td>
                <td id="numerosJugados" class="border border-gray-300 px-4 py-2">{{$ticket->number_1 . '  ' .
                $ticket->number_2 . '  ' . $ticket->number_3 . '  ' . $ticket->number_4 . '  ' . $ticket->number_5}}</td>
            </tr>
        </table>
        <h2 class="text-2xl font-bold text-center mb-4">Detalles del Sorteo</h2>
        <table class="w-full mb-4 border-collapse border border-gray-300">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Fecha del Sorteo</th>
                <th class="border border-gray-300 px-4 py-2">Números Ganadores</th>
                <th class="border border-gray-300 px-4 py-2">Números Ganadores "Tendré Suerte"</th>
            </tr>
            <tr>
                <td id="fechaSorteo" class="border border-gray-300 px-4 py-2">{{$ticket->raffle->entered_date}}</td>
                <td id="numerosGanadores" class="border border-gray-300 px-4 py-2">
                    @if($ticket->raffle->winnerNumbers->isEmpty())
                        &nbsp;
                    @else
                        @foreach($ticket->raffle->winnerNumbers as $winnerNumber)
                            {{$winnerNumber->winner_number . ' - '}}
                        @endforeach
                    @endif
                </td>
                <td id="numerosTendreSuerte" class="border border-gray-300 px-4 py-2">
                    @if($ticket->raffle->luck_raffle)
                        @if($ticket->raffle->luckWinnerNumbers->isEmpty())
                            &nbsp;
                        @else
                            @foreach($ticket->raffle->luckWinnerNumbers as $luckWinnerNumber)
                                {{$luckWinnerNumber->luck_winner_number . '  '}}
                            @endforeach
                        @endif
                    @endif
                </td>
            </tr>
        </table>

        @php
            use Carbon\Carbon;
             // Obtener las fechas
             $now = Carbon::now('America/Santiago')->toDateString();
             $dateRaffle = Carbon::parse($ticket->raffle->date_raffle);
        @endphp

        @if ($now <= ($dateRaffle))
            <p id="premio" class="text-xl font-bold text-center text-red-600">El sorteo aún sigue abierto</p>
        @elseif ($ticket->raffle->status_raffle == 2)
            @if ($ticket->is_winner || $ticket->is_luck_winner)
                <p id="premio" class="text-xl font-bold text-center text-green-600">¡Tienes premio!</p>
            @else
                <p id="premio" class="text-xl font-bold text-center text-red-600">No tienes premio</p>
            @endif
        @else
            <p id="premio" class="text-xl font-bold text-center text-red-600">El sorteo aún no ha sido ingresado</p>
        @endif

        <table class="w-full mt-4 border-collapse border border-gray-300">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Sorteo principal</th>
                <th class="border border-gray-300 px-4 py-2">"Tendré Suerte"</th>
            </tr>
            <tr>
                @if ($ticket->is_winner)
                    <td id="premioPrincipal" class="border border-gray-300 px-4 py-2">$400.000</td>
                @else
                    <td id="premioPrincipal" class="border border-gray-300 px-4 py-2">Sin Premio</td>
                @endif

                @if ($ticket->luck)
                        @if ($ticket->is_luck_winner)
                            <td id="premioTendreSuerte" class="border border-gray-300 px-4 py-2">$200.000</td>
                        @else
                            <td id="premioTendreSuerte" class="border border-gray-300 px-4 py-2">Sin Premio</td>
                        @endif
                @else
                     <td id="premioTendreSuerte" class="border border-gray-300 px-4 py-2">No participaste</td>
                @endif

            </tr>
        </table>
    </div>
</div>
</body>
</html>
