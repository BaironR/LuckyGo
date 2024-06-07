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

            @error('id')
            <p id="message-error" class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">{{ $message }}</p>
            @enderror

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

                    <form method="POST" action="{{ route('buyTicket') }}" id="purchaseForm">
                        @csrf
                        <input type="hidden" name="selected_numbers" id="formSelectedNumbers">
                        <input type="hidden" name="luck" id="formLuck" value="0">
                        <input type="hidden" name="purchase_date" id="formPurchaseDate">
                        <input type="hidden" name="id" id="formTicketNumber">
                        <button class="modal-button cancel-button bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600" onclick="confirmPurchase()">Confirmar</button>
                    </form>

                    <button class="modal-button cancel-button bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600" onclick="closeModal()">Cancelar</button>
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
            const selected_numbers = document.querySelectorAll('.number.selected');
            if (element.classList.contains('selected')) {
                element.classList.remove('selected');
            } else if (selected_numbers.length < 5) {
                element.classList.add('selected');
            }
        }

        function updateTotal() {
            const luck_checkbox = document.getElementById('luck');
            const total_amount = document.getElementById('totalAmount');
            document.getElementById('formLuck').value = luck_checkbox.checked ? 1 : 0;
            if (luck_checkbox.checked) {
                total_amount.textContent = '$3.000';
            } else {
                total_amount.textContent = '$2.000';
            }
        }

        function validateSelection() {
            const selected_numbers = document.querySelectorAll('.number.selected');
            const error_message = document.getElementById('error-message');

            if (selected_numbers.length !== 5) {
                error_message.classList.remove('hidden');

                // Ocultar el mensaje de error después de 3 segundos
                setTimeout(() => {
                    error_message.classList.add('hidden');
                }, 3000);
                return false;

            } else {
                error_message.classList.add('hidden');
                return true;
            }
        }

        function showModal() {
            if (!validateSelection()) {
                return;
            }

            const selected_numbers = Array.from(document.querySelectorAll('.number.selected')).map(el => el.textContent).join(' - ');
            const total = document.getElementById('totalAmount').textContent;
            document.getElementById('selectedNumbers').textContent = selected_numbers;
            document.getElementById('totalValue').textContent = total;
            document.getElementById('formSelectedNumbers').value = selected_numbers;
            document.getElementById('confirmationModal').style.display = 'block';

        }

        function closeModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        function confirmPurchase() {

            closeModal();

            const id = 'LG' + (Math.floor(Math.random() * 899) + 100) // Genera un número de billete único
            const purchase_date = new Date().toLocaleString();
            document.getElementById('formTicketNumber').value = id;
            document.getElementById('formPurchaseDate').value = purchase_date;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Selecciona el elemento del mensaje de error
            const error_message = document.getElementById('message-error');

            // Verifica si el mensaje de error existe y está visible
            if (error_message && !error_message.classList.contains('hidden')) {
                // Oculta el mensaje de error después de 3 segundos
                setTimeout(() => {
                    error_message.classList.add('hidden');
                }, 5000);
            }
        });
    </script>

    @if(session('purchase_successful'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    // Muestra la ventana emergente después del tiempo especificado
                    document.getElementById('resultModal').style.display = 'block';
                    // Limpia la variable de sesión después de mostrar el modal
                    @php session()->forget('purchase_successful'); @endphp
                });
            });


            function closeResultModal() {
                document.getElementById('resultModal').style.display = 'none';
            }
        </script>

        <div id="resultModal" class="modal fixed z-50 inset-0 overflow-y-auto hidden">
            <div class="result-modal-content bg-white p-5 rounded-lg shadow-lg max-w-md mx-auto mt-20 border-2 border-black">
                <p class="success-message">¡Compra realizada exitosamente!</p>
                <p>Tu número de billete es el <span id="ticketNumber">{{ session('id') }}</span></p>
                <p>Fecha <span id="purchaseDate">{{ session('purchase_date') }}</span></p>
                <p style="color:green">Juega con responsabilidad en LuckyGo</p>
                <div class="flex justify-around mt-5">
                    <button class="modal-button confirm-button bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600" onclick="closeResultModal()">Cerrar</button>
                </div>
            </div>
        </div>

    @endif

@endsection
