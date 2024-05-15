<?php

include_once 'Pasajero.php';
include_once 'PasajeroVIP.php';
include_once 'PasajeroEspecial.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';

/** Menu para el pasajero - Retorna nueva instancia de la clase Pasajero
 * @return Pasajero object
 */
function displayMenuPasajero(){
    echo "Nombre: ";
    $nombre = trim(fgets(STDIN));
    echo "Apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "DNI: ";
    $dni = trim(fgets(STDIN));
    echo "Telefono: ";
    $tel = trim(fgets(STDIN));
    echo "Numero de asiento: ";
    $numAsiento = trim(fgets(STDIN));
    echo "Numero de ticket: ";
    $numTicket = trim(fgets(STDIN));
    echo "Seleccione tipo de viaje: \n";
    echo "1. Primera Clase (VIP)\n";
    echo "2. Cuidados especiales (Especial)\n";
    echo "3. Pasajero normal\n";
    $seleccion = trim(fgets(STDIN));
    switch ($seleccion) {
        case 1:
            echo "Cantidad de millas a recorrer: ";
            $millas = trim(fgets(STDIN));
            echo "Numero de pasajero frecuente: ";
            $numPasajeroFrecuente = trim(fgets(STDIN));
            $newPasajero = new PasajeroVIP($nombre, $apellido, $dni, $tel, $numAsiento, $numTicket, $millas, $numPasajeroFrecuente);
            break;
        case 2:
            $count = 0;
            $exit = false;
            do {
                echo "-------Necesidades especiales--------\n";
                echo "1. Silla de ruedas\n";
                echo "2. Asistencia\n";
                echo "3. Comida especial\n";
                echo "4. Salir\n";
                echo "Opcion: \n";
                $opcion = trim(fgets(STDIN));
                switch ($opcion) {
                    case 1:
                        $count++;
                        break;
                    case 2:
                        $count++;
                        break;
                    case 3:
                        $count++;
                    case 4:
                        $exit = true;
                    default:
                        break;
                }
            } while (!$exit);
            $newPasajero = new PasajeroEspecial($nombre, $apellido, $dni, $tel, $numAsiento, $numTicket, $count);
        default:
            break;
    }
    return $newPasajero;
}

/** Menu para el conductor - Retorna nueva instancia de la clase ResponsableV
 * @return ResponsableV object
 */

function displayMenuResponsableV(){
    echo "Numero de Empleado: ";
    $nEmpleado = trim(fgets(STDIN));
    echo "Numero de Licencia: ";
    $nLicencia = trim(fgets(STDIN));
    echo "Nombre de conductor: ";
    $nConductor = trim(fgets(STDIN));
    echo "Apellido de conductor: ";
    $conductorApellido = trim(fgets(STDIN));
    $cond = new ResponsableV($nEmpleado, $nLicencia, $nConductor, $conductorApellido);

    return $cond;
}

$res = new ResponsableV(123, 5000, "Luciano", "Sinchez");

$newViaje = new Viaje("43530623", "Lima", 10, 2000, 2000, $res, []);

$pasajero1 = new PasajeroVIP("Nombre1", "Apellido1", 12345678, 987654321, 1, 1, 1000, 111111);
$pasajero2 = new PasajeroVIP("Nombre2", "Apellido2", 23456789, 876543219, 2, 2, 1000, 222222);
$pasajero3 = new PasajeroVIP("Nombre3", "Apellido3", 34567890, 765432198, 3, 3, 1000, 333333);
$pasajero4 = new PasajeroVIP("Nombre4", "Apellido4", 45678901, 654321987, 4, 4, 1000, 444444);
$pasajero5 = new PasajeroVIP("Nombre5", "Apellido5", 56789012, 543219876, 5, 5, 1000, 555555);
$pasajero6 = new PasajeroVIP("Nombre6", "Apellido6", 67890123, 432198765, 6, 6, 1000, 666666);
$pasajero7 = new PasajeroVIP("Nombre7", "Apellido7", 78901234, 321987654, 7, 7, 1000, 777777);
$pasajero8 = new PasajeroVIP("Nombre8", "Apellido8", 89012345, 219876543, 8, 8, 1000, 888888);
$pasajero9 = new PasajeroVIP("Nombre9", "Apellido9", 90123456, 109876543, 9, 9, 1000, 999999);


$newViaje->setColPasajeros($pasajero1);
$newViaje->setColPasajeros($pasajero2);
$newViaje->setColPasajeros($pasajero3);
$newViaje->setColPasajeros($pasajero4);
$newViaje->setColPasajeros($pasajero5);
$newViaje->setColPasajeros($pasajero6);
$newViaje->setColPasajeros($pasajero7);
$newViaje->setColPasajeros($pasajero8);
$newViaje->setColPasajeros($pasajero9);

/** Menu Principal - Muestra datos por pantalla
 * @return ResponsableV object
 */

function MenuPrincipal($newViaje){
    do {
        echo "MENU\n";
        echo "1. Vender Pasaje\n";
        echo "2. Reemplazar conductor\n";
        echo "3. Mostrar detalles del viaje\n";
        echo "4. Salir\n";
        echo "Ingrese su opción: ";
        $opcion = trim(fgets(STDIN));
        switch ($opcion) {
            case 1:
                echo "--------------Pasajero---------------------" . "\n";
                $newPasajero = displayMenuPasajero();
                $verificadorPasajero = $newViaje->chequearPasajero($newPasajero->getDni());
                if($verificadorPasajero){
                    do {
                        echo "ERROR: Pasajero ya está a bordo. Introduzca nuevo pasajero: \n";
                        $newPasajero = displayMenuPasajero();
                        $verificadorPasajero = $newViaje->chequearPasajero($newPasajero->getDni());
                    } while ($verificadorPasajero);
                }
                if($newViaje->hayPasajesDisponibles() && !$newViaje->chequearPasajero($newPasajero->getDni())){
                    echo "Pasaje vendido. Precio: " . $newViaje->venderPasaje($newPasajero);
                }else{
                    echo "ERROR: No hay pasajes disponibles.\n";
                }
                break;
            case 2:
                echo "--------------Conductor--------------------" . "\n";
                $conductor = displayMenuResponsableV();
                $newViaje->setResponsableV($conductor);
                break;
            case 3:
                echo $newViaje;
            default:
                break;
        }
    } while (true);  
}


MenuPrincipal($newViaje);





