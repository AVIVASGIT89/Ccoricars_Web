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
                                allowOutsideClick: false,
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


    //Registrar vehiculo
    static public function ctrEditarVehiculo(){

        if(isset($_POST["idVehiculoEditar"])){

            $datosVehiculo = array(
                                "idVehiculoEditar" => $_POST["idVehiculoEditar"],
                                "marcaVehiculo" => $_POST["idMarcaVehiculoEditar"],
                                "modeloVehiculo" => $_POST["idModeloVehiculoEditar"],
                                "anioFabricacion" => $_POST["anioFabricacionEditar"],
                                "nroMotor" => $_POST["nroMotorEditar"],
                                "color" => $_POST["colorEditar"],
                                "responsable" => $_POST["responsableEditar"]
                              );

            $respuesta = ModeloVehiculo::mdlEditarVehiculo($datosVehiculo);

            if($respuesta == "ok"){

                echo '<script>

                            Swal.fire({
                                title: "Vehiculo actualizado correctamente",
                                icon: "success",
                                allowOutsideClick: false,
                                confirmButtonText: "Ok"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "vehiculos";
                                }
                            })

                    </script>';

            }else{

                echo '<script>
                            alert("Error en actualizacion");
                    </script>';

            }

        }

    }

}