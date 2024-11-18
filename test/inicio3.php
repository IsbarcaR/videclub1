<?php
include "../autoload.php";

use Dwes\ProyectoVideoclub\Videoclub;
session_start();
if (!isset($_SESSION['videoclub'])) {
    $vc = new Videoclub("Severo 8A"); 
    $_SESSION['videoclub'] = $vc;
} else {
    $vc = $_SESSION['videoclub'];
}




//voy a incluir unos cuantos soportes de prueba 
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1); 
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente", 4.5, "es","16:9"); 
$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9"); 
$vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9"); 
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107); 
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140); 

//listo los productos 
$vc->listarProductos(); 

//voy a crear algunos socios 
$vc->incluirSocio("Amancio Ortega","amancio","1234"); 
$vc->incluirSocio("Pablo Picasso", "pablo","1234"); 

$vc->alquilarSocioProducto(1,2); 
$vc->alquilarSocioProducto(1,3); 
//alquilo otra vez el soporte 2 al socio 1. 
// no debe dejarme porque ya lo tiene alquilado 
$vc->alquilarSocioProducto(1,2); 
//alquilo el soporte 6 al socio 1. 
//no se puede porque el socio 1 tiene 2 alquileres como máximo 
$vc->alquilarSocioProducto(1,6); 

//listo los socios 
$vc->listarSocios();
$_SESSION['videoclub'] = $vc;
?>