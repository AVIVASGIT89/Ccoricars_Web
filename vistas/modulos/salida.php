  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Finalizar servicio</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Seleccione servicio a finalizar</h3>
        </div>
        <div class="card-body">
          <table class="table table-sm table-bordered table-striped table-hover dataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha ingreso</th>
                <th>Placa</th>
                <th>Estado</th>
                <th>Marca - Modelo</th>
                <th>Servicio</th>
                <th>Costo</th>
                <th>Opcion</th>
              </tr>
            </thead>
            <tbody>
            <?php

              $listaServiciosPendientes = ControladorServicio::ctrListarServiciosPendientes("0");

              //var_dump($listaUltimosIngresos);

              foreach($listaServiciosPendientes as $key => $valor){

                $color = "";

                if($valor["ITEMS"] == "1"){

                  $color = "warning";

                }else{

                  $color = "primary";

                }

                echo '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$valor["FECHA_INGRESO"].'</td>
                        <td>'.$valor["PLACA_VEHICULO"].'</td>';
                        
                        if($valor["ESTADO_SERVICIO"] == "1"){

                          echo '<td><span class="badge badge-warning">Pendiente</span></td>';

                        }else{
                          echo '<td><span class="badge badge-success">Finalizado</span></td>';
                        }

                  echo '<td>'.$valor["MARCA_MODELO"].'</td>
                        <td>'.$valor["DETALLE_SERVICIO"].'</td>
                        <td>'.number_format($valor["TOTAL_SERVICIO"], 2).'</td>
                        <td align="center">
                          <div class="btn-group">
                            <button class="btn btn-success" onclick="finalizarServicio('.$valor["ID_SERVICIO"].');"><i class="fas fa-check"></i></button>
                            <button class="btn btn-'.$color.'" onclick="registroDetalleServicio('.$valor["ID_SERVICIO"].');"><i class="fas fa-wrench"></i></button>
                            <button class="btn btn-danger" onclick="anularServicio('.$valor["ID_SERVICIO"].');"><i class="fas fa-times"></i></button>
                          </div>
                        </td>
                      </tr>';

              }
            
            ?>

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal editar servicio-->
  <div class="modal fade" id="modalEditarServicio">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Añadir servicio</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="card-body">

            <div class="text-center">
              <h3><b><span id="spPlaca">-</span></b></h3>
            </div>

            <div class="row mb-1">
                <div class="col-md-6">

                  <b>Modelo:</b> &nbsp; <span id="datosVehiculo"></span>
                    
                </div>
                <div class="col-md-6">

                  <b>Color:</b> &nbsp; <span id="spColor"></span>

                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-6">

                  <b>Ingreso:</b> &nbsp; <span id="datosIngreso"></span>
                    
                </div>
                <div class="col-md-6">

                  <b>Kilometraje:</b> &nbsp; <span id="spKilometraje"></span>

                </div>
            </div>

            <div class="row mb-4">
                <div class="col">

                  <b>Servicio:</b> &nbsp; <span id="spServicio"></span>
                    
                </div>
            </div>

            <hr>

            <div class="row">
              <div class="col">
                  <div class="form-group">
                    <label for="servicioRepuesto">Repuesto / servicio:</label>
                    <input type="text" class="form-control" name="servicioRepuesto" id="servicioRepuesto" placeholder="Repuesto / Servicio" required>
                  </div>
              </div>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="nombre">Precio base:</label>
                        <input type="number" class="form-control" name="montoBase" id="montoBase" value="0" onclick="this.select();" placeholder="Monto base" required>
                    </div>
                    
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="direccion">Utilidad:</label>
                        <input type="number" class="form-control" name="utilidad" id="utilidad" value="0" onclick="this.select();" placeholder="Utilidad" required>
                    </div>

                </div>
            </div>

            <button type="button" class="btn btn-block btn-primary" id="btnAgregarServicioProducto">Agregar</button>

            <br>

            <div class="d-flex align-items-center justify-content-center">
              <table class="tabla-registro">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Repuesto / servicio</th>
                    <th>Base</th>
                    <th>Utilidad</th>
                    <th>Sub total</th>
                    <th>Opcion</th>
                  </tr>
                </thead>
                <tbody id="tbodyListaProductos">
                <!-- 
                  Aqui se carga la lista de productos a traves de Ajax
                -->
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4" align="right"><h3>Total Orden: S/.</h3></td>
                    <td><h3><span id="spTotalServicio">0.00</span></h3></td>
                    <td>
                      <input type="hidden" id="totalBase" value=""/>
                      <input type="hidden" id="totalUtilidad" value=""/>
                      <input type="hidden" id="idServicio" value=""/>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <br>

            <div class="text-center" id="dvDescargarItems" style="display: none;">
              <form target="_blank" action="vistas/modulos/descargarcotizacion.php" method="get">
                <input type="hidden" id="idServicioCotizacion" name="idServicioCotizacion" value=""/>
                <button class="btn btn-info"><i class="fas fa-file-download"></i> &nbsp; Descargar</button>
              </form>
            </div>
            
          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-success" id="btnRegistrarDetalleServicio">Registrar</button>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>