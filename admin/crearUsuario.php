<?php
if (isset($_REQUEST['guardar'])) {
    include_once "DBecommerce.php";
$conexion=mysqli_connect($host,$user,$password,$db);
$email=mysqli_real_escape_string($conexion,$_REQUEST['email']??'');
$pass=md5(mysqli_real_escape_string($conexion,$_REQUEST['pass']??''));
$nombre=mysqli_real_escape_string($conexion,$_REQUEST['nombre']??'');

$query="INSERT INTO usuarios (email,pass,nombre) VALUES ('".$email."','".$pass."','".$nombre."')";
$res=mysqli_query($conexion,$query);
if ($res) {
    echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario Creado correctamente" />';
}else {
    ?>
    <div class="alert alert-danger" role="alert">
        Error al crear usuario <?php echo mysqli_error($conexion);?>
    </div>
<?php
}
    
}
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 text-center">
            <h1>Crear Usuarios</h1>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
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