<div id="back">

</div>

<div class="login-page">
  <div class="login-box">
    <div class="login-logo">
        <a href="#"><img src="vistas/dist/img/logo.png" width="120" alt=""></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg">Ingrese sus credenciales</p>

        <form method="post">
            <div class="input-group mb-3">
            <input type="text" class="form-control" name="login" placeholder="Usuario" required>
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Clave" required>
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </div>
            <!-- /.col -->
            </div>

            <?php
                $login = new ControladorUsuario();
                $login -> ctrValidarUsuario();
            ?>

        </form>

        </div>
        <!-- /.login-card-body -->
    </div>
  </div>
</div>