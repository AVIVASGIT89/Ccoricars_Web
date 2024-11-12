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
                                                        WHERE V.ESTADO_REGISTRO = 1
                                                        ORDER BY FECHA_REGISTRO DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();    //Devolvemos todos los registros encontrados

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT V.ID_VEHICULO,
                                                                V.PLACA_VEHICULO,
                                                                V.ID_MARCA,
                                                                V.ID_MODELO,
                                                                M.NOMBRE_MARCA,
                                                                D.NOMBRE_MODELO,
                                                                V.ANIO_FABRICACION,
                                                                V.NRO_MOTOR,
                                                                V.COLOR,
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
                                                                    NRO_MOTOR,
                                                                    COLOR,
                                                                    RESPONSABLE,
                                                                    FECHA_REGISTRO,
                                                                    USUARIO_REGISTRO)
                                                            VALUES(UPPER(:PLACA_VEHICULO),
                                                                    :ID_MARCA,
                                                                    :ID_MODELO,
                                                                    :ANIO_FABRICACION,
                                                                    UPPER(:NRO_MOTOR),
                                                                    INITCAP(:COLOR),
                                                                    INITCAP(:RESPONSABLE),
                                                                    NOW(),
                                                                    :USUARIO_REGISTRO)");

        $stmt -> bindParam(":PLACA_VEHICULO", $datosVehiculo["placaVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ID_MARCA", $datosVehiculo["marcaVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ID_MODELO", $datosVehiculo["modeloVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ANIO_FABRICACION", $datosVehiculo["anioFabricacion"], PDO::PARAM_STR);
        $stmt -> bindParam(":NRO_MOTOR", $datosVehiculo["nroMotor"], PDO::PARAM_STR);
        $stmt -> bindParam(":COLOR", $datosVehiculo["color"], PDO::PARAM_STR);
        $stmt -> bindParam(":RESPONSABLE", $datosVehiculo["responsable"], PDO::PARAM_STR);
        $stmt -> bindParam(":USUARIO_REGISTRO", $_SESSION["sUsuario"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }


    //Registrar vehiculo
    static public function mdlEditarVehiculo($datosVehiculo){

        $stmt = Conexion::conectar()->prepare("UPDATE vehiculo
                                                SET ID_MARCA = :ID_MARCA,
                                                    ID_MODELO = :ID_MODELO,
                                                    ANIO_FABRICACION = :ANIO_FABRICACION,
                                                    NRO_MOTOR = UPPER(:NRO_MOTOR),
                                                    COLOR = INITCAP(:COLOR),
                                                    RESPONSABLE = INITCAP(:RESPONSABLE)
                                                WHERE ID_VEHICULO = :ID_VEHICULO");

        $stmt -> bindParam(":ID_MARCA", $datosVehiculo["marcaVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ID_MODELO", $datosVehiculo["modeloVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":ANIO_FABRICACION", $datosVehiculo["anioFabricacion"], PDO::PARAM_STR);
        $stmt -> bindParam(":NRO_MOTOR", $datosVehiculo["nroMotor"], PDO::PARAM_STR);
        $stmt -> bindParam(":COLOR", $datosVehiculo["color"], PDO::PARAM_STR);
        $stmt -> bindParam(":RESPONSABLE", $datosVehiculo["responsable"], PDO::PARAM_STR);
        $stmt -> bindParam(":ID_VEHICULO", $datosVehiculo["idVehiculoEditar"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }


}

