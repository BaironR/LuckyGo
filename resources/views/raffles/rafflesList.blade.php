@extends('layouts.app')

@section('content')
    <style>
        .sidebar {
            width: 250px;
            right: 5px;
            background-color: white;
            height: auto;
            padding: 20px;
            color: black;
            position: fixed;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 1s cubic-bezier(0.25, 0.1, 0.25, 1);
            border: 1px solid grey;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        #toggleSidebar {
            position: fixed;
            top: 5px;
            right: 50px;
            z-index: 1000;
            background: #0a74da;
            color: white;
            border: none;
            padding: 5px 10px; /* Adjust padding to make the button smaller */
            font-size: 16px; /* Adjust font size to make the button smaller */
            cursor: pointer;
            border-radius: 5px; /* Optional: add some border radius for styling */
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 1px solid lightgrey;
            padding-bottom: 10px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: black;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .sidebar ul li a:hover {
            color: #0a74da;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>

    <div class="sidebar hidden" id="sidebar">
        <h2>Cambiar datos del sorteador</h2>
        <ul>
            <li><a href={{ route('changePasswordForm') }}>Cambiar contraseña</a></li>
            <li><a href={{ route('editProfileForm') }}>Cambiar datos</a></li>
        </ul>
    </div>
    <div class="main-content">
        <button id="toggleSidebar" class="mt-2.5 ml-1">☰</button>
    </div>

    <div class="lg:w-3/4 xl:w-2/3 mx-auto py-8 px-6 bg-white rounded-xl">

        @if (session('success'))
            <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <strong class="font-bold">Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

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
                                    <form id="enterNumbers" class="max-w-sm mx-auto" method="GET"
                                          action="{{ route('enterNumbersForm', ['date_raffle' => $raffle->date_raffle]) }}"
                                          novalidate>
                                        <button type="submit"
                                                class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Ingresar</button>
                                    </form>
                                </div>
                            @elseif ($raffle->status_raffle == 2)
                                Realizado
                            @else
                                <span style="color: red;">Error: Estado desconocido</span>
                            @endif
                        </td>

                        <td class="text-center p-3 px-5">{{ $raffle->user_id ? $raffle->user->name.' '.$raffle->entered_date : '' }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <script>
        // Ocultar el mensaje de éxito después de 4 segundos
        setTimeout(function () {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 4000);

        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const mainContent = document.querySelector('.main-content');

        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('expanded');
        });
    </script>
@endsection
