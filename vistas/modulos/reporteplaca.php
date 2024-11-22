  <?php
  
  $reportePlaca;

  $placaVechiculo = "";

  if(isset($_POST["placaVehiculo"])){

    $placaVechiculo = $_POST["placaVehiculo"];

  }else{

    $placaVechiculo = "";

  }

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reporte por placa</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <form rol="form" method="POST">

            <div class="form-group row">

              <div class="col-xs-12 col-sm-2 mb-1">
                <div class="input-group align-items-center">
                  Placa: <input type="text" name="placaVehiculo" onkeypress="return numletras(event);" value="<?php echo $placaVechiculo;?>" class="form-control" required>
                </div>
              </div>

              <div class="col-xs-12 col-sm-1">
                <button type="submit" class="btn btn-block btn-primary">Buscar</button>
              </div>

            </div>
          </form>
        </div>
        <div class="card-body">
        <table class="table table-sm table-bordered table-striped table-hover" id="example1">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha ingreso</th>
              <th>Placa</th>
              <th>Estado</th>
              <th>Marca - Modelo</th>
              <th>Servicio</th>
              <th>Total S/.</th>
              <th>Fecha salida</th>
              <th>Detalle</th>
            </tr>
          </thead>
          <tbody>

          <?php

            $reportePlaca = ControladorServicio::ctrReportePlaca();

            //var_dump($reportePlaca);

            if($reportePlaca != null){

              $n = 0;

              foreach($reportePlaca as $key => $valor){

                $n++;

                echo '<tr>
                        <td>'.$n.'</td>
                        <td align="center">'.$valor["FECHA_INGRESO"].'</td>
                        <td align="center">'.$valor["PLACA_VEHICULO"].'</td>';
                        
                        if($valor["ESTADO_SERVICIO"] == "1"){

                          echo '<td align="center"><span class="badge badge-warning">Pendiente</span></td>';

                        }else{
                          echo '<td align="center"><span class="badge badge-success">Finalizado</span></td>';
                        }

                  echo '<td>'.$valor["MARCA_MODELO"].'</td>
                        <td>'.$valor["DETALLE_SERVICIO"].'</td>
                        <td align="right">'.number_format($valor["TOTAL_SERVICIO"], 2).'</td>
                        <td align="center">'.$valor["FECHA_SALIDA"].'</td>
                        <td align="center">
                        <div class="btn-group">
                          <button class="btn btn-info detalleServicio" idServicio="'.$valor["ID_SERVICIO"].'" title="Detalle servicio"><i class="fas fa-eye"></i></button>
                        </div>
                      </td>
                      </tr>';
  
                }

                $totalServicios = $n;

              }
            
            ?>
          </tbody>
        </table>
          <?php
          if($reportePlaca != null){
          ?>
          <div><b>Total servicios:</b> <?php echo $n?>
          <?php
          }
          ?>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Modal detalle servicio -->
  <div class="modal fade" id="modal-servicio-detalle">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detalle servicio</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <table class="table table-sm table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Repuesto / servicio</th>
                <th>Precio base</th>
                <th>Utilidad</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            
            <tbody id="tbodyDetalleServicio">
            <!-- 
              Aqui se carga la lista de productos a traves de Ajax
            -->
            </tbody>
          </table>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>