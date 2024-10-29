  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Marca y modelo de vehiculos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarModelo">Nuevo modelo</button>
        </div>
        <div class="card-body">
          <table class="table table-sm table-bordered table-striped table-hover dataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Usuario registro</th>
                <th>Modificar</th>
              </tr>
            </thead>
            <tbody>
            <?php

              $listaMarcaModeloVehiculos = ControladorModeloVehiculo::ctrModeloVehiculos("0");

              //var_dump($listaUltimosIngresos);

              foreach($listaMarcaModeloVehiculos as $key => $valor){

                echo '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$valor["NOMBRE_MARCA"].'</td>
                        <td>'.$valor["NOMBRE_MODELO"].'</td>
                        <td>'.$valor["USUARIO_REGISTRO"].'</td>
                        <td align="center">
                          <div class="btn-group">
                            <button class="btn btn-warning" onclick="editarModelo('.$valor["ID_MODELO"].');"><i class="fas fa-pen"></i></button>
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

<!-- Modal registrar modelo-->
<div class="modal fade" id="modalRegistrarModelo">
    <div class="modal-dialog">
      <div class="modal-content">

      <form rol="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Registrar modelo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="card-body">

            <!-- Marca Vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car"></i></span>
              </div>
              <select name="MarcaVehiculo" id="MarcaVehiculo" class="form-control" required>
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
            
            <!-- Marca vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car-side"></i></span>
              </div>
              <input type="text" name="nuevoModelo" id="nuevoModelo" class="form-control" placeholder="Ingrese modelo" required>
            </div>

          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>

        <?php
        
          $registrarModelo = new ControladorModeloVehiculo();
          $registrarModelo -> ctrRegistrarModelo();

        ?>

      </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <!-- Modal editar modelo-->
<div class="modal fade" id="modalEditarModelo">
    <div class="modal-dialog">
      <div class="modal-content">

      <form rol="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Editar modelo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="card-body">

            <!-- Marca Vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car"></i></span>
              </div>
              <select name="editarMarcaVehiculo" id="editarMarcaVehiculo" class="form-control" required>
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
            
            <!-- Marca vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car-side"></i></span>
              </div>
              <input type="text" name="editarModelo" id="editarModelo" class="form-control" placeholder="Ingrese modelo" required>
              <input type="hidden" name="hIdModelo" id="hIdModelo">
            </div>

          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>

        <?php
        
          $editarModelo = new ControladorModeloVehiculo();
          $editarModelo -> ctrEditarModelo();

        ?>

      </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>