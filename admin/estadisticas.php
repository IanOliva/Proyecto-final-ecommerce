<?php
include_once "DBecommerce.php";
$conexion = mysqli_connect($host, $user, $password, $db);

//obtener las ventas de los ultimos 7 dias
$queryNumVentas = "SELECT COUNT(id) AS num FROM ventas WHERE fecha BETWEEN DATE(DATE_SUB(now(),INTERVAL 7 DAY)) AND NOW();";
$stmtNumVentas = mysqli_prepare($conexion, $queryNumVentas);
if ($stmtNumVentas) {
  // 2. Ejecutar la consulta
  mysqli_stmt_execute($stmtNumVentas);

  // 3. Vincular resultados
  mysqli_stmt_bind_result($stmtNumVentas, $numVentas);

  // 4. Obtener resultados
  mysqli_stmt_fetch($stmtNumVentas);
  $Ventas = $numVentas;
  // 5. Cerrar la sentencia preparada
  mysqli_stmt_close($stmtNumVentas);
}


//obtener la cantidad de usuarios registrados
$queryNumCli = "SELECT COUNT(id) AS num FROM clientes";
$stmtclientes = mysqli_prepare($conexion, $queryNumCli);
if ($stmtclientes) {
  // 2. Ejecutar la consulta
  mysqli_stmt_execute($stmtclientes);

  // 3. Vincular resultados
  mysqli_stmt_bind_result($stmtclientes, $num);

  // 4. Obtener resultados
  mysqli_stmt_fetch($stmtclientes);
  $clientes = $num;
  // 5. Cerrar la sentencia preparada
  mysqli_stmt_close($stmtclientes);

  // // 6. Cerrar la conexión
  // mysqli_close($conexion);
}

//obtener la cantidad de productos cargados
$queryNumProd = "SELECT COUNT(id) AS num FROM productos;";
$stmtproductos = mysqli_prepare($conexion, $queryNumProd);
if ($stmtproductos) {

  mysqli_stmt_execute($stmtproductos);

  mysqli_stmt_bind_result($stmtproductos, $numProd);

  mysqli_stmt_fetch($stmtproductos);
  $productos = $numProd;

  mysqli_stmt_close($stmtproductos);
}


//obtener los valores para el grafico de ventas
$queryVentasDia = "SELECT
                        COUNT(detalleventas.subTotal) as total,
                        DATE_FORMAT(ventas.fecha, '%d-%m-%y') as fecha_formateada
                    FROM
                        ventas
                    INNER JOIN detalleventas ON detalleventas.idventa = ventas.id
                    GROUP BY fecha_formateada";

$stmtVentasDia = mysqli_prepare($conexion, $queryVentasDia);

if ($stmtVentasDia) {
  mysqli_stmt_execute($stmtVentasDia);

  $labelVentas = [];
  $datosVentas = [];

  mysqli_stmt_bind_result($stmtVentasDia, $total, $fecha_formateada);

  while (mysqli_stmt_fetch($stmtVentasDia)) {
    $labelVentas[] = "'" . $fecha_formateada . "'";
    $datosVentas[] = $total;
  }

  // Convertir arrays a cadenas
  $labelVentas = implode(",", $labelVentas);
  $datosVentas = implode(",", $datosVentas);

  mysqli_stmt_close($stmtVentasDia);
} else {
  echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
}




?>
<script>
  var labelVentas = [<?php echo $labelVentas; ?>];
  var datosVentas = [<?php echo $datosVentas; ?>];
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>
                <?php echo $Ventas; ?>
              </h3>
              <p>Ventas en los ultimos 7 dias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <br>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>
                <?php echo $productos; ?><sup style="font-size: 20px"></sup>
              </h3>

              <p>Productos Cargados</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <br>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>
                <?php echo $clientes; ?>
              </h3>

              <p>Usuarios Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <br>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>10</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <br>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Ventas por dia
              </h3>

            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                  <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->





        </section>

  </section>
  <!-- right col -->
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>