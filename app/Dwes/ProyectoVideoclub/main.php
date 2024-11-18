<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

if ($_SESSION['user'] === 'admin') {
    header('Location: mainAdmin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 30px;
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
    <h1>Hola, <?php echo htmlspecialchars($_SESSION['user']); ?>. ¡Bienvenido al Videoclub!</h1>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
