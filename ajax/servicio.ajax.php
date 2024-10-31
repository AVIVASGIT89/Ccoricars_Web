<?php

require_once "../modelos/servicio.modelo.php";

$accion = $_POST["accion"];

if($accion == "registrarServicio"){

    $datosServicio = array(
        "idVehiculo" => $_POST["idVehiculo"],
        "fechaHoraIngreso" => $_POST["fechaIngreso"].' '.$_POST["horaIngreso"],
        "kilometraje" => $_POST["kilometraje"],
        "servicio" => $_POST["detalleServicio"]
       );

    $respuesta = ModeloServicio::mdlRegistrarIngreso($datosServicio);

    echo json_encode($respuesta);

}
else
if($accion == "registrarDetalleServicio"){

    $idServicio = $_POST["idServicio"];
    $listaProductos = $_POST["listaProductos"];

    foreach($listaProductos as $key => $value){

        $datosDetalleServicio = array(
                                "idServicio" => $idServicio,
                                "item" => $value["servicioProducto"],
                                "precioBase" => $value["base"],
                                "utilidad" => $value["utilidad"]
                            );

        $registroDetalleServicio = ModeloServicio::mdlRegistrarDetalleServicio($datosDetalleServicio);
        
    }

    return "ok";

}
else
if($accion == "finalizarServicio"){

    $idServicio = $_POST["idServicio"];
    $fechaHora = $_POST["fechaHora"];

    $respuesta = ModeloServicio::mdlFinalizarServicio($idServicio, $fechaHora);

    echo json_encode($respuesta);

}
else 
if($accion == "anularServicio"){

    $idServicio = $_POST["idServicio"];

    $respuesta = ModeloServicio::mdlAnularServicio($idServicio);

    echo json_encode($respuesta);

}
else 
if($accion == "listarIndicadores"){

    $respuesta = ModeloServicio::mdlListarIndicadoresServicios();

    echo json_encode($respuesta);

}
else 
if($accion == "listarSer6UltMeses"){

    $respuesta = ModeloServicio::mdlListarServicios6UltimosMeses();

    echo json_encode($respuesta);

}
else 
if($accion == "editarServicio"){

    $idServicio = $_POST["idServicio"];

    $respuesta = ModeloServicio::mdlListarServiciosPendientes($idServicio);

    echo json_encode($respuesta);

}
