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
          <table class="table table-bordered table-striped table-hover dataTable">
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
                        <td>'.$valor["DESC_SERVICIO"].'</td>
                        <td>'.number_format($valor["COSTO_SERVICIO"], 2).'</td>
                        <td align="center">
                          <div class="btn-group">
                            <button class="btn btn-success" onclick="finalizarServicio('.$valor["ID_SERVICIO"].');"><i class="fas fa-check"></i></button>
                            <button class="btn btn-warning" onclick="editarServicio('.$valor["ID_SERVICIO"].');"><i class="fas fa-pen"></i></button>
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
    <div class="modal-dialog">
      <div class="modal-content">

      <form rol="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Editar servicio</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="card-body">
            
            <!-- Vehiculo -->
            <div class="input-group mb-3">
              Vehiculo: &nbsp; <span id="datosVehiculo"></span>
            </div>

            <!-- Ingreso -->
            <div class="input-group mb-3">
              Ingreso: &nbsp; <span id="datosIngreso"></span>
            </div>

            <!-- Servicio -->
            <div class="input-group mb-3">
              Servicio: &nbsp; <span id="datosServicio"></span>
            </div>

            <!-- Costo servicio -->
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
              </div>
              <input type="number" name="nuevoCostoServicio" id="nuevoCostoServicio" onclick="this.select();" class="form-control" placeholder="Costo servicio" required>
              <input type="hidden" name="hIdServicio" id="hIdServicio">
            </div>
            
          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>

        <?php
        
          $editarServicio = new ControladorServicio();
          $editarServicio -> ctrEditarServicio();

        ?>

      </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>