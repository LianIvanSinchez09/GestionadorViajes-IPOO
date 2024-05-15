<?php

class PasajeroEspecial extends Pasajero {

    private $cantNecesidades;

    public function __construct($nombre, $apellido , $dni , $telefono ,$numDeAsiento, $numTicket, $cantNecesidades){
        parent::__construct($nombre, $apellido, $dni, $telefono, $numDeAsiento, $numTicket);
        $this->cantNecesidades = $cantNecesidades;
    }

    public function getCantNecesidades() {
      return $this->cantNecesidades;
    }
    public function setCantNecesidades($value) {
      $this->cantNecesidades = $value;
    }

    public function __toString(){
        return parent::__toString() . "\nCant. Necesidades: " . $this->getCantNecesidades() . "\n";
    }
}