<?php
session_start();
require_once __DIR__ . '/../../../autoload.php';

use Dwes\ProyectoVideoclub\Videoclub;



if (!isset($_SESSION['videoclub'])) {
    $videoclub = new Videoclub();

    $videoclub
        ->incluirSocio('Cliente 1', 'cliente1', 'pass1')
        ->incluirSocio('Cliente 2', 'cliente2', 'pass2')
        ->incluirSocio('Cliente 3', 'cliente3', 'pass3');

    $_SESSION['videoclub'] = $videoclub;
} else {
    $videoclub = $_SESSION['videoclub'];
}

if (isset($_POST['enviar'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['pass'];

    if ($usuario === 'admin' && $password === 'admin') {
        $_SESSION['user'] = $usuario;
        header('Location: mainAdmin.php');
        exit;
    }

    foreach ($videoclub->listarSocios() as $cliente) {
        if ($cliente->user === $usuario && $cliente->password === $password) {
            $_SESSION['user'] = $cliente;
            header('Location: mainCliente.php');
            exit;
        }
    }

    // Si no se encuentra un cliente válido
    $_SESSION['err'] = "Usuario o contraseña incorrectos.";
    header("Location: index.php");
    exit;
}
