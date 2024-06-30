@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-20 rounded-lg shadow-md text-center w-full max-w-2xl">
            <img src="https://i.ibb.co/qBNsMDR/f653f8a2-5f7c-4959-82cf-17ac69e415c8.jpg" alt="Lucky Go" class="w-40 mx-auto mb-4">
            <h1 class="text-3xl font-bold mb-6">Editar Perfil</h1>
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
            <form method="POST" action="{{ route('updateProfile') }}" onsubmit="return validateForm()">
                @csrf
                <input type="text" name="name" id="name" placeholder="Nombre" class="w-full p-3 mb-3 border border-gray-300 rounded-lg" value="{{ old('name', Auth::user()->name) }}">
                <input type="number" name="age" id="age" placeholder="Edad" class="w-full p-3 mb-3 border border-gray-300 rounded-lg" value="{{ old('age', Auth::user()->age) }}">
                <div class="flex justify-between">
                    <button type="submit" class="w-2/5 text-white p-3 rounded-lg hover:bg-green-700" style="background-color: #2ECC71">Guardar Cambios</button>
                    <a href="{{ route('enterRaffle') }}" class="w-2/5 text-white p-3 rounded-lg hover:bg-red-600" style="background-color: #f6686b">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function validateForm() {
            const name = document.getElementById("name").value;
            const age = document.getElementById("age").value;
            const errorMessage = document.getElementById("error-message");

            errorMessage.textContent = "";

            if (name === "") {
                errorMessage.textContent = "Debe ingresar su nombre";
                return false;
            }

            if (age === "") {
                errorMessage.textContent = "Debe ingresar su edad";
                return false;
            }

            if (isNaN(age)) {
                errorMessage.textContent = "La edad debe ser numérica";
                return false;
            }

            if (age < 18 || age > 65) {
                errorMessage.textContent = "La edad no puede ser inferior a 18 y mayor a 65";
                return false;
            }

            return true;
        }
    </script>
@endsection
