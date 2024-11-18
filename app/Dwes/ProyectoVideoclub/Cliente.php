<?php
namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;
use Dwes\ProyectoVideoclub\Soporte;

class Cliente
{
    public array $soportesAlquilados = [];
    private int $numSoportesAlquilados = 0;
    private int $maxAlquilerConcurrente = 3;

    public function __construct(
        public string $nombre,
        public int $numero,
        public string $user,
        public string $password
    ) {}

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero($numero): void
    {
        $this->numero = $numero;
    }
    public function getAlquileres(): array
    {
        return $this->soportesAlquilados;
    }

    public function getNumSoportesAlquilado()
    {
        return $this->numSoportesAlquilados;
    }

    public function muestraResumen(): void
    {
        echo "Nombre del cliente: " . $this->nombre;
        echo "<br>Cantidad de alquileres: " . count($this->soportesAlquilados);
    }

    public function alquilarSoporte(Soporte $soporte): void
    {
        if (count($this->soportesAlquilados) < $this->maxAlquilerConcurrente) {
            $this->soportesAlquilados[] = $soporte;
            $this->numSoportesAlquilados++;
        } else {
            echo "Límite de alquileres concurrentes alcanzado.";
        }
    }

    private function tieneSoporte(Soporte $s): bool
    {
        foreach ($this->soportesAlquilados as $soporte) {
            if ($soporte === $s) {
                return true;
            }
        }
        return false;
    }

    public function alquilar(Soporte $s): self
    {
        if ($this->tieneSoporte($s)) {
            throw new SoporteYaAlquiladoException("El soporte '{$s->titulo}' ya está alquilado por este cliente.");
        }

        if (count($this->soportesAlquilados) >= $this->maxAlquilerConcurrente) {
            throw new CupoSuperadoException("El cliente ha alcanzado el máximo de alquileres.");
        }

        $this->soportesAlquilados[] = $s;
        $this->numSoportesAlquilados++;
        return $this;
    }

    public function devolver(int $numeroSoporte): self
    {
        foreach ($this->soportesAlquilados as $key => $soporte) {
            if ($soporte->numero === $numeroSoporte) {
                unset($this->soportesAlquilados[$key]);
                $this->numSoportesAlquilados--;
                return $this;
            }
        }

        throw new SoporteNoEncontradoException("No se encontró el soporte con número {$numeroSoporte} entre los alquilados.");
    }

    public function listaAlquileres(): void
    {
        echo "El cliente " . $this->nombre . " tiene " . count($this->soportesAlquilados) . " alquiler(es):<br>";
        if (count($this->soportesAlquilados) === 0) {
            echo "No hay alquileres activos.<br>";
            return;
        }

        foreach ($this->soportesAlquilados as $soporte) {
            echo "- " . $soporte->titulo . "<br>";
        }
    }
}
?>