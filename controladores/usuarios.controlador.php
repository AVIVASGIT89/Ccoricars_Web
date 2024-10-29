<?php

class ControladorUsuario{

    //Ingresar usuario
    public function ctrValidarUsuario(){
        
        if(isset($_POST["login"])){

            $datosUsuario = array(
                                  "LOGIN" => $_POST["login"],
                                  "PASSWORD" => $_POST["password"]
                                 );

            $respuesta = ModeloUsuarios::MdlValidarUsuario($datosUsuario);

            //var_dump($respuesta); return;    //var_dump muestra el valor o valores recibidos en "$respuesta" en formato array

            if($respuesta){

                if($respuesta["ESTADO_REGISTRO"] == "1"){
                
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["sIdUsuario"] = $respuesta["ID_USUARIO"];
                    $_SESSION["sUsuario"] = $respuesta["USUARIO"];
                    $_SESSION["sNombreUsuario"] = $respuesta["NOMBRE_USUARIO"];

                    cargarMarcasSession();

                    echo '<script>
                            window.location = "inicio";
                          </script>';
                    
                }else{

                    echo '<br> <div class="alert alert-danger">El usuario no se encuentra activo</div>';

                }

            }else{

                echo '<br> <div class="alert alert-danger">Error, vuelve a intentarlo</div>';

            }

        }

    }

}


//Cargar lista marcas session
function cargarMarcasSession(){

    $listaMarcasVehiculo = ModeloMarcaVehiculo::mdlListarMarcasVehiculo();

    $_SESSION["sMarcasVehiculo"] = $listaMarcasVehiculo;

}