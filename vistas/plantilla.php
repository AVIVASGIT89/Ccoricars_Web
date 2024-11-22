<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ccori Cars</title>

  <link rel="icon" href="vistas/dist/img/logo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  <!--*************** Plugins CSS ***************-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="vistas/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="vistas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">
  <!-- Estilos personalizados (modifica algunos plugins) -->
  <link rel="stylesheet" href="vistas/css/estilos-personalizados.css">


  <!--*************** Plugins JavaScript ***************-->
  <!-- jQuery -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="vistas/plugins/jszip/jszip.min.js"></script>
  <script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Select2 -->
  <script src="vistas/plugins/select2/js/select2.full.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="vistas/plugins/toastr/toastr.min.js"></script>
  <!-- ChartJS -->
  <script src="vistas/plugins/chartjs/chart.js"></script>
  <script src="vistas/plugins/chartjs/chart-data-label.js"></script>

</head>


<!--*********** Cuerpo Documento ***********-->
<body class="hold-transition sidebar-mini">

<?php
    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" && isset($_GET["ruta"])){

        echo '<div class="wrapper">';

        //Incluimos las secciones
        include "modulos/cabezote.php";
        include "modulos/menu.php";

        //Incluimos las contenidos de las paginas de modulos
        if(isset($_GET["ruta"])){

            if($_GET["ruta"] == "inicio" ||
                $_GET["ruta"] == "ingreso" ||
                $_GET["ruta"] == "usuarios" ||
                $_GET["ruta"] == "salida" ||
                $_GET["ruta"] == "reportegeneral" ||
                $_GET["ruta"] == "reportemarca" ||
                $_GET["ruta"] == "reporteplaca" ||
                $_GET["ruta"] == "marcavehiculo" ||
                $_GET["ruta"] == "modelovehiculo" ||
                $_GET["ruta"] == "vehiculos" ||
                $_GET["ruta"] == "salir"){

                include "modulos/".$_GET["ruta"].".php";

            }else{

                include "modulos/404.php";

            }

        }
        
        include "modulos/footer.php";

        echo '</div>';

    }else{

        include "modulos/login.php";
        
    }
?>

<script src="vistas/js/plantilla.js?v=<?php echo(rand()); ?>"></script>
<script src="vistas/js/usuario.js?v=<?php echo(rand()); ?>"></script>
<script src="vistas/js/servicio.js?v=<?php echo(rand()); ?>"></script>
<script src="vistas/js/vehiculo.js?v=<?php echo(rand()); ?>"></script>
<script src="vistas/js/marcamodelo.js?v=<?php echo(rand()); ?>"></script>
<script src="vistas/js/reportes.js?v=<?php echo(rand()); ?>"></script>

</body>
</html>
