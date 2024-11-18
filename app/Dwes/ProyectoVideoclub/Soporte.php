<?php
namespace Dwes\ProyectoVideoclub;
include_once "Resumible.php";
 abstract class Soporte implements Resumible{
    const IVA=1.21;
    public bool $alquilado = false;
    function __construct(public string $titulo, protected string $numero, private float $precio){}
    
    public function getprecio(): float{
        return $this->precio;
    }
    public function getPrecioConIva():float {
        return $this->precio * self::IVA;
    } 
    public function getNumero():int{
        return $this->numero;
    }
      public function muestraResumen():void{
        echo "<br>".$this->titulo . "<br>" . $this->precio ." € (IVA no incluido)" ;
    }
}


?>