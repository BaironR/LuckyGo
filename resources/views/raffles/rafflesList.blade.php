@extends('layouts.app')
@section('content')
<style>
    table, th, td
    {
      border: 1px solid black;
      border-collapse: collapse;
    }
</style>
<div class="lg:w-3/4 xl:w-2/3 mx-auto py-8 px-6 bg-white rounded-xl">

    <h1 class="font-bold text-5xl text-center mb-8">Listado de Sorteos</h1>

        <div>
            <table class="w-full text-md bg-white shadow-md rounded mb-4" id="sorteosTable">
                <thead>
                <tr>
                    <th class="text-middle bg-gray-400 p-3 px-5">Fecha de Sorteo</th>
                    <th class="text-middle bg-gray-400 p-3 px-5">Cantidad de Billetes</th>
                    <th class="text-middle bg-gray-400 p-3 px-5">Subtotal de Billetes</th>
                    <th class="text-middle bg-gray-400 p-3 px-5">"Tendre Suerte"</th>
                    <th class="text-middle bg-gray-400 p-3 px-5">Total</th>
                    <th class="text-middle bg-gray-400 p-3 px-5">Estado</th>
                    <th class="text-middle bg-gray-400 p-3 px-5">Ingresado por: </th>
                </tr>
                </thead>
                 <tbody>
                 @foreach ($raffles as $raffle)
                        <tr>
                            <td class="text-center p-3 px-5">{{ $raffle->date_raffle}}</td>
                            <td class="text-center p-3 px-5">{{ $raffle->number_of_tickets }}</td>
                            <td class="text-center p-3 px-5">{{ $raffle->subtotal_of_tickets }}</td>
                            <td class="text-center p-3 px-5">{{ $raffle->total_luck }}</td>
                            <td class="text-center p-3 px-5">{{ $raffle->total }}</td>
                            <td class="text-center p-3 px-5">
                            @if ($raffle->status_raffle == 0)
                                Abierto
                            @elseif ($raffle->status_raffle == 1)
                                    <div class="flex items-center">
                                        <span class="mr-2">No realizado</span>
                                        <form id="enterNumbers" class="max-w-sm mx-auto" method="GET" action="{{ route('enterNumbersForm', ['date_raffle' => $raffle->date_raffle]) }}" novalidate>
                                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Ingresar</button>
                                        </form>
                                    </div>
                            @elseif ($raffle->status_raffle == 2)
                                Realizado
                            @else
                                 <span style="color: red;">Error: Estado desconocido</span
                            @endif
                            </td>

                            <td class="text-center p-3 px-5">{{ $raffle->user_id ? $raffle->user->name : '' }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
</div>
@endsection
