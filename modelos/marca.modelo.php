<?php

require_once "conexion.php";

class ModeloMarcaVehiculo{

    //Listar ID y Nombre de marcas de vehiculos para carga en combo box
    static public function mdlListarMarcasVehiculo(){

        $stmt = Conexion::conectar()->prepare("SELECT M.ID_MARCA, 
                                                            M.NOMBRE_MARCA
                                                    FROM marca_vehiculo M 
                                                    WHERE M.ESTADO_REGISTRO = 1 
                                                    ORDER BY M.NOMBRE_MARCA");

        $stmt -> execute();

        $idMarca = array();
        $nombreMarca = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $idMarca[] = $row["ID_MARCA"];
            $nombreMarca[] = $row["NOMBRE_MARCA"];

        }

        $arrayMarcasVehiculo = array("ID"  => $idMarca,
                                     "MARCA" => $nombreMarca);

        return $arrayMarcasVehiculo;

        $stmt = null;

    }


    //Registrar nuevo ingreso
    static public function mdlRegistrarMarca($nombreMarca){

        $stmt = Conexion::conectar()->prepare("INSERT INTO marca_vehiculo(NOMBRE_MARCA,
                                                                                USUARIO_REGISTRO) 
                                                            VALUES (INITCAP(:NOMBRE_MARCA),
                                                                    :USUARIO_REGISTRO)");

        $stmt -> bindParam(":NOMBRE_MARCA", $nombreMarca, PDO::PARAM_STR);
        $stmt -> bindParam(":USUARIO_REGISTRO", $_SESSION["sUsuario"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }


    //Listar marcas de vehiculos
    static public function mdlMarcasVehiculos($idMarca){

        if($idMarca != "0"){

            $condicion = " AND ID_MARCA = $idMarca ";

        }else{

            $condicion = "";

        }

        $stmt = Conexion::conectar()->prepare("SELECT ID_MARCA, 
                                                      NOMBRE_MARCA ,
                                                      USUARIO_REGISTRO
                                               FROM marca_vehiculo 
                                               WHERE ESTADO_REGISTRO = 1 $condicion
                                               ORDER BY NOMBRE_MARCA");

        $stmt -> execute();

        return $stmt -> fetchAll();    //Devolvemos todos los registros encontrados

        $stmt = null;

    }


    //Editar marca
    static public function mdlEditarMarca($datos){

        $stmt = Conexion::conectar()->prepare("UPDATE marca_vehiculo SET NOMBRE_MARCA = INITCAP(:NOMBRE_MARCA) 
                                                                     WHERE ID_MARCA = :ID_MARCA");

        $stmt -> bindParam(":NOMBRE_MARCA", $datos["nuevoNombreMarca"], PDO::PARAM_STR);        
        $stmt -> bindParam(":ID_MARCA", $datos["idMarca"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }

}