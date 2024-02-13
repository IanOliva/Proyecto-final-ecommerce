<?php
include_once "DBecommerce.php";
$conexion = mysqli_connect($host, $user, $password, $db);
//borrar por id
if (isset($_REQUEST['idborrar'])) {
  $id = mysqli_real_escape_string($conexion, $_REQUEST['idborrar'] ?? '');

  // Utilizar una consulta preparada
  $query = "DELETE FROM usuarios WHERE id = ?";
  $stmt = mysqli_prepare($conexion, $query);

  if ($stmt) {
    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "s", $id);

    // Ejecutar la consulta preparada
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
      ?>
      <div class="alert alert-success float-right" role="alert">
        Usuario eliminado exitosamente
      </div>
      <?php
    } else {
      ?>
      <div class="alert alert-danger float-right" role="alert">
        Error al eliminar usuario:
        <?php echo mysqli_error($conexion); ?>
      </div>
      <?php
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);
  } else {
    ?>
    <div class="alert alert-danger float-right" role="alert">
      Error en la preparación de la consulta:
      <?php echo mysqli_error($conexion); ?>
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
              <h3 class="card-title">Detalles de Usuarios administradores</h3>
              <a class="float-right" href="panel.php?modulo=crearUsuario">Crear Usuario <i class="fas fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tablaUsuarios" class="table table-bordered table-hover display">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th class="text-center">Editar/borrar</th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  //obtener los datos de los usuarios
                  include_once "DBecommerce.php";
                  $conexion = mysqli_connect($host, $user, $password, $db);
                  $query = "SELECT id, email, nombre FROM usuarios";
                  $stmt = mysqli_prepare($conexion, $query);

                  if ($stmt) {
                    mysqli_stmt_execute($stmt);

                    $res = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($res)) {
                      ?>
                      <tr>
                        <td>
                          <?php echo htmlspecialchars($row['nombre']); ?>
                        </td>
                        <td>
                          <?php echo htmlspecialchars($row['email']); ?>
                        </td>
                        <td class="text-center">
                          <a href="panel.php?modulo=editarUsuario&id=<?php echo htmlspecialchars($row['id']); ?>"
                            class="btn btn-small btn-warning"> <i class="fas fa-edit"></i></a>
                          <a href="panel.php?modulo=usuarios&idborrar=<?php echo htmlspecialchars($row['id']); ?>"
                            class="btn btn-small btn-danger eliminar"> <i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php
                    }

                    mysqli_stmt_close($stmt);
                  } else {
                    echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
                  }
                  ?>
                </tbody>







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