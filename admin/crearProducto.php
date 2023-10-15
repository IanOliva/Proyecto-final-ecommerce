<?php
if (isset($_REQUEST['guardar'])) {
    include_once "DBecommerce.php";
$conexion=mysqli_connect($host,$user,$password,$db);

$nombre=mysqli_real_escape_string($conexion,$_REQUEST['nombre']??'');
$precio=mysqli_real_escape_string($conexion,$_REQUEST['precio']??'');
$stock=mysqli_real_escape_string($conexion,$_REQUEST['stock']??'');


$query="INSERT INTO productos (nombre,precio,stock) VALUES ('".$nombre."','".$precio."','".$stock."')";
$res=mysqli_query($conexion,$query);
if ($res) {
    echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=productos&mensaje=Producto Creado correctamente" />';
}else {
    ?>
    <div class="alert alert-danger" role="alert">
        Error al crear producto <?php echo mysqli_error($conexion);?>
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
            <h1>Crear Producto</h1>
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
                    <form action="panel.php?modulo=crearProducto" method="post">
                        
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                            <small id="helpId" class="text-muted">Nombre sin numeros</small>
                        </div>

                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" name="precio" class="form-control" required>
                            <small id="helpId" class="text-muted">Precio unitario del producto</small>
                        </div>
                        <div class="form-group">
                            <label>stock</label>
                            <input type="number" name="stock" class="form-control" required>
                            <small id="helpId" class="text-muted">Cantidad existente</small>
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