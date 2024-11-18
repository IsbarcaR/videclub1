<?php 
namespace Dwes\ProyectoVideoclub;

    session_start();
    $error='';
    if(isset($_SESSION['err'])){
        $error=$_SESSION['err'];
        unset($_SESSION['err']);
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        form {
            background-color: #fff;
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 15px;
        }
        label span {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #5cb85c;
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .error {
            color:red
        }
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <label for="usuario">
            <span>Usuario </span>
            <input type="text" name="usuario" id="usuario" required>
        </label>
        <label for="pass">
            <span>Contraseña</span>
            <input type="password" name="pass" id="pass" required>
        </label>
        <input type="submit" name="enviar" value="Enviar">
        <span class="error"  ><?php echo $error; ?></span>
    </form>
</body>
</html>
