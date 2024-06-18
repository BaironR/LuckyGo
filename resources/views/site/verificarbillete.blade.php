<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Billetes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2ECC71;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #000;
        }
        .container {
            width: 60%;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #000;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            color: #000;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            color: #000;
        }
        .highlight {
            color: #000;
            font-size: 1.5em;
            font-weight: bold;
        }
        h1, h2 {
            color: #000;
            text-align: center;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
            color: #000;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 1em;
            margin-right: 10px;
            color: #000;
        }
        button {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Verificador de Billetes</h1>
        <form>
            <label for="codigo">Ingresa el código de tu billete: </label>
            <input type="text" id="codigo" name="codigo">
            <button type="button" onclick="verificarBillete()">Verificar</button>
        </form>
        <div id="result">
            <h2>Detalles de tu Billete</h2>
            <table>
                <tr>
                    <th>Fecha del Billete</th>
                    <th>Números Jugados</th>
                </tr>
                <tr>
                    <td id="fechaBillete">18/03/2024 15:40:21</td>
                    <td id="numerosJugados">12 19 20 21 29</td>
                </tr>
            </table>
            <h2>Detalles del Sorteo</h2>
            <table>
                <tr>
                    <th>Fecha del Sorteo</th>
                    <th>Números Ganadores</th>
                    <th>Números Ganadores "Tendré Suerte"</th>
                </tr>
                <tr>
                    <td id="fechaSorteo">18/03/2024 00:34</td>
                    <td id="numerosGanadores">12 19 20 21 29</td>
                    <td id="numerosTendreSuerte">3 8 15 22 27</td>
                </tr>
            </table>
            <p id="premio" class="highlight">¡Tienes premio!</p>
            <table>
                <tr>
                    <th>Sorteo principal</th>
                    <th>"Tendré Suerte"</th>
                </tr>
                <tr>
                    <td id="premioPrincipal">$400.000</td>
                    <td id="premioTendreSuerte">Sin Premio</td>
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
