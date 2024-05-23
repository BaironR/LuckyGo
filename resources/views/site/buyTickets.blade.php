@extends('layouts.app')

@section('content')
    <div class="bg-green-200 text-center min-h-screen flex flex-col items-center">
        <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-lg max-w-md">
            <div class="mb-5 flex items-center justify-center">
                <a href="https://imgbb.com/" class="flex items-center justify-center">
                    <img src="https://i.ibb.co/qBNsMDR/f653f8a2-5f7c-4959-82cf-17ac69e415c8.jpg" alt="LuckyGo" border="0" class="w-44" />
                </a>
            </div>
            <div class="title text-2xl font-bold mb-5">
                Compra de billetes de lotería
            </div>
            <div class="mb-5">
                Seleccione 5 números del 1 al 30:
            </div>
            <div class="numbers grid grid-cols-6 gap-2 mb-5">
                @for ($i = 1; $i <= 30; $i++)
                    <div class="number flex items-center justify-center w-10 h-10 border-2 border-gray-300 rounded cursor-pointer bg-white" onclick="toggleNumber(this)">{{ $i }}</div>
                @endfor
            </div>
            <div class="luck my-5">
                <input type="checkbox" id="luck" name="luck">
                <label for="luck" class="cursor-pointer">Tendré Suerte (+$1000)</label>
            </div>
            <div class="info bg-purple-100 p-2 rounded mb-5 text-sm">
                Para participar en el sorteo de cada domingo asegúrese de realizar la compra de sus boletos antes de las 23:59 horas de ese mismo día. Todas las compras realizadas dentro de este plazo serán incluidas en el sorteo correspondiente.
            </div>
            <div class="total text-lg mb-5">
                Total: $2.000
            </div>
            <button class="play-button bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Jugar</button>
        </div>
    </div>
    <style>
        .number {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border: 2px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            background-color: white;
        }

        .number.selected {
            background-color: #2ECC71;
            border-color: #2ECC71;
            color: white;
        }
    </style>

    <script>
        function toggleNumber(element) {
            const selectedNumbers = document.querySelectorAll('.number.selected');
            if (element.classList.contains('selected')) {
                element.classList.remove('selected');
            } else if (selectedNumbers.length < 5) {
                element.classList.add('selected');
            }
        }
    </script>
@endsection


