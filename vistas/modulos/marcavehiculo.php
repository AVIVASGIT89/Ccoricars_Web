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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarMarca">Nueva marca</button>
        </div>
        <div class="card-body">
          <table class="table table-sm table-bordered table-striped table-hover dataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Marca</th>
                <th>Usuario registro</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
            <?php

              $listaMarcaloVehiculos = ControladoMarcaVehiculo::ctrMarcasVehiculos("0");

              //var_dump($listaUltimosIngresos);

              foreach($listaMarcaloVehiculos as $key => $valor){

                echo '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$valor["NOMBRE_MARCA"].'</td>
                        <td>'.$valor["USUARIO_REGISTRO"].'</td>
                        <td align="center">
                          <div class="btn-group">
                              <button class="btn btn-warning" onclick="editarMarca('.$valor["ID_MARCA"].');"><i class="fas fa-pen"></i></button>
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


  <!-- Modal registrar marca-->
  <div class="modal fade" id="modalRegistrarMarca">
    <div class="modal-dialog">
      <div class="modal-content">

      <form rol="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Registrar marca</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="card-body">
            
            <!-- Marca vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car"></i></span>
              </div>
              <input type="text" name="nuevaMarca" id="nuevaMarca" class="form-control" placeholder="Ingrese marca" required>
            </div>

          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>

        <?php
        
          $registrarMarca = new ControladoMarcaVehiculo();
          $registrarMarca -> ctrRegistrarMarca();

        ?>

      </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <!-- Modal editar marca-->
  <div class="modal fade" id="modalEditarMarca">
    <div class="modal-dialog">
      <div class="modal-content">

      <form rol="form" method="POST">

        <div class="modal-header">
          <h4 class="modal-title">Editar marca</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="card-body">
            
            <!-- Marca vehiculo -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-car"></i></span>
              </div>
              <input type="text" name="editarMarca" id="editarMarca" class="form-control" placeholder="Ingrese marca" required>
              <input type="hidden" name="hIdMarca" id="hIdMarca">
            </div>

          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>

        <?php
        
          $editarMarca = new ControladoMarcaVehiculo();
          $editarMarca -> ctrEditarMarca();

        ?>

      </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>