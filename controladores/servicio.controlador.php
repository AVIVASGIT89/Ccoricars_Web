<?php

class ControladorServicio{

    //Listar ultimos ingresos de servicios
    static public function ctrListarUltimosIngresos(){

        $respuesta = ModeloServicio::mdlListarUltimosIngresos();

        return $respuesta;

    }


    //Listar servicios pendiente salida
    static public function ctrListarServiciosPendientes($idServicio){

        $respuesta = ModeloServicio::mdlListarServiciosPendientes($idServicio);

        return $respuesta;

    }


    //Editar servicio
    static public function ctrEditarServicio(){

        if(isset($_POST["hIdServicio"])){

            $datos = array(
                "idServicio" => $_POST["hIdServicio"],
                "nuevoCostoServicio" => $_POST["nuevoCostoServicio"]
               );

            $respuesta = ModeloServicio::mdlEditarServicio($datos);

            if($respuesta == "ok"){

                echo '<script>

                            Swal.fire({
                                title: "Actualizacion realizada correctamente",
                                icon: "success",
                                confirmButtonText: "Ok"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "salida";
                                }
                            })

                    </script>';

            }else{

                echo '<script>
                        toastr.error("Error, no se pudo realizar la actualizacion");
                    </script>';

            }

        }

    }


    //Reporte General
    static public function ctrReporteGeneral(){

        if(isset($_POST["fechaDesde"])){

            $fechaDesde = $_POST["fechaDesde"];
            $fechaHasta= $_POST["fechaHasta"];

            $respuesta = ModeloServicio::mdlReporteGeneral($fechaDesde, $fechaHasta);

            return $respuesta;

        }

    }


    //Reporte por marca y modelo
    static public function ctrReporteMarcaModelo(){

        if(isset($_POST["idMarcaVehiculo"])){

            $fechaDesde = $_POST["fechaDesde"];
            $fechaHasta= $_POST["fechaHasta"];
            $idMarca= $_POST["idMarcaVehiculo"];
            $idModelo= $_POST["idModeloVehiculo"];

            $respuesta = ModeloServicio::mdlReporteMarcaModelo($fechaDesde, $fechaHasta, $idMarca, $idModelo);

            return $respuesta;

        }

    }


    //Reporte por placa
    static public function ctrReportePlaca(){

        if(isset($_POST["placaVehiculo"])){

            $fechaDesde = $_POST["fechaDesde"];
            $fechaHasta= $_POST["fechaHasta"];
            $placa= $_POST["placaVehiculo"];

            $respuesta = ModeloServicio::mdlReportePlaca($fechaDesde, $fechaHasta, $placa);

            return $respuesta;

        }

    }

}