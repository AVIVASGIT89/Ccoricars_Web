  <?php
  $reporteGeneral;

  $totalServicios = 0;
  $totalCostoServicios = 0;

  if(isset($_POST["fechaDesde"])){

    $fechaDesde = $_POST["fechaDesde"];
    $fechaHasta = $_POST["fechaHasta"];

  }else{

    $fechaDesde = date("Y-m-d");
    $fechaHasta = date("Y-m-d");

  }
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reporte general</h1>
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
                  Desde:<input type="date" name="fechaDesde" class="form-control" value="<?php echo $fechaDesde?>">
                </div>
              </div>

              <div class="col-xs-12 col-sm-2 mb-1">
                <div class="input-group align-items-center">
                  Hasta:<input type="date" name="fechaHasta" class="form-control" value="<?php echo $fechaHasta?>">
                </div>
              </div>

              <div class="col-xs-12 col-sm-1">
                <button type="submit" class="btn btn-block btn-primary">Buscar</button>
              </div>

            </div>
          </form>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover" id="example1">
            <thead>
              <tr>
                <th>#</th>
                <th>Fecha ingreso</th>
                <th>Placa</th>
                <th>Estado</th>
                <th>Marca - Modelo</th>
                <th>Servicio</th>
                <th>Costo $</th>
                <th>Fecha salida</th>
              </tr>
            </thead>
            <tbody>

            <?php

              $reporteGeneral = ControladorServicio::ctrReporteGeneral();

              //var_dump($reporteGeneral);

              if($reporteGeneral != null){

                $n = 0;

                foreach($reporteGeneral as $key => $valor){

                  $n++;

                  $costoServicio = $valor["COSTO_SERVICIO"];
                  $totalCostoServicios = $totalCostoServicios + $costoServicio;

                  echo '<tr>
                          <td>'.$n.'</td>
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
                          <td>'.$valor["FECHA_SALIDA"].'</td>
                        </tr>';
  
                }

                $totalServicios = $n;

              }
            
            ?>
            </tbody>
          </table>
          <?php
          if($reporteGeneral != null){
          ?>
          <div><b>Total servicios:</b> <?php echo $n?>, <b>Total costo:</b> $ <?php echo number_format($totalCostoServicios,2)?></div>
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
