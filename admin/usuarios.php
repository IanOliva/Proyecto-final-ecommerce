<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
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
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Opciones
                        <a href="panel.php?modulo=crearUsuario"><i class="fas fa-plus"></i></a>
                    </th>
                  </tr>
                  </thead>
                  <tbody>
<?php
include_once "DBecommerce.php";
$conexion=mysqli_connect($host,$user,$password,$db);
$query="SELECT id,email,nombre FROM usuarios;";
$res=mysqli_query($conexion,$query);


while ($row= mysqli_fetch_assoc($res)) {
    ?>
    <tr>
    <td><?php echo $row['nombre']?></td>
    <td><?php echo $row['email']?></td>
    <td class="text-center">
        <a href="editarUsuario.php?id=<?php echo $row['id']?>" class="btn btn-small btn-warning"> <i class="fas fa-edit"></i></a>
        <a href="usuarios.php?idborrar=<?php echo $row['id']?>" class="btn btn-small btn-danger"> <i class="fas fa-trash"></i></a>
    </td>
   
  </tr>
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