<?php
require_once __DIR__ . '/../../../autoload.php';

use Dwes\ProyectoVideoclub\Videoclub;

session_start();

// Verificar si el usuario está autenticado y es administrador
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// Recuperar el objeto Videoclub de la sesión
if (!isset($_SESSION['videoclub'])) {
    echo "No se ha inicializado el videoclub.";
    exit;
}

$videoclub = $_SESSION['videoclub'];

// Obtener la lista de clientes
$clientes = $videoclub->listarSocios();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }

        h1,
        h2 {
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
    <h1>Bienvenido, Administrador</h1>

    <h2>Listado de Clientes:</h2>
    <ul>
        <?php if (empty($clientes)) { ?>
            <li>No hay clientes registrados.</li>
        <?php } else { ?>
            <?php foreach ($clientes as $cliente) { ?>
                <li>
                    <?php
                    echo "ID: " . htmlspecialchars($cliente->getNumero()) .
                        " - Nombre: " . htmlspecialchars($cliente->nombre) .
                        " - Usuario: " . htmlspecialchars($cliente->user);
                    ?>
                </li>
            <?php } ?>
        <?php } ?>

    </ul>

    <a href="formCreateCliente.php">Crear Nuevo Cliente</a>
    <a href="logout.php">Cerrar Sesión</a>
</body>

</html>