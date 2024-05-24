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
            <div id="error-message" class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2 hidden">Debe seleccionar exactamente 5 números.</div>
            <div class="luck my-5">
                <input type="checkbox" id="luck" name="luck" onchange="updateTotal()">
                <label for="luck" class="cursor-pointer">Tendré Suerte (+$1000)</label>
            </div>
            <div class="info bg-purple-100 p-2 rounded mb-5 text-sm">
                Para participar en el sorteo de cada domingo asegúrese de realizar la compra de sus boletos antes de las 23:59 horas de ese mismo día. Todas las compras realizadas dentro de este plazo serán incluidas en el sorteo correspondiente.
            </div>
            <div class="total text-lg mb-5">
                Total: <span id="totalAmount">$2.000</span>
            </div>
            <button class="play-button bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500" onclick="showModal()">Jugar</button>
        </div>

        <!-- The Modal -->
        <div id="confirmationModal" class="modal fixed z-50 inset-0 overflow-y-auto hidden">
            <div class="modal-content bg-white p-5 rounded-lg shadow-lg max-w-md mx-auto mt-20">
                <p>Has seleccionado los números:</p>
                <p id="selectedNumbers"></p>
                <p>El valor total de tu billete es <span id="totalValue"></span>.</p>
                <p>¿Deseas continuar?</p>
                <div class="flex justify-around mt-5">
                    <button class="modal-button confirm-button bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600" onclick="confirmPurchase()">Confirmar</button>
                    <button class="modal-button cancel-button bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600" onclick="closeModal()">Cancelar</button>
                </div>
            </div>
        </div>

        <div id="resultModal" class="modal fixed z-50 inset-0 overflow-y-auto hidden">
            <div class="result-modal-content bg-white p-5 rounded-lg shadow-lg max-w-md mx-auto mt-20">
                <p class="success-message">¡Compra realizada exitosamente!</p>
                <p>Tu número de billete es el <span id="ticketNumber"></span></p>
                <p>Fecha <span id="purchaseDate"></span></p>
                <p style="color:green">Juega con responsabilidad en LuckyGo</p>

                <div class="flex justify-around mt-5">
                    <button class="modal-button confirm-button bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600" onclick="closeResultModal()">Cerrar</button>
                </div>

            </div>
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

        function updateTotal() {
            const luckCheckbox = document.getElementById('luck');
            const totalAmount = document.getElementById('totalAmount');
            if (luckCheckbox.checked) {
                totalAmount.textContent = '$3.000';
            } else {
                totalAmount.textContent = '$2.000';
            }
        }

        function validateSelection() {
            const selectedNumbers = document.querySelectorAll('.number.selected');
            const errorMessage = document.getElementById('error-message');

            if (selectedNumbers.length !== 5) {
                errorMessage.classList.remove('hidden');

                // Ocultar el mensaje de error después de 3 segundos
                setTimeout(() => {
                    errorMessage.classList.add('hidden');
                }, 3000);
                return false;

            } else {
                errorMessage.classList.add('hidden');
                return true;
            }
        }

        function showModal() {

            if (!validateSelection()) {
                return;
            }

            const selectedNumbers = Array.from(document.querySelectorAll('.number.selected')).map(el => el.textContent).join(' - ');
            const total = document.getElementById('totalAmount').textContent;

            document.getElementById('selectedNumbers').textContent = selectedNumbers;
            document.getElementById('totalValue').textContent = total;

            document.getElementById('confirmationModal').style.display = 'block';
        }

        function closeModal() {

            // Obtener todos los elementos con la clase "number" que están seleccionados
            const selectedNumbers = document.querySelectorAll('.number.selected');

            // Eliminar la clase "selected" de todos los números seleccionados
            selectedNumbers.forEach(number => {
                number.classList.remove('selected');
            });

            document.getElementById('confirmationModal').style.display = 'none';
        }

        function confirmPurchase() {

            closeModal();


            const ticketNumber = 'LG' + (Math.floor(Math.random() * 899) + 100) // Genera un número de billete único
            const purchaseDate = new Date().toLocaleString();

            document.getElementById('ticketNumber').textContent = ticketNumber;
            document.getElementById('purchaseDate').textContent = purchaseDate;

            document.getElementById('resultModal').style.display = 'block';
        }

        function closeResultModal() {
            document.getElementById('resultModal').style.display = 'none';
        }

    </script>


@endsection


