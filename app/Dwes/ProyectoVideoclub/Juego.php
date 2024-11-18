<?php
namespace Dwes\ProyectoVideoclub;
class Juego extends Soporte
{
    function __construct(
        public string $titulo,
        protected string $numero,
        private float $precio,
        private string $consola,
        private int $minNumJugadores,
        private int $maxNumJugadores
        
    ) { 
        parent::__construct($titulo, $numero, $precio);
    }
    public function muestraJugadoresPosibles(): void
    {
        if ($this->maxNumJugadores == 1 && $this->minNumJugadores == 1) {
            echo ("Para un jugador");
        } elseif ($this->minNumJugadores === $this->maxNumJugadores) {
            echo "Para {$this->minNumJugadores} jugadores";
        } else {
            echo "De {$this->minNumJugadores} a {$this->maxNumJugadores} jugadores";
        }
    }
    public function muestraResumen(): void
    {
        parent::muestraResumen(); // Muestra el resumen de Soporte
        echo "<br>Juego de consola: " . $this->consola;
        echo "<br>Número mínimo de jugadores: " . $this->minNumJugadores;
        echo "<br>Número máximo de jugadores: " . $this->maxNumJugadores;
        echo "<br>";
        $this->muestraJugadoresPosibles();
    }
}
