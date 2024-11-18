<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }
        form {
            background-color: #fff;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form action="createCliente.php" method="POST">
        <h2>Crear Nuevo Cliente</h2>
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="user">Usuario:</label>
        <input type="text" name="user" id="user" required>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Crear Cliente</button>
    </form>
</body>
</html>
