<?php
require_once __DIR__ . '/../../../autoload.php';

use Dwes\ProyectoVideoclub\Cliente;

session_start();

// Verificar si el usuario está autenticado y no es administrador
if (!isset($_SESSION['user']) || $_SESSION['user'] instanceof Cliente === false) {
    header('Location: index.php');
    exit;
}

$cliente = $_SESSION['user'];
$alquileres = $cliente->getAlquileres();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alquileres del Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            max-width: 500px;
            margin: 20px auto;
        }
        li {
            background-color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 18px;
            color: #555;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        a {
            display: block;
            text-align: center;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            max-width: 200px;
        }
        a:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($cliente->nombre); ?></h1>
    <h2>Tus Alquileres:</h2>
    <ul>
        <?php if (empty($alquileres)): ?>
            <li>No tienes alquileres activos.</li>
        <?php else: ?>
            <?php foreach ($alquileres as $alquiler): ?>
                <li><?php echo htmlspecialchars($alquiler->titulo); ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
