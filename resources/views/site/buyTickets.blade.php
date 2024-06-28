<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Billetes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .highlight {
            @apply text-xl font-bold text-center;
        }
    </style>
</head>
<body style="background-color: #2ECC71;" class="flex items-center justify-center h-screen">
    <div class="container mx-auto bg-white shadow-lg rounded-lg p-8 relative">
        <a href="{{ url('URL_A_LA_QUE_DEREAS_VOLVER') }}" class="absolute top-4 right-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-green-600">Volver</a>
        <h1 class="text-3xl font-bold text-center mb-4">Verificador de Billetes</h1>
        <form class="text-center mb-6">
            <label for="codigo" class="block text-lg mb-2">Ingresa el código de tu billete:</label>
            <input type="text" id="codigo" name="codigo" class="border border-gray-300 rounded px-4 py-2 mb-4">
            <button type="button" onclick="verificarBillete()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-red-600">Verificar</button>
        </form>
        <div id="result">
            <h2 class="text-2xl font-bold text-center mb-4">Detalles de tu Billete</h2>
            <table class="w-full mb-4 border-collapse border border-gray-300">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Fecha del Billete</th>
                    <th class="border border-gray-300 px-4 py-2">Números Jugados</th>
                </tr>
                <tr>
                    <td id="fechaBillete" class="border border-gray-300 px-4 py-2">18/03/2024 15:40:21</td>
                    <td id="numerosJugados" class="border border-gray-300 px-4 py-2">12 19 20 21 29</td>
                </tr>
            </table>
            <h2 class="text-2xl font-bold text-center mb-4">Detalles del Sorteo</h2>
            <table class="w-full mb-4 border-collapse border border-gray-300">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Fecha del Sorteo</th>
                    <th class="border border-gray-300 px-4 py-2">Números Ganadores</th>
                    <th class="border border-gray-300 px-4 py-2">Números Ganadores "Tendré Suerte"</th>
                </tr>
                <tr>
                    <td id="fechaSorteo" class="border border-gray-300 px-4 py-2">18/03/2024 00:34</td>
                    <td id="numerosGanadores" class="border border-gray-300 px-4 py-2">12 19 20 21 29</td>
                    <td id="numerosTendreSuerte" class="border border-gray-300 px-4 py-2">3 8 15 22 27</td>
                </tr>
            </table>
            <p id="premio" class="highlight text-green-600">¡Tienes premio!</p>
            <table class="w-full mt-4 border-collapse border border-gray-300">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Sorteo principal</th>
                    <th class="border border-gray-300 px-4 py-2">"Tendré Suerte"</th>
                </tr>
                <tr>
                    <td id="premioPrincipal" class="border border-gray-300 px-4 py-2">$400.000</td>
                    <td id="premioTendreSuerte" class="border border-gray-300 px-4 py-2">Sin Premio</td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        function verificarBillete() {
            // Aquí va la lógica para verificar el billete.
            // Por ahora, sólo mostramos los detalles fijos como ejemplo.
            document.getElementById('fechaBillete').innerText = '18/03/2024 15:40:21';
            document.getElementById('numerosJugados').innerText = '12 19 20 21 29';
            document.getElementById('fechaSorteo').innerText = '18/03/2024 00:34';
            document.getElementById('numerosGanadores').innerText = '12 19 20 21 29';
            document.getElementById('numerosTendreSuerte').innerText = '3 8 15 22 27';
            document.getElementById('premio').innerText = '¡Tienes premio!';
            document.getElementById('premioPrincipal').innerText = '$400.000';
            document.getElementById('premioTendreSuerte').innerText = 'Sin Premio';
        }
    </script>
</body>
</html>
