<?php

require_once "conexion.php";

class ModeloUsuarios{

    static public function MdlValidarUsuario($datosUsuario){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuario WHERE USUARIO = :USUARIO AND CLAVE = :CLAVE");

        $stmt -> bindParam(":USUARIO", $datosUsuario["LOGIN"], PDO::PARAM_STR);
        $stmt -> bindParam(":CLAVE", $datosUsuario["PASSWORD"], PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();    //Devolvemos el registro encontrado

        $stmt = null;

    }

}