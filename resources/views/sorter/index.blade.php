@extends('layouts.app')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class = "bg-gray-200 p-4">
    <div class = "lg:w-2/4 mx-auto py-8 px-6 bg-white rounded-xl">
        <h1 class = "font-bold text-5xl text-center mb-8">Listado de Sorteadores</h1>
        <button class = "w-28 py-4 px-8 bg-green-500 text-white rounded-xl">Añadir</button>
        <div>
            <table class="class=w-full text-md bg-white shadow-md rounded mb-4">
                <thead>
                  <tr>
                    <th class="text-left p-3 px-5">ID</th>
                    <th class="text-left p-3 px-5">Nombre Sorteador</th>
                    <th class="text-left p-3 px-5">Correo Electrónico</th>
                    <th class="text-left p-3 px-5">Edad</th>
                    <th class="text-left p-3 px-5">Cantidad de Sorteos</th>
                    <th class="text-left p-3 px-5">Estado</th>
                  </tr>
                </thead>
                
{{-- I couldn't figure out how to make the actual model, yet it should be something like the next comented code --}}
{{--                 <tbody>
                        @foreach ($users as $user)
                    <tr>
                        <td>{{$user -> id}}</td>
                        <td>{{$user -> name}}</td>
                        <td>{{$user -> email}}</td>
                        <td>{{$user -> age}}</td>
                        <td>{{$user -> lotteries_entered}}</td>
                        <td>{{$user -> status}}</td>

                    </tr>
                        @endforeach

                </tbody> --}}
              </table>
        </div>

    </div>
</body>
</html>
@endsection
