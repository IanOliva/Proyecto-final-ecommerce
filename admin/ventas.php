<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div>
        <h1>Ventas</h1>
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
              <h3 class="card-title">Detalles de Ventas</h3>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tablaProductos" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Id venta</th>
                    <th>Id Cliente</th>
                    <th>Fecha</th>
                    <th>Ver</th>
                  </tr>
                </thead>
                <tbody>


                  <?php
                  include_once "DBecommerce.php";
                  $conexion = mysqli_connect($host, $user, $password, $db);
                  $query = "SELECT id, idcli, fecha FROM ventas";
                  $stmt = mysqli_prepare($conexion, $query);

                  if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);

                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                          <td>
                            <?php echo htmlspecialchars($row['id']); ?>
                          </td>
                          <td>
                            <?php echo htmlspecialchars($row['idcli']); ?>
                          </td>
                          <td>
                            <?php echo htmlspecialchars($row['fecha']); ?>
                          </td>
                          <td><a href=""><i class="fa fa-plus-square" aria-hidden="true"></i></a></td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                    <?php
                    } else {
                      ?>
                    <div class="alert alert-danger" role="alert">
                      Error al obtener la lista de ventas:
                      <?php echo mysqli_error($conexion); ?>
                    </div>
                    <?php
                    }
                  }
                  // Cerrar la consulta preparada
                  mysqli_stmt_close($stmt);
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