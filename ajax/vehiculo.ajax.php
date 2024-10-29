<?php

require_once "../modelos/vehiculo.modelo.php";

$accion = $_POST["accion"];

if($accion == "buscarVehiculoPlaca"){

    $placaVehiculo = $_POST["placaVehiculo"];

    $respuesta = ModeloVehiculo::mdlListarVehiculos("PLACA_VEHICULO", $placaVehiculo);

    echo json_encode($respuesta);

}
