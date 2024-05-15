<?php

include_once "Pasajero.php";

class PasajeroVIP extends Pasajero {

    private $numPasajeroFrecuente;
    private $cantMillas;


    public function __construct($nombre, $apellido, $dni, $telefono ,$numDeAsiento, $numTicket, $cantMillas, $numPasajeroFrecuente){
        parent::__construct($nombre, $apellido, $dni, $telefono, $numDeAsiento, $numTicket);
        $this->numPasajeroFrecuente = $numPasajeroFrecuente;
        $this->cantMillas = $cantMillas;
    }

    public function getNumPasajeroFrecuente() {
      return $this->numPasajeroFrecuente;
    }
    public function setNumPasajeroFrecuente($value) {
      $this->numPasajeroFrecuente = $value;
    }

    public function getCantMillas() {
      return $this->cantMillas;
    }
    public function setCantMillas($value) {
      $this->cantMillas = $value;
    }

    public function __toString()
    {
        return parent::__toString() . "\nPasajero frecuente: " . $this->getNumPasajeroFrecuente() . "\nMillas: " . $this->getCantMillas() . "\n";
    }

}