<?php
    include_once "DBecommerce.php";
    $conexion=mysqli_connect($host,$user,$password,$db);
if (isset($_REQUEST['guardar'])) {


$email=mysqli_real_escape_string($conexion,$_REQUEST['email']??'');
$pass=md5(mysqli_real_escape_string($conexion,$_REQUEST['pass']??''));
$nombre=mysqli_real_escape_string($conexion,$_REQUEST['nombre']??'');
$id=mysqli_real_escape_string($conexion,$_REQUEST['id']??'');


$query="UPDATE usuarios SET email='".$email."', pass='".$pass."',nombre='".$nombre."' WHERE id='".$id."'; ";
$res=mysqli_query($conexion,$query);
if ($res) {
    echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios&mensaje=Usuario modificado correctamente" />';
}else {
    ?>
    <div class="alert alert-danger" role="alert">
        Error al crear usuario <?php echo mysqli_error($conexion);?>
    </div>
<?php
}
    
}

$id= mysqli_real_escape_string($conexion,$_REQUEST['id']??'');
$query="SELECT id,email,pass,nombre FROM usuarios WHERE id='".$id."';";
$res=mysqli_query($conexion,$query);
$row=mysqli_fetch_assoc($res);

?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 ">
          <div class="col-12 text-center ">
            <h1>Editar Usuario</h1>
          </div>
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
                    <form action="panel.php?modulo=editarUsuario" method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $row['email']?>" required>
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre']?>" required>
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="pass" class="form-control" required>
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $row['id']?>">
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