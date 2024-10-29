  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><span id="totalServicios"></span></h3>

                <p>Nuevos servicios</p>
              </div>
              <div class="icon">
                <i class="fas fa-tools"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><span id="totalFinalizados"></sup></h3>

                <p>Servicios finalizados</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><span id="totalPendientes"></h3>

                <p>Servicios pendientes</p>
              </div>
              <div class="icon">
                <i class="fas fa-exclamation-circle"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><span id="totalAnulados"></h3>

                <p>Servicios cancelados</p>
              </div>
              <div class="icon">
                <i class="fas fa-times"></i>
              </div>
              <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <section class="col-lg-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-line mr-1"></i>
                  6 ultimos meses
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <canvas id="lineaServiciosMes" width="1500" height="450" ></canvas>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
        </div>
        <!-- /.row -->

      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="vistas/js/inicio.js"></script>
  <script>
    $(document).ready(mostrarIndicadores);
  </script>

