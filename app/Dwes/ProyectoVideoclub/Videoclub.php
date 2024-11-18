<?php
namespace Dwes\ProyectoVideoclub;
//use Dwes\ProyectoVideoclub\CintaVideo;  
use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;
use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;
use Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException;

class Videoclub {
    private array $productos = []; // Array de Soporte
    private array $socios = []; // Array de Cliente
    
    private int $numProductosAlquilados = 0;  
    private int $numTotalAlquileres = 0;   

    
    public function getNumProductosAlquilados(): int {
        return $this->numProductosAlquilados;
    }

    public function getNumTotalAlquileres(): int {
        return $this->numTotalAlquileres;
    }

    // Método privado para incluir un producto
    private function incluirProducto(Soporte $soporte): void {
        $this->productos[] = $soporte; // Agrega el soporte al array de productos
    }

    // Método para incluir un juego
    public function incluirJuego(string $titulo, float $precio, string $consola, int $minNumJugadores, int $maxNumJugadores): void {
        $juego = new Juego($titulo, "J" . (count($this->productos) + 1), $precio, $consola, $minNumJugadores, $maxNumJugadores);
        $this->incluirProducto($juego);
    }

    // Método para incluir un DVD
    public function incluirDvd(string $titulo, float $precio, string $idioma, string $formatoPantalla): void {
        $dvd = new Dvd($titulo, "D" . (count($this->productos) + 1), $precio, $idioma, $formatoPantalla);
        $this->incluirProducto($dvd);
    }

    // Método para incluir una cinta de video
    public function incluirCintaVideo(string $titulo, float $precio, int $duracion): void {
        $cinta = new CintaVideo($titulo, "C" . (count($this->productos) + 1), $precio, $duracion);
        $this->incluirProducto($cinta);
    }


    // Método para incluir un socio
    public function incluirSocio(string $nombre, string $user, string $password, int $maxAlquilerConcurrente = 3) {
        $numeroSocio = count($this->socios) + 1;
        $socio = new Cliente($nombre, $numeroSocio, $user, $password);
        $this->socios[] = $socio;
        return $this;
    }

    // Método para alquilar un producto a un socio
    public function alquilarSocioProducto(int $numSocio, int $numeroProducto): void {
        try {
            if (!isset($this->socios[$numSocio])) {
                throw new ClienteNoEncontradoException("No se encontró el cliente con índice {$numSocio}.");
            }
    
            if (!isset($this->productos[$numeroProducto])) {
                throw new SoporteNoEncontradoException("No se encontró el soporte con índice {$numeroProducto}.");
            }
    
            $cliente = $this->socios[$numSocio];
            $soporte = $this->productos[$numeroProducto];
    
            // Intentar alquilar el soporte para el cliente
            $cliente->alquilar($soporte);
    
        } catch (SoporteYaAlquiladoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        } catch (CupoSuperadoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        } catch (SoporteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        } catch (ClienteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    }

    // Método para listar productos
    public function listarProductos(): void {
        echo "<h2>Productos disponibles:</h2>";
        foreach ($this->productos as $producto) {
            $producto->muestraResumen();
            echo "<br>";
        }
    }

    // Método para listar socios
    public function listarSocios(): array {
        return $this->socios;
    }
    public function alquilarSocioPelicula(int $socioIndex, int $productoIndex): void {
        try {
            if (!isset($this->socios[$socioIndex])) {
                throw new ClienteNoEncontradoException("No se encontró el cliente con índice {$socioIndex}.");
            }

            if (!isset($this->productos[$productoIndex])) {
                throw new SoporteNoEncontradoException("No se encontró el soporte con índice {$productoIndex}.");
            }

            $cliente = $this->socios[$socioIndex];
            $soporte = $this->productos[$productoIndex];

            // Intentar alquilar el soporte para el cliente
            $cliente->alquilar($soporte);

        } catch (SoporteYaAlquiladoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        } catch (CupoSuperadoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        } catch (SoporteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        } catch (ClienteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    }
    public function alquilarSocioProductos(int $numSocio, array $numerosProductos): void {
        // Comprobar si todos los productos están disponibles
        foreach ($numerosProductos as $numProducto) {
            if (!isset($this->productos[$numProducto]) || $this->productos[$numProducto]->alquilado) {
                echo "No se puede alquilar porque el producto con número {$numProducto} no está disponible.<br>";
                return;
            }
        }
    
        // Todos los productos están disponibles, proceder a alquilarlos
        foreach ($numerosProductos as $numProducto) {
            $this->productos[$numProducto]->alquilado = true;
            $this->numProductosAlquilados++;
            $this->numTotalAlquileres++;
        }
    
        echo "Alquiler realizado exitosamente para el cliente número {$numSocio}.<br>";
    }
    public function devolverSocioProducto(int $numSocio, int $numeroProducto): self {
        // Comprobar si el producto está alquilado y proceder a devolverlo
        if (isset($this->productos[$numeroProducto]) && $this->productos[$numeroProducto]->alquilado) {
            $this->productos[$numeroProducto]->alquilado = false;
            $this->numProductosAlquilados--;
        } else {
            echo "El producto con número {$numeroProducto} no está actualmente alquilado o no existe.<br>";
        }
    
        return $this; // Permitir encadenamiento de métodos
    }
    
    public function devolverSocioProductos(int $numSocio, array $numerosProductos): self {
        foreach ($numerosProductos as $numeroProducto) {
            if (isset($this->productos[$numeroProducto]) && $this->productos[$numeroProducto]->alquilado) {
                $this->productos[$numeroProducto]->alquilado = false;
                $this->numProductosAlquilados--;
                echo "Producto con número {$numeroProducto} devuelto exitosamente.<br>";
            } else {
                echo "El producto con número {$numeroProducto} no está actualmente alquilado o no existe.<br>";
            }
        }
    
        return $this; // Permitir encadenamiento de métodos
    }
    
}

?>
