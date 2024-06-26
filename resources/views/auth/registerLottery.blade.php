<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Sorteo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .numbers {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(40px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }
        .number {
            padding: 10px;
            text-align: center;
            border: 1px solid #dddddd;
            background-color: #f2f2f2;
            cursor: pointer;
        }
        .selected {
            background-color: #ffc107;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .btn {
            padding: 10px 20px;
            text-align: center;
            border: none;
            cursor: pointer;
            color: white;
            font-size: 16px;
        }
        .confirm {
            background-color: #28a745;
        }
        .cancel {
            background-color: #dc3545;
        }
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4); 
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 400px;
            text-align: center;
        }
        .modal-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .modal-buttons .btn {
            width: 100px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const maxSelections = 5;
            let sorteosSelected = [];
            let tendreSuerteSelected = [];

            function generateNumbers(container, className) {
                for (let i = 1; i <= 30; i++) {
                    const numberDiv = document.createElement('div');
                    numberDiv.className = `number ${className}`;
                    numberDiv.textContent = i;
                    container.appendChild(numberDiv);
                }
            }

            const sorteosContainer = document.querySelector('.numbers.sorteo');
            const tendreSuerteContainer = document.querySelector('.numbers.tendre-suerte');
            generateNumbers(sorteosContainer, 'sorteo');
            generateNumbers(tendreSuerteContainer, 'tendre-suerte');

            document.querySelectorAll('.number.sorteo').forEach(element => {
                element.addEventListener('click', function() {
                    if (sorteosSelected.includes(this)) {
                        this.classList.remove('selected');
                        sorteosSelected = sorteosSelected.filter(item => item !== this);
                    } else if (sorteosSelected.length < maxSelections) {
                        this.classList.add('selected');
                        sorteosSelected.push(this);
                    }
                });
            });

            document.querySelectorAll('.number.tendre-suerte').forEach(element => {
                element.addEventListener('click', function() {
                    if (tendreSuerteSelected.includes(this)) {
                        this.classList.remove('selected');
                        tendreSuerteSelected = tendreSuerteSelected.filter(item => item !== this);
                    } else if (tendreSuerteSelected.length < maxSelections) {
                        this.classList.add('selected');
                        tendreSuerteSelected.push(this);
                    }
                });
            });

            document.querySelector('.confirm').addEventListener('click', function() {
                if (sorteosSelected.length !== maxSelections || tendreSuerteSelected.length !== maxSelections) {
                    alert('Debe seleccionar 5 números para cada opción.');
                    return;
                }

                const sorteosNumbers = sorteosSelected.map(element => element.textContent).join(' - ');
                const tendreSuerteNumbers = tendreSuerteSelected.map(element => element.textContent).join(' - ');

                document.getElementById('sorteoNumbers').textContent = sorteosNumbers;
                document.getElementById('suerteNumbers').textContent = tendreSuerteNumbers;
                document.querySelector('.modal').style.display = 'flex';
            });

            document.querySelector('.modal .confirm').addEventListener('click', function() {
                alert('Sorteo confirmado.');
                document.querySelector('.modal').style.display = 'none';
            });

            document.querySelector('.modal .cancel').addEventListener('click', function() {
                document.querySelector('.modal').style.display = 'none';
            });
        });
    </script>
</head>
<body>
    <h1>Registrar Sorteo</h1>
    <table>
        <tr>
            <th>Fecha del Sorteo</th>
            <th>Cantidad de Billetes</th>
            <th>Subtotal de Billetes</th>
            <th>Tendré Suerte</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>Domingo 18 de febrero</td>
            <td>5,341</td>
            <td>$10,682,000</td>
            <td>$3,418,000</td>
            <td>$14,100,000</td>
        </tr>
    </table>

    <h2>Sorteo</h2>
    <div class="numbers sorteo"></div>

    <h2>Tendré Suerte</h2>
    <div class="numbers tendre-suerte"></div>

    <div class="buttons">
        <button class="btn confirm">Confirmar</button>
        <button class="btn cancel">Cancelar</button>
    </div>

    <div class="modal">
        <div class="modal-content">
            <p>Has seleccionado los números de Sorteo:</p>
            <p id="sorteoNumbers"></p>
            <p>y los números de Tendré Suerte:</p>
            <p id="suerteNumbers"></p>
            <p></p>
            <p><strong>¿Deseas Registrar Sorteo?</strong></p>
            <div class="modal-buttons">
                <button class="btn confirm">Confirmar</button>
                <button class="btn cancel">Cancelar</button>
            </div>
        </div>
    </div>
</body>
</html>
