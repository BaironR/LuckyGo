@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-20 rounded-lg shadow-md text-center w-full max-w-2xl">
            <img src="https://i.ibb.co/qBNsMDR/f653f8a2-5f7c-4959-82cf-17ac69e415c8.jpg" alt="Lucky Go" class="w-40 mx-auto mb-4">
            <h1 class="text-3xl font-bold mb-6">Cambiar Contraseña</h1>
            <div id="error-message" class="text-red-500 mb-4"></div>
            @if ($errors->any())
                <div class="text-red-500 mb-4">
                    <ul class="list-none p-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('changePassword') }}" onsubmit="return validateForm()">
                @csrf
                <input type="password" name="current_password" id="current-password" placeholder="Contraseña actual" class="w-full p-3 mb-3 border border-gray-300 rounded-lg">
                <input type="password" name="new_password" id="new-password" placeholder="Nueva contraseña" class="w-full p-3 mb-3 border border-gray-300 rounded-lg">
                <input type="password" name="new_password_confirmation" id="confirm-password" placeholder="Confirmar nueva contraseña" class="w-full p-3 mb-3 border border-gray-300 rounded-lg">
                <div class="flex justify-between">
                    <button type="submit" class="w-2/5 text-white p-3 rounded-lg hover:bg-green-700" style="background-color: #2ECC71">Cambiar Contraseña</button>
                    <a href="{{ route('enterRaffle') }}" class="w-2/5 text-white p-3 rounded-lg hover:bg-red-600" style="background-color: #f6686b">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function validateForm() {
            const currentPassword = document.getElementById("current-password").value;
            const newPassword = document.getElementById("new-password").value;
            const confirmPassword = document.getElementById("confirm-password").value;
            const errorMessage = document.getElementById("error-message");

            errorMessage.textContent = "";

            if (currentPassword === "" || newPassword === "" || confirmPassword === "") {
                errorMessage.textContent = "Debe completar ambos campos asociados a la contraseña";
                return false;
            }

            if (newPassword !== confirmPassword) {
                errorMessage.textContent = "Las contraseñas no coinciden";
                return false;
            }

            if (!/^[1-9]\d{5}$/.test(newPassword)) {
                errorMessage.textContent = "La contraseña es menor a seis dígitos o comienza con el número 0";
                return false;
            }

            return true;
        }
    </script>
@endsection
