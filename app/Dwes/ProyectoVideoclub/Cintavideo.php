<?php
namespace Dwes\ProyectoVideoclub;
    class CintaVideo extends Soporte{
        
        function __construct(public string $titulo, protected string $numero, private float $precio,private int $duracion){
            parent::__construct($titulo,$numero,$precio);
        }

        public function muestraResumen(): void
        {
            parent::muestraResumen();
            echo "<br>Cinta VHS <br>Duracion:" . $this->duracion ." minutos <br>"; 
        }
    }