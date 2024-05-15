<?php

class Pasajero {
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;
    private $numDeAsiento;
    private $numTicket;

    public function __construct($nombre, $apellido, $dni, $telefono, $numDeAsiento, $numTicket)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->telefono = $telefono;
        $this->numDeAsiento = $numDeAsiento;
        $this->numTicket = $numTicket;
    }

    // Métodos de acceso para cada atributo
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    // Métodos setters para establecer nuevos valores a los atributos
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }    

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }    
    public function getNumTicket() {
      return $this->numTicket;
    }
    public function setNumTicket($value) {
      $this->numTicket = $value;
    }
    public function getNumDeAsiento() {
      return $this->numDeAsiento;
    }
    public function setNumDeAsiento($value) {
      $this->numDeAsiento = $value;
    }

    public function darPorcentajeIncremento() {
        $porcentajeIncremento = 0.10;
        if($this instanceof PasajeroVIP) {
            $porcentajeIncremento = 0.35;
            if($this->getCantMillas() > 300){
                $porcentajeIncremento += 0.30;
            }
        }elseif($this instanceof PasajeroEspecial) {
            if($this->getCantNecesidades() >= 2){
                $porcentajeIncremento = 0.30;
            }else{
                $porcentajeIncremento = 0.15;
            }
        }
        return $porcentajeIncremento;
    }

    public function __toString()
    {
        return 
            "-Pasajero-\n" .
            "Nombre: " . $this->nombre . "\n" .
            "Apellido: " . $this->apellido . "\n" .
            "DNI: " . $this->dni . "\n" .
            "Teléfono: " . $this->telefono . "\n";
    }



}