<?php

class ControladorUsuario{

    //Validar usuario
    public function ctrValidarUsuario(){
        
        if(isset($_POST["login"])){

            //Encriptamos password ingresado con el hash definido "$2a$07$usesomesillystringforsalt$" para comparar con password que esta guardado en BD encriptado con el mismo hash
            $passwordEncriptado = crypt($_POST["password"], '$2a$07$usesomesillystringforsalt$');

            $datosUsuario = array(
                                  "LOGIN" => $_POST["login"],
                                  "PASSWORD" => $passwordEncriptado
                                 );

            $respuesta = ModeloUsuarios::mdlValidarUsuario($datosUsuario);

            //var_dump($respuesta); return;    //var_dump muestra el valor o valores recibidos en "$respuesta" en formato array

            if($respuesta){

                if($respuesta["ESTADO_REGISTRO"] == "1"){
                
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["sIdUsuario"] = $respuesta["ID_USUARIO"];
                    $_SESSION["sUsuario"] = $respuesta["USUARIO"];
                    $_SESSION["sNombreUsuario"] = $respuesta["NOMBRE_USUARIO"];
                    $_SESSION["sRolUsuario"] = $respuesta["ROL_USUARIO"];

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


    //Listar usuarios
    static public function ctrListarUsuarios($item, $valor){

        $respuesta = ModeloUsuarios::mdlListarUsuarios($item, $valor);

        return $respuesta;

    }


    //Listar roles usuario
    static public function ctrListarRolesUsuario($item, $valor){

        $respuesta = ModeloUsuarios::mdlListarRolesUsuario($item, $valor);

        return $respuesta;

    }


    //Registrar nuevo usuario
    static public function ctrRegistrarUsuario(){

        if(isset($_POST["nuevoUsuario"])){

            //Encriptamos password ingresado con el hash definido "$2a$07$usesomesillystringforsalt$" para comparar con password que esta guardado en BD encriptado con el mismo hash
            $passwordEncriptado = crypt($_POST["claveUsuario"], '$2a$07$usesomesillystringforsalt$');

            $datos = array(
                "nombreUsuario" => $_POST["nombreUsuario"],
                "apellidoUsuario" => $_POST["apellidoUsuario"],
                "nuevoUsuario" => $_POST["nuevoUsuario"],
                "claveUsuario" => $passwordEncriptado,
                "rolUsuario" => $_POST["rolUsuario"]
               );

            $respuesta = ModeloUsuarios::mdlRegistrarUsuario($datos);

            if($respuesta == "ok"){

                echo '<script>
                        Swal.fire({
                            title: "Usuario registrado correctamente",
                            icon: "success",
                            allowOutsideClick: false,
                            confirmButtonText: "Ok"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "usuarios";
                            }
                        })
                      </script>';

            }else{

                echo '<script>
                        alert("Error");
                      </script>';

            }

        }

    }


    //Editar usuario
    static public function ctrEditarUsuario(){

        if(isset($_POST["nombreUsuarioEditar"])){

            //Encriptamos password ingresado con el hash definido "$2a$07$usesomesillystringforsalt$" para comparar con password que esta guardado en BD encriptado con el mismo hash
            $passwordEncriptado = crypt($_POST["claveUsuarioEditar"], '$2a$07$usesomesillystringforsalt$');

            $datos = array(
                "nombreUsuarioEditar" => $_POST["nombreUsuarioEditar"],
                "apellidoUsuarioEditar" => $_POST["apellidoUsuarioEditar"],
                "claveUsuarioEditar" => $passwordEncriptado,
                "rolUsuarioEditar" => $_POST["rolUsuarioEditar"],
                "idUsuarioEditar" => $_POST["idUsuarioEditar"]
               );

            $respuesta = ModeloUsuarios::mdlEditarUsuario($datos);

            if($respuesta == "ok"){

                echo '<script>
                        Swal.fire({
                            title: "Usuario actualizado correctamente",
                            icon: "success",
                            allowOutsideClick: false,
                            confirmButtonText: "Ok"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "usuarios";
                            }
                        })
                      </script>';

            }else{

                echo '<script>
                        alert("Error");
                      </script>';

            }

        }

    }


    //Desactivar usuario
    static public function ctrDesactivarUsuario($idUsuario){

        $respuesta = ModeloUsuarios::mdlDesactivarUsuario($idUsuario);

        return $respuesta;
        
    }


    //Activar usuario
    static public function ctrActivarUsuario($idUsuario){

        $respuesta = ModeloUsuarios::mdlActivarUsuario($idUsuario);

        return $respuesta;
        
    }

}


//Cargar lista marcas session
function cargarMarcasSession(){

    $listaMarcasVehiculo = ModeloMarcaVehiculo::mdlListarMarcasVehiculo();

    $_SESSION["sMarcasVehiculo"] = $listaMarcasVehiculo;

}