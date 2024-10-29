<?php

class ControladorModeloVehiculo{

    //Listar marcas y modelos de vehiculos
    static public function ctrModeloVehiculos($idModelo){
        
        $respuesta = ModeloModeloVehiculo::mdlListarMarcaModelosVehiculo($idModelo);

        return $respuesta;

    }


    //Registrar modelo
    static public function ctrRegistrarModelo(){

        if(isset($_POST["nuevoModelo"])){

            $datos = array(
                "idMarca" => $_POST["MarcaVehiculo"],
                "nuevoModelo" => $_POST["nuevoModelo"]
               );

            $respuesta = ModeloModeloVehiculo::mdlRegistrarModelo($datos);

            if($respuesta == "ok"){

                echo '<script>

                            Swal.fire({
                                title: "Modelo registrado correctamente",
                                icon: "success",
                                confirmButtonText: "Ok"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "modelovehiculo";
                                }
                            })

                    </script>';

            }else{

                echo '<script>
                        toastr.error("Error, no se pudo realizar el registro");
                    </script>';

            }

        }

    }


    //Editar modelo
    static public function ctrEditarModelo(){

        if(isset($_POST["editarModelo"])){

            $datos = array(
                            "editarModelo" => $_POST["editarModelo"],
                            "editarMarcaVehiculo" => $_POST["editarMarcaVehiculo"],
                            "hIdModelo" => $_POST["hIdModelo"]
                          );

            $respuesta = ModeloModeloVehiculo::mdlEditarModelo($datos);

            if($respuesta == "ok"){

                echo '<script>

                            Swal.fire({
                                title: "Modelo actualizado correctamente",
                                icon: "success",
                                confirmButtonText: "Ok"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "modelovehiculo";
                                }
                            })

                    </script>';

            }else{

                echo '<script>
                        toastr.error("Error, no se pudo realizar el registro");
                    </script>';

            }

        }

    }

}