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
                    @foreach ($users as $index => $user)
                        <tr>
                            <td class="text-left p-3 px-5">{{ $loop->iteration }}</td>
                            <td class="text-left p-3 px-5">{{ $user->name }}</td>
                            <td class="text-left p-3 px-5">{{ $user->email }}</td>
                            <td class="text-left p-3 px-5">{{ $user->age }}</td>
                            <td class="text-left p-3 px-5">{{ $user->raffles_entered }}</td>
                            <td>
                                <form action="{{ route('updateStatus', $user->id) }}" method="POST" novalidate>
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
        @endif
    </div>

    @if (session('success'))
        <div class="bg-green-300 text-green-800 w-1/2 mx-auto my-2 rounded-lg text-lg text-center p-2" id="successMessage">
            {{ session('success') }}
        </div>
    @endif

    @if (session('registration_success'))
        <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75">
            <div class="bg-white p-5 rounded-lg shadow-lg max-w-md mx-auto">
                <p class="text-lg font-semibold text-center">¡Usuario registrado exitosamente!</p>
                <p class="mt-4 text-center">El usuario {{ session('username') }} ha sido registrado correctamente.</p>
                <div class="flex justify-center mt-5">

                    <button class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600" onclick="document.getElementById('successModal').style.display = 'none'">Cerrar</button>
                </div>
            </div>
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

            // Ordenar la tabla por defecto al cargar la página
            sortTable(1);
        });

        function searchTable() {
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

        function sortTable(columnIndex) {
            var table = document.getElementById('sorteadoresTable');
            var rows = Array.prototype.slice.call(table.getElementsByTagName('tr'), 1);

            rows.sort(function(a, b) {
                var A = a.getElementsByTagName('td')[columnIndex].innerText.toLowerCase();
                var B = b.getElementsByTagName('td')[columnIndex].innerText.toLowerCase();
                return A.localeCompare(B, 'es', { sensitivity: 'base' });
            });

            for (var i = 0; i < rows.length; i++) {
                rows[i].getElementsByTagName('td')[0].innerText = i + 1;  // Update ID column with incremental IDs
                table.appendChild(rows[i]);
            }
        }

        // Call sortTable(1) to sort by the Name column when the page loads
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var successMessage = document.getElementById('successMessage');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 3000); // 3000 milliseconds = 3 seconds

            sortTable(1);  // Sort by Name column on page load
        });

    </script>

@endsection
