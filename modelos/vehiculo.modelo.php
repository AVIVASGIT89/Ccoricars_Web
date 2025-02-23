<?php

require_once "conexion.php";

class ModeloVehiculo{

    //Lista vehiculos
    static public function mdlListarVehiculos($item, $valor){

        if($item == null){

            $stmt = Conexion::conectar()->prepare("SELECT V.ID_VEHICULO,
                                                                V.PLACA_VEHICULO,
                                                                M.NOMBRE_MARCA,
                                                                D.NOMBRE_MODELO,
                                                                V.ANIO_FABRICACION,
                                                                V.RESPONSABLE,
                                                                V.FECHA_REGISTRO,
                                                                V.USUARIO_REGISTRO
                                                        FROM vehiculo V
                                                        INNER JOIN marca_vehiculo M ON V.ID_MARCA = M.ID_MARCA
                                                        INNER JOIN modelo_vehiculo D ON V.ID_MODELO = D.ID_MODELO
                                                        WHERE V.ESTADO_REGISTRO = 1");

            $stmt -> execute();

            return $stmt -> fetchAll();    //Devolvemos todos los registros encontrados

        }else{

            //$stmt = Conexion::conectar()->prepare("SELECT * FROM producto WHERE $item = :$item");

            $stmt = Conexion::conectar()->prepare("SELECT V.ID_VEHICULO,
                                                                V.PLACA_VEHICULO,
                                                                M.NOMBRE_MARCA,
                                                                D.NOMBRE_MODELO,
                                                                V.ANIO_FABRICACION,
                                                                V.RESPONSABLE,
                                                                V.FECHA_REGISTRO,
                                                                V.USUARIO_REGISTRO
                                                        FROM vehiculo V
                                                        INNER JOIN marca_vehiculo M ON V.ID_MARCA = M.ID_MARCA
                                                        INNER JOIN modelo_vehiculo D ON V.ID_MODELO = D.ID_MODELO
                                                        WHERE V.ESTADO_REGISTRO = 1
                                                        AND $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();    //Devolvemos el registro encontrado

        }

        $stmt = null;

    }


    //Registrar vehiculo
    static public function mdlRegistrarVehiculo($datosVehiculo){

        $stmt = Conexion::conectar()->prepare("INSERT INTO vehiculo (PLACA_VEHICULO,
                                                                    ID_MARCA,
                                                                    ID_MODELO,
                                                                    ANIO_FABRICACION,
                                                                    RESPONSABLE,
                                                                    FECHA_REGISTRO,
                                                                    USUARIO_REGISTRO)
                                                            VALUES(UPPER(:PLACA_VEHICULO),
                                                                    :ID_MARCA,
                                                                    :ID_MODELO,
                                                                    :ANIO_FABRICACION,
                                                                    INITCAP(:RESPONSABLE),
                                                                    NOW(),
                                                                    :USUARIO_REGISTRO)");

        $stmt -> bindParam(":PLACA_VEHICULO", $datosVehiculo["placaVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ID_MARCA", $datosVehiculo["marcaVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ID_MODELO", $datosVehiculo["modeloVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ANIO_FABRICACION", $datosVehiculo["anioFabricacion"], PDO::PARAM_STR);
        $stmt -> bindParam(":RESPONSABLE", $datosVehiculo["responsable"], PDO::PARAM_STR);
        $stmt -> bindParam(":USUARIO_REGISTRO", $_SESSION["sUsuario"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }


}

