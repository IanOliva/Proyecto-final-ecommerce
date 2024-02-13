<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-12 text-center">
          <h1>Crear Usuario</h1>
        </div>
        <?php

        //insertar en bd los datos de usuario administrador
        
        if (isset($_REQUEST['guardar'])) {
          include_once "DBecommerce.php";
          $conexion = mysqli_connect($host, $user, $password, $db);
          $email = mysqli_real_escape_string($conexion, $_REQUEST['email'] ?? '');
          $pass = mysqli_real_escape_string($conexion, $_REQUEST['pass'] ?? '');
          $confpass = mysqli_real_escape_string($conexion, $_REQUEST['confpass'] ?? '');
          $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre'] ?? '');

          if ($pass == $confpass) {
            // Utilizar una consulta preparada
            $query = "INSERT INTO usuarios (email, pass, nombre) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conexion, $query);

            if ($stmt) {
              // Hash seguro de la contraseña
              $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

              // Vincular parámetros
              mysqli_stmt_bind_param($stmt, "sss", $email, $hashedPassword, $nombre);

              // Ejecutar la consulta preparada
              $res = mysqli_stmt_execute($stmt);

              if ($res) {
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario Creado correctamente" />';
              } else {
                ?>
                <div class="alert alert-danger" role="alert">
                  Error al crear usuario:
                  <?php echo mysqli_error($conexion); ?>
                </div>
                <?php
              }

              // Cerrar la consulta preparada
              mysqli_stmt_close($stmt);
            } else {
              ?>
              <div class="alert alert-danger" role="alert">
                Error en la preparación de la consulta:
                <?php echo mysqli_error($conexion); ?>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="col-6 m-auto alert alert-warning alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Las contraseñas no coinciden</strong>
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6 m-auto">
          <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
              <form action="panel.php?modulo=crearUsuario" method="post">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" required>
                  <small id="helpId" class="text-muted">Ejemplo: nombre@gmail.com</small>
                </div>
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="nombre" class="form-control" required>
                  <small id="helpId" class="text-muted">Nombre sin numeros</small>
                </div>
                <div class="form-group">
                  <label>Contraseña</label>
                  <input type="password" name="pass" class="form-control" required>
                  <small id="helpId" class="text-muted">Utiliza mayusculas y numeros para mayor seguridad</small>
                </div>
                <div class="form-group">
                  <label>Confirmar Contraseña</label>
                  <input type="password" name="confpass" class="form-control" required>
                  <small id="helpId" class="text-muted">Repite la contraseña</small>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                </div>
              </form>

            </div>



            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>