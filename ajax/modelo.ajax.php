<?php

require_once "../modelos/modelo.modelo.php";

$accion = $_POST["accion"];

if($accion == "listarModelos"){

    $marcaVehiculo = $_POST["marcaVehiculo"];

    $respuesta = ModeloModeloVehiculo::mdlListarModelosVehiculo($marcaVehiculo);

    echo json_encode($respuesta);

}
else 
if($accion == "buscarModelo"){

    $idModelo = $_POST["idModelo"];

    $respuesta = ModeloModeloVehiculo::mdlListarMarcaModelosVehiculo($idModelo);

    echo json_encode($respuesta);

}