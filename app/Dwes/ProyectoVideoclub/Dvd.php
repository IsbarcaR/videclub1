<?php
namespace Dwes\ProyectoVideoclub;

class Dvd extends Soporte{
        
    function __construct(public string $titulo, protected string $numero, private float $precio,private string $idioma, private string $formatoPantalla){
        parent::__construct($titulo,$numero,$precio);
    }

    public function muestraResumen(): void
    { 
        parent::muestraResumen();
        echo "<br>Idioma: " . $this->idioma ; 
        echo "<br>Formato: " . $this->formatoPantalla ."<br>"; 


    }
}

?>