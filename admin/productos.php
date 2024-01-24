<?php
include_once "DBecommerce.php";
$conexion = mysqli_connect($host,$user,$password,$db);

if (isset($_REQUEST['idborrar'])) {
   $id= mysqli_real_escape_string($conexion,$_REQUEST['idborrar']??'');
   $query="DELETE from productos WHERE id='".$id."';";
   $res=mysqli_query($conexion,$query);
   if ($res) {
    ?><div class="alert alert-success float-right" role="alert">
        Producto eliminado exitosamente
      </div>
    <?php  
   }else {
    ?><div class="alert alert-danger float-right" role="alert">
        Error al eliminar producto <?php echo mysqli_error($conexion);?>
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
          <div>
            <h1>Productos</h1>
          </div>        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detalles de Productos</h3>
                <a class="float-right" href="panel.php?modulo=crearProducto">Agregar Producto <i class="fas fa-plus"></i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaProductos" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagenes</th>
                    <th class="text-center">Editar/borrar</th>     
                  </tr>
                  </thead>
                  <tbody>


<?php
include_once "DBecommerce.php";
$conexion=mysqli_connect($host,$user,$password,$db);
$query="SELECT id,nombre,precio,stock,imagenes FROM productos;";
$res=mysqli_query($conexion,$query);


while ($row= mysqli_fetch_assoc($res)) {
    ?>
    <tr>
    <td><?php echo $row['nombre']?></td>
    <td><?php echo $row['precio']?></td>
    <td><?php echo $row['stock']?></td>
    <td><?php echo $row['imagenes']; ?></td>
    <td class="text-center">
        <a href="panel.php?modulo=editarProducto&idcliente=<?php echo $row['id']?>" class="btn btn-small btn-warning"> <i class="fas fa-edit"></i></a>
        <a href="panel.php?modulo=productos&idborrar=<?php echo $row['id']?>" class="btn btn-small btn-danger eliminar"> <i class="fas fa-trash"></i></a>
    </td>
   
  </tr>
  </tbody>
<?php
}
?>


                 
                  
                  
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

