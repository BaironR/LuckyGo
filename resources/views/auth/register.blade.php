@extends('layouts.app')

@section('content')
    <div class="max-w-sm mx-auto">
        @if (session('error'))
            <div class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">
                {{ session('error') }}
            </div>
        @endif
        <form id="registrationForm" class="max-w-sm mx-auto" method="POST" action="{{ route('registerCreate') }}" novalidate>
            @csrf

            <div class="mb-5 flex items-center justify-center">
                <a href="https://imgbb.com/" class="flex items-center justify-center">
                    <img src="https://i.ibb.co/qBNsMDR/f653f8a2-5f7c-4959-82cf-17ac69e415c8.jpg" alt="LuckyGo" border="0" class="w-44" />
                </a>
            </div>
            <div class="mb-8 flex items-center justify-center">
                <span class="block text-4xl font-semibold text-center dark:text-white">REGISTRAR<br>SORTEADOR</span>
            </div>

            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo electrónico</label>
                <input type="email" id="email" name="email" maxlength = "50" class="shadow-sm  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="nombre@dominio.com" required />
                @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input type="text" name="name" id="name" maxlength = "30" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                @error('name')
                <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad</label>
                <input type="text" name="age" id="age" maxlength = "3" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                @error('age')
                <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="button" class="text-white bg-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-none text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full" onclick="openConfirmModal()">Registrar sorteador</button>
        </form>
    </div>

    <div id="confirmationModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75" style="display: none;">
        <div class="bg-white p-5 rounded-lg shadow-lg max-w-md mx-auto">
            <p class="text-lg font-semibold text-center">¿Estás seguro de que quieres añadir este sorteador?</p>
            <div class="flex justify-center mt-5 space-x-4">
                <button class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600" onclick="confirmRegistration()">Sí</button>
                <button class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600" onclick="closeConfirmModal()">No</button>
            </div>
        </div>
    </div>

    <script>
        function openConfirmModal() {
            document.getElementById('confirmationModal').style.display = 'flex';
        }

        function closeConfirmModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        function confirmRegistration() {
            document.getElementById('registrationForm').submit();
        }
    </script>
@endsection
