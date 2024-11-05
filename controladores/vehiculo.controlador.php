<?php

class ControladorVehiculo{

    //Lista vehiculos
    static public function ctrListarVehiculos($item, $valor){

        $respuesta = ModeloVehiculo::mdlListarVehiculos($item, $valor);

        return $respuesta;

    }


    //Registrar vehiculo
    static public function ctrRegistrarVehiculo(){

        if(isset($_POST["nuevoPlacaVehiculo"])){

            $datosVehiculo = array(
                                "placaVehiculo" => $_POST["nuevoPlacaVehiculo"],
                                "marcaVehiculo" => $_POST["idMarcaVehiculo"],
                                "modeloVehiculo" => $_POST["idModeloVehiculo"],
                                "anioFabricacion" => $_POST["anioFabricacion"],
                                "nroMotor" => $_POST["nroMotor"],
                                "color" => $_POST["color"],
                                "responsable" => $_POST["responsable"]
                              );

            $respuesta = ModeloVehiculo::mdlRegistrarVehiculo($datosVehiculo);

            if($respuesta == "ok"){

                echo '<script>

                            Swal.fire({
                                title: "Vehiculo registrado correctamente",
                                icon: "success",
                                confirmButtonText: "Ok"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "vehiculos";
                                }
                            })

                    </script>';

            }else{

                echo '<script>
                            alert("Error en registro");
                    </script>';

            }

        }

    }

}