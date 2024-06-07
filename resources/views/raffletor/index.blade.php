@extends('layouts.app')
@section('content')

    <div class="lg:w-3/4 xl:w-2/3 mx-auto py-8 px-6 bg-white rounded-xl">

        <h1 class="font-bold text-5xl text-center mb-8">Listado de Sorteadores</h1>

        <div class="flex justify-center w-full my-5 mb-10">
            <input type="text" id="searchInput" placeholder="Ingresar nombre o correo electrónico" onkeyup="searchTable()" class="w-full p-2 text-lg">
        </div>

        @if ($users->isEmpty())

            <div class="flex justify-center w-full my-5 mb-5">
                <a href="{{ route('registerForm') }}" class="mb-4 inline-block w-28 py-4 px-8 bg-green-500 text-white rounded-xl text-center">Añadir</a>
            </div>

            <div class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2 w-1/3 mx-auto">No hay sorteadores en el sistema.</div>
        @else

            <a href="{{ route('registerForm') }}" class="mb-4 inline-block w-28 py-4 px-8 bg-green-500 text-white rounded-xl text-center">Añadir</a>
            <div>
                <table class="w-full text-md bg-white shadow-md rounded mb-4" id="sorteadoresTable">
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
                            <td class="text-left p-3 px-5">{{ $user->raffles_entered}}</td>
                            <td class="text-left p-3 px-5">{{ $user->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

<script>
function searchTable() {
    // Obtener el valor del input y limpiar espacios
    var input = document.getElementById('searchInput');
    var filter = input.value.toLowerCase().trim();
    var table = document.getElementById('sorteadoresTable');
    var tr = table.getElementsByTagName('tr');

    for (var i = 1; i < tr.length; i++) {
        var tdName = tr[i].getElementsByTagName('td')[1];
        var tdEmail = tr[i].getElementsByTagName('td')[2];
        if (tdName || tdEmail) {
            var txtValueName = tdName.textContent || tdName.innerText;
            var txtValueEmail = tdEmail.textContent || tdEmail.innerText;
            if (txtValueName.toLowerCase().indexOf(filter) > -1 || txtValueEmail.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>

@endsection


