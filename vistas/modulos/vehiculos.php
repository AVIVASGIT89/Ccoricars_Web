  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vehiculos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoVehiculo">Nuevo vehiculo</button>
        </div>
        <div class="card-body">
          <table class="table table-sm table-bordered table-striped table-hover dataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Responsable</th>
                <th>Fecha registro</th>
                <th>Usuario reg.</th>
                <th>Opcion</th>
              </tr>
            </thead>
            <tbody>
            <?php

              $listaVehiculos = ControladorVehiculo::ctrListarVehiculos(null, null);

              //var_dump($listaUltimosIngresos);

              foreach($listaVehiculos as $key => $valor){

                echo '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$valor["PLACA_VEHICULO"].'</td>
                        <td>'.$valor["NOMBRE_MARCA"].'</td>
                        <td>'.$valor["NOMBRE_MODELO"].'</td>
                        <td>'.$valor["ANIO_FABRICACION"].'</td>
                        <td>'.$valor["RESPONSABLE"].'</td>
                        <td>'.$valor["FECHA_REGISTRO"].'</td>
                        <td>'.$valor["USUARIO_REGISTRO"].'</td>
                        <td align="center">
                          <div class="btn-group">
                            <button class="btn btn-warning editarVehiculo" idVehiculo="'.$valor["ID_VEHICULO"].'" title="Editar"><i class="fas fa-pen"></i></button>
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


  <!-- Modal registrar vehiculo-->
  <div class="modal fade" id="modalNuevoVehiculo">
    <div class="modal-dialog">
      <div class="modal-content">

      <form rol="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Registrar vehiculo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="card-body">
            
            <!-- Placa vehiculo -->
            <span style="color: red;" id="spExistePlaca"></span>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
              </div>
              <input type="text" name="nuevoPlacaVehiculo" id="nuevoPlacaVehiculo" onkeypress="return numletras(event);" class="form-control" placeholder="Ingrese placa" required>
            </div>

            <!-- Marca Vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car"></i></span>
              </div>
              <select name="idMarcaVehiculo" id="idMarcaVehiculo" class="form-control" required>
                <option value="">- Marca Vehiculo -</option>

                <?php
                  $marcasVehiculo = $_SESSION["sMarcasVehiculo"];

                  for($i = 0; $i < count($marcasVehiculo["ID"]); $i++){
                ?>

                  <option value="<?php echo $marcasVehiculo["ID"][$i];?>"><?php echo $marcasVehiculo["MARCA"][$i];?></option>

                <?php
                  }
                ?>
                
              </select>
            </div>

            <!-- Modelo Vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car-side"></i></span>
              </div>
              <select name="idModeloVehiculo" id="idModeloVehiculo" class="form-control" required>
                <option value="">- Modelo Vehiculo -</option>
              </select>
            </div>

            <!-- Año fabricacion -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-hammer"></i></span>
              </div>
              <input type="number" name="anioFabricacion" class="form-control" placeholder="Año fabricacion" required>
            </div>

            <!-- Nro motor -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-sim-card"></i></span>
              </div>
              <input type="text" name="nroMotor" class="form-control" placeholder="Nro de motor">
            </div>

            <!-- Color -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-palette"></i></span>
              </div>
              <input type="text" name="color" class="form-control" placeholder="Color" required>
            </div>

            <!-- Responsable -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="responsable" class="form-control" placeholder="Nombre responsable" required>
            </div>
            
          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success" id="btnRegistrarVehiculo">Registrar</button>
        </div>

        <?php
        
          $registrarVehiculo = new ControladorVehiculo();
          $registrarVehiculo -> ctrRegistrarVehiculo();

        ?>

      </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <!-- Modal para editar vehiculo-->
  <div class="modal fade" id="modalEditarVehiculo">
    <div class="modal-dialog">
      <div class="modal-content">

      <form rol="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Editar vehiculo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="card-body">
            
            <!-- Placa vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
              </div>
              <input type="text" name="editarPlacaVehiculo" id="editarPlacaVehiculo" class="form-control" placeholder="Ingrese placa" disabled>
            </div>

            <!-- Marca Vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car"></i></span>
              </div>
              <select name="idMarcaVehiculoEditar" id="idMarcaVehiculoEditar" class="form-control" required>
                <option value="">- Marca Vehiculo -</option>

                <?php
                  $marcasVehiculo = $_SESSION["sMarcasVehiculo"];

                  for($i = 0; $i < count($marcasVehiculo["ID"]); $i++){
                ?>

                  <option value="<?php echo $marcasVehiculo["ID"][$i];?>"><?php echo $marcasVehiculo["MARCA"][$i];?></option>

                <?php
                  }
                ?>
                
              </select>
            </div>

            <!-- Modelo Vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car-side"></i></span>
              </div>
              <select name="idModeloVehiculoEditar" id="idModeloVehiculoEditar" class="form-control" required>
                <option value="">- Modelo Vehiculo -</option>
              </select>
            </div>

            <!-- Año fabricacion -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-hammer"></i></span>
              </div>
              <input type="number" id="anioFabricacionEditar" name="anioFabricacionEditar" class="form-control" placeholder="Año fabricacion" required>
            </div>

            <!-- Nro motor -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-sim-card"></i></span>
              </div>
              <input type="text" id="nroMotorEditar" name="nroMotorEditar" class="form-control" placeholder="Nro de motor">
            </div>

            <!-- Color -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-palette"></i></span>
              </div>
              <input type="text" id="colorEditar" name="colorEditar" class="form-control" placeholder="Color" required>
            </div>

            <!-- Responsable -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" id="responsableEditar" name="responsableEditar" class="form-control" placeholder="Nombre responsable" required>
            </div>

            <input type="hidden" id="idVehiculoEditar" name="idVehiculoEditar">
            
          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success" id="btnRegistrarVehiculoEditar">Actualizar</button>
        </div>

        <?php
        
          $registrarVehiculo = new ControladorVehiculo();
          $registrarVehiculo -> ctrEditarVehiculo();

        ?>

      </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>