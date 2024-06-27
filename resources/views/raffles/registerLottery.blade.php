<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Sorteo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function generateNumbers(container, className, maxNumbers) {
            for (let i = 1; i <= maxNumbers; i++) {
                const numberDiv = document.createElement('div');
                numberDiv.className = `number ${className} bg-gray-200 border border-gray-300 text-center cursor-pointer`;
                numberDiv.textContent = i;
                container.appendChild(numberDiv);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const maxSelections = 5;
            let sorteosSelected = [];

            @if($raffle->luck_raffle)
            let tendreSuerteSelected = [];
            @endif

            const sorteosContainer = document.querySelector('.numbers.sorteo');
            generateNumbers(sorteosContainer, 'sorteo', 30);
            document.querySelectorAll('.number.sorteo').forEach(element => {
                element.addEventListener('click', function () {
                    if (sorteosSelected.includes(this)) {
                        this.classList.remove('bg-yellow-300');
                        sorteosSelected = sorteosSelected.filter(item => item !== this);
                    } else if (sorteosSelected.length < maxSelections) {
                        this.classList.add('bg-yellow-300');
                        sorteosSelected.push(this);
                    }
                });
            });

            @if ($raffle->luck_raffle)
            const tendreSuerteContainer = document.querySelector('.numbers.tendre-suerte');
            generateNumbers(tendreSuerteContainer, 'tendre-suerte', 30);
            document.querySelectorAll('.number.tendre-suerte').forEach(element => {
                element.addEventListener('click', function () {
                    if (tendreSuerteSelected.includes(this)) {
                        this.classList.remove('bg-yellow-300');
                        tendreSuerteSelected = tendreSuerteSelected.filter(item => item !== this);
                    } else if (tendreSuerteSelected.length < maxSelections) {
                        this.classList.add('bg-yellow-300');
                        tendreSuerteSelected.push(this);
                    }
                });
            });
            @endif

            document.querySelector('.confirm').addEventListener('click', function () {
                @if ($raffle->luck_raffle)
                if (sorteosSelected.length !== maxSelections || tendreSuerteSelected.length !== maxSelections) {
                    alert('Debe seleccionar 5 números para cada opción.');
                    return;
                }
                let sortedTendreSuerte = tendreSuerteSelected.map(element => parseInt(element.textContent)).sort((a, b) => a - b);
                let sortedSorteos = sorteosSelected.map(element => parseInt(element.textContent)).sort((a, b) => a - b);

                document.getElementById('suerteNumbers').textContent = sortedTendreSuerte.join(' - ');
                document.getElementById('sorteoNumbers').textContent = sortedSorteos.join(' - ');
                document.querySelector('.modal').classList.remove('hidden');

                @else
                if (sorteosSelected.length !== maxSelections) {
                    alert('Debe seleccionar 5 números.');
                    return;
                }
                let sortedSorteos = sorteosSelected.map(element => parseInt(element.textContent)).sort((a, b) => a - b);

                document.getElementById('sorteoNumbers').textContent = sortedSorteos.join(' - ');
                document.querySelector('.modal').classList.remove('hidden');
                @endif
            });

            document.querySelector('.modal .confirm').addEventListener('click', function () {
                alert('Sorteo confirmado.');
                document.querySelector('.modal').classList.add('hidden');
            });

            document.querySelector('.modal .cancel').addEventListener('click', function () {
                document.querySelector('.modal').classList.add('hidden');
            });
        });

    </script>
</head>

<body class="bg-gray-100 font-sans">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Registrar Sorteo</h1>
    <table class="w-full mb-8">
        <thead>
        <tr class="bg-gray-200">
            <th class="border border-gray-300 py-2">Fecha del Sorteo</th>
            <th class="border border-gray-300 py-2">Cantidad de Billetes</th>
            <th class="border border-gray-300 py-2">Subtotal de Billetes</th>
            <th class="border border-gray-300 py-2">Tendré Suerte</th>
            <th class="border border-gray-300 py-2">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="border border-gray-300 py-2">{{ $formattedDate }}</td>
            <td class="border border-gray-300 py-2">{{ $raffle->number_of_tickets }}</td>
            <td class="border border-gray-300 py-2">{{ $raffle->subtotal_of_tickets }}</td>
            <td class="border border-gray-300 py-2">{{ $raffle->total_luck }}</td>
            <td class="border border-gray-300 py-2">{{ $raffle->total }}</td>
        </tr>
        </tbody>
    </table>

    <h2 class="text-2xl font-bold mb-4">Elige los números ganadores</h2>
    <div class="numbers sorteo grid grid-cols-6 gap-4 mb-4"></div>

    @if ($raffle->luck_raffle)
        <h2 class="text-xl font-bold mb-4">Categoría: Tendré Suerte</h2>
        <div class="numbers tendre-suerte grid grid-cols-6 gap-4 mb-4"></div>
    @endif

    <div class="flex justify-center gap-8 mb-8">
        <button class="btn confirm bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Confirmar</button>
        <a href="{{ route('enterRaffle') }}" class="btn cancel bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded inline-block text-center">Cancelar</a>
    </div>

    <div class="modal hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="modal-content bg-white p-4 border border-gray-300 rounded max-w-md w-full">
            <p class="mb-4">Has seleccionado los números de Sorteo:</p>
            <p id="sorteoNumbers" class="mb-4"></p>
            @if ($raffle->luck_raffle)
                <p>y los números de Tendré Suerte:</p>
                <p id="suerteNumbers" class="mb-4"></p>
            @endif
            <p><strong>¿Deseas Registrar Sorteo?</strong></p>
            <div class="modal-buttons flex justify-center gap-8 mt-4">
                <form method="POST" action="{{ route('enterNumbers', $raffle) }}" id="enterNumbersForm">
                    @csrf
                    <input type="hidden" name="selected_numbers_luck" id="tendreSuerteSelectedForm">
                    <input type="hidden" name="selected_numbers" id="sorteosSelectedForm">
                    <button class="modal-button btn confirm bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded" onclick="confirmEnterNumbers()">Confirmar</button>
                </form>
                <button class="btn cancel bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cancelar</button>
            </div>
        </div>
    </div>
</div>
</body>

</html>
