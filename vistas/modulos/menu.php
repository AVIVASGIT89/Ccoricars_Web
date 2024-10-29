  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="vistas/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Ccori Cars</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="vistas/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["sNombreUsuario"] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
            <a href="inicio" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
         </li>
         <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Servicio
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="ingreso" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nuevo servicio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="salida" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Finalizar servicio</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-car-side"></i>
              <p>
                Vehiculo
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vehiculos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista vehiculos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="marcavehiculo" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marca vehiculo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="modelovehiculo" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modelo vehiculo</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reportegeneral" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reportemarca" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Por marca y modelo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reporteplaca" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Por placa</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>