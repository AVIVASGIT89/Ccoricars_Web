  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Servicios</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarServicio">Nuevo servicio</button>
        </div>
        <div class="card-body">
          <h3 class="card-title">Ultimos servicios</h3>
          <table class="table table-bordered table-striped table-hover dataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha ingreso</th>
                <th>Placa</th>
                <th>Marca - Modelo</th>
                <th>Servicio</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
            <?php

              $listaUltimosIngresos = ControladorServicio::ctrListarUltimosIngresos();

              //var_dump($listaUltimosIngresos);

              foreach($listaUltimosIngresos as $key => $valor){

                echo '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$valor["FECHA_INGRESO"].'</td>
                        <td>'.$valor["PLACA_VEHICULO"].'</td>
                        <td>'.$valor["MARCA_MODELO"].'</td>
                        <td>'.$valor["DETALLE_SERVICIO"].'</td>';
                        
                        if($valor["ESTADO_SERVICIO"] == "1"){

                          echo '<td><span class="badge badge-warning">Pendiente</span></td>';

                        }else{
                          echo '<td><span class="badge badge-success">Finalizado</span></td>';
                        }

                echo '</tr>';

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


  <!-------------------------------- Modales -------------------------------->
  <!-- Modal nuevo servicio -->
  <div class="modal fade" id="modalRegistrarServicio">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo servicio</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">

            <div class="d-flex align-items-center justify-content-center">
              <form class="form-inline" id="frmBuscarVehiculo">
                <div class="form-group mx-sm-2 mb-2">
                  <label for="placaVehiculo" class="sr-only">Placa</label>
                  <input type="text" class="form-control" id="placaVehiculo" placeholder="Placa vehiculo" required>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
              </form>
            </div>
          
            <br>

            <div>
              <table width="100%" border="0">
                <tr>
                  <td width="1%"><b>Placa:</b></td>
                  <td><span class="p-1" id="spPlaca">-</span></td>
                  <td width="1%"><b>Marca:</b></td>
                  <td><span class="p-1" id="spMarca">-</span></td>
                </tr>
                <tr>
                  <td><b>Modelo:</b></td>
                  <td><span class="p-1" id="spModelo">-</span></td>
                  <td><b>Año:</b></td>
                  <td><span class="p-1" id="spAnio">-</span></td>
                </tr>
                <tr>
                  <td><b>Responsable:</b></td>
                  <td colspan="3"><span class="p-1" id="spResponsable">-</span></td>
                </tr>
              </table>

              <br>

              <div class="form-group row">
                <label for="fechaIngreso" class="col-sm-2 col-form-label">Fecha:</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="fechaIngreso" id="fechaIngreso" value="<?php echo date("Y-m-d")?>" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="horaIngreso" class="col-sm-2 col-form-label">Hora:</label>
                <div class="col-sm-10">
                <input type="time" name="horaIngreso" id="horaIngreso" value="now" class="form-control">
                </div>
              </div>

              <div class="form-group row">
                <label for="kilometraje" class="col-sm-2 col-form-label">Kms:</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="kilometraje" id="kilometraje" value="0" onclick="this.select();" placeholder="Kilometraje" required>
                </div>
              </div>

              <div class="form-group">
                <label>Servicio:</label>
                <textarea class="form-control" name="detalleServicio" id="detalleServicio" rows="3" placeholder="Servicio a realizar" required></textarea>
                <input type="hidden" id="idVehiculo">
              </div>

            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btnRegistrarServicio" class="btn btn-success"><i class="fas fa-check-circle"></i> Registrar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->