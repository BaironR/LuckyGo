<!doctype html>
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
{{--                  <tbody>
                    @foreach ($ as $ )
                        <tr>
                            <td class="text-left p-3 px-5">{{ $-> }}</td>
                            <td class="text-left p-3 px-5">{{ $-> }}</td>
                            <td class="text-left p-3 px-5">{{ $-> }}</td>
                            <td class="text-left p-3 px-5">{{ $-> }}</td>
                            <td class="text-left p-3 px-5">{{ $-> }}</td>
                            <td class="text-left p-3 px-5">{{ $-> }}</td>
                            <td class="text-left p-3 px-5">{{ $-> }}</td>
                        </tr>
                    @endforeach
                </tbody> --}}

            </table>
        </div>
</div>
@endsection
