<?php

class ControladoMarcaVehiculo{

    //Listar marcas y modelos de vehiculos
    static public function ctrMarcasVehiculos($idMarca){
        
        $respuesta = ModeloMarcaVehiculo::mdlMarcasVehiculos($idMarca);

        return $respuesta;

    }


    //Registrar marca
    static public function ctrRegistrarMarca(){

        if(isset($_POST["nuevaMarca"])){

            $respuesta = ModeloMarcaVehiculo::mdlRegistrarMarca($_POST["nuevaMarca"]);

            if($respuesta == "ok"){

                //Llamamos al metodo cargarMarcasSession() que se encuentra en el controlador  "ControladorUsuario"
                cargarMarcasSession();

                echo '<script>

                            Swal.fire({
                                title: "Marca registrada correctamente",
                                icon: "success",
                                confirmButtonText: "Ok"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "marcavehiculo";
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


    //Editar marca
    static public function ctrEditarMarca(){

        if(isset($_POST["editarMarca"])){

            $datos = array(
                            "idMarca" => $_POST["hIdMarca"],
                            "nuevoNombreMarca" => $_POST["editarMarca"]
                          );

            $respuesta = ModeloMarcaVehiculo::mdlEditarMarca($datos);

            if($respuesta == "ok"){

                echo '<script>

                            Swal.fire({
                                title: "Marca actualizada correctamente",
                                icon: "success",
                                confirmButtonText: "Ok"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "marcavehiculo";
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