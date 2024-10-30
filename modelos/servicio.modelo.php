<?php

require_once "conexion.php";

class ModeloServicio{

    //Listar ultimos ingresos de servicio
    static public function mdlListarUltimosIngresos(){

        $stmt = Conexion::conectar()->prepare("SELECT S.ID_SERVICIO,
                                                            S.FECHA_INGRESO,
                                                            V.PLACA_VEHICULO,
                                                            CONCAT(M.NOMBRE_MARCA,' ', D.NOMBRE_MODELO) MARCA_MODELO,
                                                            S.DETALLE_SERVICIO,
                                                            S.TOTAL_SERVICIO,
                                                            S.ESTADO_SERVICIO
                                                    FROM servicio S
                                                    INNER JOIN vehiculo V ON S.ID_VEHICULO = V.ID_VEHICULO
                                                    INNER JOIN marca_vehiculo M ON V.ID_MARCA = M.ID_MARCA
                                                    INNER JOIN modelo_vehiculo D ON V.ID_MODELO = D.ID_MODELO
                                                    WHERE S.ESTADO_REGISTRO = 1
                                                    ORDER BY S.FECHA_INGRESO DESC
                                                    LIMIT 20");

        $stmt -> execute();

        return $stmt -> fetchAll(); //Devolvemos Todos los registros encontrados

        $stmt = null;

    }


    //Listar servicios pendientes de salida
    static public function mdlListarServiciosPendientes($idServicio){

        if($idServicio != "0"){

            $condicion = " AND S.ID_SERVICIO = $idServicio ";

        }else{

            $condicion = "";

        }

        $stmt = Conexion::conectar()->prepare("SELECT S.ID_SERVICIO,
                                                            S.FECHA_INGRESO,
                                                            V.PLACA_VEHICULO,
                                                            CONCAT(M.NOMBRE_MARCA,' ', D.NOMBRE_MODELO) MARCA_MODELO,
                                                            S.DETALLE_SERVICIO,
                                                            S.TOTAL_SERVICIO,
                                                            S.ESTADO_SERVICIO
                                                    FROM servicio S
                                                    INNER JOIN vehiculo V ON S.ID_VEHICULO = V.ID_VEHICULO
                                                    INNER JOIN marca_vehiculo M ON V.ID_MARCA = M.ID_MARCA
                                                    INNER JOIN modelo_vehiculo D ON V.ID_MODELO = D.ID_MODELO
                                                    WHERE S.ESTADO_SERVICIO = 1
                                                    AND S.ESTADO_REGISTRO = 1 $condicion
                                                    ORDER BY S.FECHA_INGRESO DESC");

        $stmt -> execute();

        return $stmt -> fetchAll(); //Devolvemos Todos los registros encontrados

        $stmt = null;

    }


    //Registrar nuevo ingreso
    static public function mdlRegistrarIngreso($datos){

        session_start();

        $stmt = Conexion::conectar()->prepare("INSERT INTO servicio (ID_VEHICULO,
                                                                     FECHA_INGRESO,
                                                                     KM_INGRESO,
                                                                     DETALLE_SERVICIO,
                                                                     USUARIO_INGRESO)
                                                             VALUES(:ID_VEHICULO,
                                                                    :FECHA_INGRESO,
                                                                    :KM_INGRESO,
                                                                    :DETALLE_SERVICIO, 
                                                                    :USUARIO_INGRESO)");

        $stmt -> bindParam(":ID_VEHICULO", $datos["idVehiculo"], PDO::PARAM_STR);
        $stmt -> bindParam(":FECHA_INGRESO", $datos["fechaHoraIngreso"], PDO::PARAM_STR);
        $stmt -> bindParam(":KM_INGRESO", $datos["kilometraje"], PDO::PARAM_STR);
        $stmt -> bindParam(":DETALLE_SERVICIO", $datos["servicio"], PDO::PARAM_STR);
        $stmt -> bindParam(":USUARIO_INGRESO", $_SESSION["sUsuario"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }


    //Editar servicio
    static public function mdlEditarServicio($datos){

        $stmt = Conexion::conectar()->prepare("UPDATE servicio SET COSTO_SERVICIO = :COSTO_SERVICIO 
                                                               WHERE ID_SERVICIO = :ID_SERVICIO");

        $stmt -> bindParam(":ID_SERVICIO", $datos["idServicio"], PDO::PARAM_STR);
        $stmt -> bindParam(":COSTO_SERVICIO", $datos["nuevoCostoServicio"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }


    //Registrar finalizacion de servicio
    static public function mdlFinalizarServicio($idServicio, $fechaHora){

        session_start();

        $usuario = $_SESSION["sUsuario"];

        $stmt = Conexion::conectar()->prepare("UPDATE servicio SET ESTADO_SERVICIO = 2,
                                                                   FECHA_SALIDA = '$fechaHora',
                                                                   USUARIO_SALIDA = '$usuario'
                                                             WHERE ID_SERVICIO = :ID_SERVICIO");

        $stmt -> bindParam(":ID_SERVICIO", $idServicio, PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }


    //Registrar anulacion de servicio
    static public function mdlAnularServicio($idServicio){

        $stmt = Conexion::conectar()->prepare("UPDATE servicio SET ESTADO_REGISTRO = 0 WHERE ID_SERVICIO = :ID_SERVICIO");

        $stmt -> bindParam(":ID_SERVICIO", $idServicio, PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt = null;

    }

    //Listar indicadores ultimo mes
    static public function mdlListarIndicadoresServicios(){

        $fechaDesde = date("Y-m-01");
        $fechaHasta = date("Y-m-t");

        $stmt = Conexion::conectar()->prepare("SELECT  (SELECT COUNT(S.ID_SERVICIO)
                                                        FROM servicio S
                                                        WHERE S.FECHA_INGRESO BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59'
                                                        AND S.ESTADO_REGISTRO = 1) CANTIDAD_SERVICIO,
                                                        
                                                        (SELECT COUNT(S.ID_SERVICIO)
                                                        FROM servicio S
                                                        WHERE S.FECHA_INGRESO BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59'
                                                        AND S.ESTADO_SERVICIO = 2
                                                        AND S.ESTADO_REGISTRO = 1) SERVICIOS_FINALIZADO,
                                                        
                                                        (SELECT COUNT(S.ID_SERVICIO)
                                                        FROM servicio S
                                                        WHERE S.FECHA_INGRESO BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59'
                                                        AND S.ESTADO_SERVICIO = 1
                                                        AND S.ESTADO_REGISTRO = 1) SERVICIOS_PENDIENTE,
                                                        
                                                        (SELECT COUNT(S.ID_SERVICIO)
                                                        FROM servicio S
                                                        WHERE S.FECHA_INGRESO BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59'
                                                        AND S.ESTADO_REGISTRO = 0) SERVICIOS_ANULADOS");

        $stmt -> execute();

        return $stmt -> fetchAll(); //Devolvemos Todos los registros encontrados

        $stmt = null;

    }


    //Listar servicios 6 ultimos meses
    static public function mdlListarServicios6UltimosMeses(){

        $stmt = Conexion::conectar()->prepare("SELECT YEAR(S.FECHA_INGRESO) ANIO, 
                                                      MONTH(S.FECHA_INGRESO) MES, 
                                                      CASE MONTH(S.FECHA_INGRESO) WHEN 1 THEN 'Enero'
                                                                                WHEN 2 THEN 'Febrero' 
                                                                                WHEN 3 THEN 'Marzo' 
                                                                                WHEN 4 THEN 'Abril' 
                                                                                WHEN 5 THEN 'Mayo' 
                                                                                WHEN 6 THEN 'Junio' 
                                                                                WHEN 7 THEN 'Julio' 
                                                                                WHEN 8 THEN 'Agosto'
                                                                                WHEN 9 THEN 'Setiembre'
                                                                                WHEN 10 THEN 'Octubre'
                                                                                WHEN 11 THEN 'Noviembre'  
                                                                                WHEN 12 THEN 'Diciembre' END NOMBRE_MES, 
                                                      COUNT(ID_SERVICIO) SERVICIOS_MES
                                                FROM servicio S
                                                WHERE S.ESTADO_REGISTRO = 1
                                                GROUP BY MES
                                                ORDER BY S.FECHA_INGRESO
                                                LIMIT 6");

        $stmt -> execute();

        return $stmt -> fetchAll(); //Devolvemos Todos los registros encontrados

        $stmt = null;

    }


    //Reporte general de servicio
    static public function mdlReporteGeneral($fechaDesde, $fechaHasta){

        $stmt = Conexion::conectar()->prepare("SELECT S.ID_SERVICIO,
                                                        S.FECHA_INGRESO,
                                                        S.PLACA_VEHICULO,
                                                        CONCAT(M.NOMBRE_MARCA,' ', D.NOMBRE_MODELO) MARCA_MODELO,
                                                        S.DESC_SERVICIO,
                                                        S.COSTO_SERVICIO,
                                                        S.ESTADO_SERVICIO,
                                                        S.USUARIO_INGRESO,
                                                        S.FECHA_SALIDA,
                                                        S.USUARIO_SALIDA
                                                FROM servicio S
                                                INNER JOIN marca_vehiculo M ON M.ID_MARCA = S.ID_MARCA_VEHICULO
                                                INNER JOIN modelo_vehiculo D ON D.ID_MODELO = S.ID_MODELO_VEHICULO
                                                WHERE S.FECHA_INGRESO BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59'
                                                AND S.ESTADO_REGISTRO = 1
                                                ORDER BY S.FECHA_INGRESO DESC");

        $stmt -> execute();

        return $stmt -> fetchAll(); //Devolvemos Todos los registros encontrados

        $stmt = null;

    }


    //Reporte por marca y modelo
    static public function mdlReporteMarcaModelo($fechaDesde, $fechaHasta, $idMarca, $idModelo){

        if($idModelo != ""){

            $condicion = " AND D.ID_MODELO = $idModelo ";

        }else{

            $condicion = " ";

        }

        $stmt = Conexion::conectar()->prepare("SELECT S.ID_SERVICIO,
                                                        S.FECHA_INGRESO,
                                                        S.PLACA_VEHICULO,
                                                        CONCAT(M.NOMBRE_MARCA,' ', D.NOMBRE_MODELO) MARCA_MODELO,
                                                        S.DESC_SERVICIO,
                                                        S.COSTO_SERVICIO,
                                                        S.ESTADO_SERVICIO,
                                                        S.USUARIO_INGRESO,
                                                        S.FECHA_SALIDA,
                                                        S.USUARIO_SALIDA
                                                FROM servicio S
                                                INNER JOIN marca_vehiculo M ON M.ID_MARCA = S.ID_MARCA_VEHICULO
                                                INNER JOIN modelo_vehiculo D ON D.ID_MODELO = S.ID_MODELO_VEHICULO
                                                WHERE S.FECHA_INGRESO BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59'
                                                AND M.ID_MARCA = $idMarca $condicion
                                                AND S.ESTADO_REGISTRO = 1
                                                ORDER BY S.FECHA_INGRESO DESC");

        $stmt -> execute();

        return $stmt -> fetchAll(); //Devolvemos Todos los registros encontrados

        $stmt = null;

    }


    //Reporte por placa
    static public function mdlReportePlaca($fechaDesde, $fechaHasta, $placa){

        $stmt = Conexion::conectar()->prepare("SELECT S.ID_SERVICIO,
                                                        S.FECHA_INGRESO,
                                                        S.PLACA_VEHICULO,
                                                        CONCAT(M.NOMBRE_MARCA,' ', D.NOMBRE_MODELO) MARCA_MODELO,
                                                        S.DESC_SERVICIO,
                                                        S.COSTO_SERVICIO,
                                                        S.ESTADO_SERVICIO,
                                                        S.USUARIO_INGRESO,
                                                        S.FECHA_SALIDA,
                                                        S.USUARIO_SALIDA
                                                FROM servicio S
                                                INNER JOIN marca_vehiculo M ON M.ID_MARCA = S.ID_MARCA_VEHICULO
                                                INNER JOIN modelo_vehiculo D ON D.ID_MODELO = S.ID_MODELO_VEHICULO
                                                WHERE S.FECHA_INGRESO BETWEEN '$fechaDesde 00:00:00' AND '$fechaHasta 23:59:59'
                                                AND S.PLACA_VEHICULO = '$placa'
                                                AND S.ESTADO_REGISTRO = 1
                                                ORDER BY S.FECHA_INGRESO DESC");

        $stmt -> execute();

        return $stmt -> fetchAll(); //Devolvemos Todos los registros encontrados

        $stmt = null;

    }

}