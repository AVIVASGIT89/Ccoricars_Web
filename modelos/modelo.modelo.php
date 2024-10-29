<?php

require_once "conexion.php";

class ModeloModeloVehiculo{

    //Listar modelos de marca
    static public function mdlListarModelosVehiculo($marca){

        $stmt = Conexion::conectar()->prepare("SELECT M.ID_MODELO, M.NOMBRE_MODELO FROM modelo_vehiculo M WHERE M.ID_MARCA = :ID_MARCA AND M.ESTADO_REGISTRO = 1 ORDER BY M.NOMBRE_MODELO");

        $stmt -> bindParam(":ID_MARCA", $marca, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();    //Devolvemos todos los registros encontrados

        $stmt = null;

    }


    //Listar marcas y modelos de vehiculos
    static public function mdlListarMarcaModelosVehiculo($idModelo){

        if($idModelo != "0"){

            $condicion = " AND ID_MODELO = $idModelo ";

        }else{

            $condicion = "";

        }

        $stmt = Conexion::conectar()->prepare("SELECT M.ID_MARCA, 
                                                      D.ID_MODELO, 
                                                      M.NOMBRE_MARCA, 
                                                      D.NOMBRE_MODELO,
                                                      D.USUARIO_REGISTRO
                                                FROM marca_vehiculo M
                                                INNER JOIN modelo_vehiculo D ON D.ID_MARCA = M.ID_MARCA
                                                WHERE M.ESTADO_REGISTRO = 1 $condicion
                                                AND D.ESTADO_REGISTRO = 1
                                                ORDER BY M.NOMBRE_MARCA");

        $stmt -> execute();

        return $stmt -> fetchAll();    //Devolvemos todos los registros encontrados

        $stmt -> close();

        $stmt = null;

    }


    //Registrar nuevo modelo
    static public function mdlRegistrarModelo($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO modelo_vehiculo (ID_MARCA,
                                                                            NOMBRE_MODELO,
                                                                            USUARIO_REGISTRO)
                                                                    VALUES(:ID_MARCA,
                                                                           INITCAP(:NOMBRE_MODELO),
                                                                           :USUARIO_REGISTRO)");

        $stmt -> bindParam(":ID_MARCA", $datos["idMarca"], PDO::PARAM_STR);
        $stmt -> bindParam(":NOMBRE_MODELO", $datos["nuevoModelo"], PDO::PARAM_STR);
        $stmt -> bindParam(":USUARIO_REGISTRO", $_SESSION["sUsuario"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

        $stmt = null;

    }


    //Editar modelo
    static public function mdlEditarModelo($datos){

        $stmt = Conexion::conectar()->prepare("UPDATE modelo_vehiculo SET NOMBRE_MODELO = INITCAP(:NOMBRE_MODELO),
                                                                          ID_MARCA = :ID_MARCA
                                                                    WHERE ID_MODELO = :ID_MODELO");

        $stmt -> bindParam(":NOMBRE_MODELO", $datos["editarModelo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ID_MARCA", $datos["editarMarcaVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ID_MODELO", $datos["hIdModelo"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }


}