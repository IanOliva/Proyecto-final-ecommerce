<?php
    include_once "DBecommerce.php";
    $conexion=mysqli_connect($host,$user,$password,$db);

if (isset($_REQUEST['guardar'])) {

$nombre=mysqli_real_escape_string($conexion,$_REQUEST['nombre']??'');
$precio=mysqli_real_escape_string($conexion,$_REQUEST['precio']??'');
$stock=mysqli_real_escape_string($conexion,$_REQUEST['stock']??'');
$id=mysqli_real_escape_string($conexion,$_REQUEST['id']??'');


$query="UPDATE productos SET stock='".$stock."', precio='".$precio."',nombre='".$nombre."' WHERE id='".$id."'; ";
$res=mysqli_query($conexion,$query);
if ($res) {
    echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=productos&mensaje=Producto modificado correctamente" />';
}else {
    ?>
    <div class="alert alert-danger" role="alert">
        Error al crear usuario <?php echo mysqli_error($conexion);?>
    </div>
<?php
}
    
}

$id= mysqli_real_escape_string($conexion,$_REQUEST['id']??'');
$query="SELECT id,nombre,precio,stock FROM productos WHERE id='".$id."';";
$res=mysqli_query($conexion,$query);
$row=mysqli_fetch_assoc($res);

?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Producto</h1>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                    <form action="panel.php?modulo=editarProducto" method="post">
                        
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre']?>" required>
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                            <label>Precio</label>
                            <input type="number" name="precio" class="form-control" value="<?php echo $row['precio']?>" required>
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                            <label>stock</label>
                            <input type="text" name="stock" class="form-control" value="<?php echo $row['stock']?>" required>
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