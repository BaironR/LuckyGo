@extends('layouts.app')
@section('content')

    <body class="bg-gray-200 p-4">
    <div class="lg:w-3/4 xl:w-2/3 mx-auto py-8 px-6 bg-white rounded-xl">
        <h1 class="font-bold text-5xl text-center mb-8">Listado de Sorteadores</h1>
        <a href="{{ route('registerForm') }}" class="mb-4 inline-block w-28 py-4 px-8 bg-green-500 text-white rounded-xl text-center mb-4">Añadir</a>
        <div>
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
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
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="text-left p-3 px-5">{{ $user->id }}</td>
                        <td class="text-left p-3 px-5">{{ $user->name }}</td>
                        <td class="text-left p-3 px-5">{{ $user->email }}</td>
                        <td class="text-left p-3 px-5">{{ $user->age }}</td>
                        <td class="text-left p-3 px-5">{{ $user->lotteries_entered }}</td>
                        <td>
                            <form action="{{ route('updateStatus', $user->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <select name="status" class="status-dropdown p-2 border rounded" onchange="this.form.submit()">
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Habilitado</option>
                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Deshabilitado</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </body>

    @if (session('success'))
        <div class="bg-green-300 text-green-800 w-1/2 mx-auto my-2 rounded-lg text-lg text-center p-2" id="successMessage">
            {{ session('success') }}
        </div>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var successMessage = document.getElementById('successMessage');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 3000); // 3000 milisegundos = 3 segundos
        });
    </script>

@endsection

