<?php
spl_autoload_register(function ($class) {
    $prefix = 'Dwes\\ProyectoVideoclub\\';
    $base_dir = __DIR__ . '/app/Dwes/ProyectoVideoclub/';
    
    // Verifica si la clase usa el prefijo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return; // no, pasa al siguiente autoload registrado
    }
    
    // Obtiene el nombre de la clase relativa al prefijo
    $relative_class = substr($class, $len);
    
    // Reemplaza el namespace con la ruta base y añade .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // Si el archivo existe, lo incluye
    if (file_exists($file)) {
        require $file;
    }
});
?>