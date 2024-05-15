<?php

include_once 'Pasajero.php';
include_once 'ResponsableV.php';

class Viaje {
    private $codigo; // Código único del viaje
    private $destino; // Destino del viaje
    private $responsableViaje; // Responsable del viaje
    private $costo;
    private $cantMaximaPasajeros;
    private $sumaCostoAbonadoPas;
    private $colPasajeros;



    /**
     * Constructor de la clase Viaje
     * @param string $codigo Código del viaje
     * @param string $destino Destino del viaje
     * @param int $cantMax Cantidad máxima de pasajeros permitidos
     * @param Pasajero $pasajeros Objeto Pasajero que representa a los pasajeros
     * @param ResponsableV $responsableViaje Objeto ResponsableV que representa al responsable del viaje
     */
    public function __construct($codigo, $destino, $cantMaximaPasajeros, $costo, $sumaCostoAbonadoPas, ResponsableV $responsableViaje, $colPasajeros)
    {
        $this->costo = $costo;
        $this->cantMaximaPasajeros = $cantMaximaPasajeros;
        $this->sumaCostoAbonadoPas = $sumaCostoAbonadoPas;
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->responsableViaje = $responsableViaje;
        $this->colPasajeros = $colPasajeros;
    }

    // Métodos getters para obtener los valores de los atributos

    public function getCosto() {
        return $this->costo;
      }
    public function setCosto($value) {
    $this->costo = $value;
    }
    public function getSumaCostoAbonadoPas() {
    return $this->sumaCostoAbonadoPas;
    }
    public function setSumaCostoAbonadoPas($value) {
        $this->sumaCostoAbonadoPas = $value;
    }
  
    public function getColPasajeros() {
    return $this->colPasajeros;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getCantMaximaPasajeros() {
        return $this->cantMaximaPasajeros;
    }

    public function setCantMaximaPasajeros($value) {
        $this->cantMaximaPasajeros = $value;
    }

    public function getDestino() {
        return $this->destino;
    }

    public function getResponsableV() {
        return $this->responsableViaje;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    /**
     * Establece el destino del viaje
     * @param string $destino Destino del viaje
     */
    public function setDestino($destino) {
        $this->destino = $destino;
    }

    /**
     * Establece el responsable del viaje
     * @param ResponsableV $responsableViaje Objeto ResponsableV que representa al responsable del viaje
     */
    public function setResponsableV($responsableViaje) {
        $this->responsableViaje = $responsableViaje;
    }
    
    /**
     * Verifica si hay mas de un instancia Pasajero en el array colPasajeros
     * @param int $dni que se usa como identificador
     * @return bool true si se encuentra más de una vez, false de lo contrario
     */
    public function chequearPasajero($dni){
        $k = 0;
        $contador = 0;
        $verif = false;
        while($k < count($this->getColPasajeros())){
            if($this->getColPasajeros()[$k]->getDni() == $dni){
                $contador++;
            }
            $k++;
        }
        if($contador >= 1){
            $verif = true;
        }
        return $verif;
    }

    /**
     * Chequea si count(colPasajeros) no llego al mismo numero cantMaxPasajeros
     * @return bool TRUE si hay espacio disponible
     */
    public function hayPasajesDisponibles(){
        $actualCantMax = count($this->getColPasajeros());
        $hayPasajes = false;
        if($actualCantMax < $this->getCantMaximaPasajeros()){
          $hayPasajes = true;
        }
        return $hayPasajes;
      }
  
      /**
       * Incorpora un pasajero en el array colPasajeros
       */
      public function setColPasajeros(Pasajero $objPasajero) {
          $this->colPasajeros[] = $objPasajero;
      }
  
      /**
       * Retorna monto a pagar del pasajero dependiendo de que clase de pasajero es (VIP, Especial o normal), actualiza el costo abonado del viaje e incorpora al pasajero en colPasajeros
       * @param Pasajero $objPasajero
       */
      public function venderPasaje(Pasajero $objPasajero){
          $this->setColPasajeros($objPasajero);
          $precioViaje = 0;
          foreach ($this->getColPasajeros() as $pasajero) {
              $precioViaje = ($pasajero->darPorcentajeIncremento() * $this->getCosto()) + $this->getCosto();
              $this->setSumaCostoAbonadoPas($this->getSumaCostoAbonadoPas() + $precioViaje);
          }
          $precioPasajeroActual = ($objPasajero->darPorcentajeIncremento() * $this->getCosto()) + $this->getCosto();
          return $precioPasajeroActual;
      }


    /**
     * Devuelve una representación en forma de string del objeto Viaje
     * @return string Representación en forma de cadena del objeto Viaje
     */
    public function __toString() {
        print_r($this->getColPasajeros());
        return (
            "Destino: " . $this->getDestino() . "\n" .
            "Costo: " . $this->getCosto() . "\n" .
            "Cant. Max. Pasajeros: " . $this->getCantMaximaPasajeros() . "\n" .
            "Suma Costo Abonado Pas.: " . $this->getSumaCostoAbonadoPas() . "\n" .
            "Cant. Pasajeros: " . count($this->getColPasajeros()) . "\n"
            . $this->getResponsableV()
        );
    }

}
