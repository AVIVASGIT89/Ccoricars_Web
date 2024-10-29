<?php

require_once "../modelos/marca.modelo.php";

$accion = $_POST["accion"];

if($accion == "buscarMarca"){

    $idMarca = $_POST["idMarca"];

    $respuesta = ModeloMarcaVehiculo::mdlMarcasVehiculos($idMarca);

    echo json_encode($respuesta);

}