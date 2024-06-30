<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Billetes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
</div>
</body>
</html>
