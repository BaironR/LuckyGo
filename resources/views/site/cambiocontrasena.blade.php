<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña - Lucky Go</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #2ECC71;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        img {
            width: 100px;
            margin-bottom: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: #f56558;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function validateForm() {
            const newPassword = document.getElementById("new-password").value;
            const confirmPassword = document.getElementById("confirm-password").value;
            const errorMessage = document.getElementById("error-message");

            errorMessage.textContent = "";

            if (newPassword === "" || confirmPassword === "") {
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

            // If the validation passes, proceed with form submission
            alert("Contraseña cambiada exitosamente. Por favor, inicie sesión con su nueva contraseña.");
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <img src="https://i.ibb.co/qBNsMDR/f653f8a2-5f7c-4959-82cf-17ac69e415c8.jpg" alt="Lucky Go">
        <h1>Cambiar Contraseña</h1>
        <div id="error-message" class="error"></div>
        <form onsubmit="return validateForm()">
            <input type="password" id="new-password" placeholder="Nueva contraseña">
            <input type="password" id="confirm-password" placeholder="Confirmar nueva contraseña">
            <button type="submit">Cambiar Contraseña</button>
        </form>
    </div>
</body>
</html>
