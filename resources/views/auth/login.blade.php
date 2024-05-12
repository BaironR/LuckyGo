@extends('layouts.app')

@section('content')

    <form class="max-w-sm mx-auto" method = "POST" action = "{{route('loginSorters')}}" novalidate>
        @csrf
        <div class="mb-7 flex items-center justify-center">
            <a href="https://imgbb.com/" class="flex items-center justify-center">
                <img src="https://i.ibb.co/qBNsMDR/f653f8a2-5f7c-4959-82cf-17ac69e415c8.jpg" alt="f653f8a2-5f7c-4959-82cf-17ac69e415c8" border="0" class="w-52" />
            </a>
        </div>
        <div class ="mb-7 flex items-center justify-center">
            <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white">Lucky Go</span>
        </div>
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electrónico</label>
            <input type="email" id="email" name="email" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nombre@dominio.com" required />
            @error('email')
            <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
            <input type="password" placeholder="••••••••" id="password" name = "password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            @error('password')
            <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-center mb-5">
            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-none text-sm px-5 py-2.5 text-center dark:bg-blue-700 dark:hover:bg-blue-600 dark:focus:ring-blue-900">
                Iniciar sesión</button>
        </div>
        @if(session('message'))
            <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ session('message') }}</p>
        @endif
    </form>

@endsection


