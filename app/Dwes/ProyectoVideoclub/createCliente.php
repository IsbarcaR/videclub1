<?php
require_once __DIR__ . '/../../../autoload.php';

use Dwes\ProyectoVideoclub\Cliente;

session_start();

$nombre = $_POST['nombre'] ?? null;
$user = $_POST['user'] ?? null;
$password = $_POST['password'] ?? null;



$clientes = $_SESSION['clientes'] ?? [];
$nuevoCliente = new Cliente($nombre, count($clientes) + 1, $user, $password);

$clientes[] = $nuevoCliente;
$_SESSION['clientes'] = $clientes;

header('Location: mainAdmin.php');
exit;
