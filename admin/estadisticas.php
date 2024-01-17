<?php
include_once "DBecommerce.php";
$conexion = mysqli_connect($host, $user, $password, $db);

$queryNumVentas = "SELECT COUNT(id) AS num FROM ventas WHERE fecha BETWEEN DATE(DATE_SUB(now(),INTERVAL 7 DAY)) AND NOW();";
$resNumVentas = mysqli_query($conexion, $queryNumVentas);
$rowNumVentas = mysqli_fetch_assoc($resNumVentas);

$queryNumCli = "SELECT COUNT(id) AS num FROM clientes;";
$resNumCli = mysqli_query($conexion, $queryNumCli);
$rowNumCli = mysqli_fetch_assoc($resNumCli);

$queryNumProd = "SELECT COUNT(id) AS num FROM productos;";
$resNumProd = mysqli_query($conexion, $queryNumProd);
$rowNumProd = mysqli_fetch_assoc($resNumProd);

$queryVentasDia = "SELECT
COUNT(detalleventas.subTotal) as total,
ventas.fecha
FROM
ventas
INNER JOIN detalleventas ON detalleventas.idventa = ventas.id
GROUP BY DAY(ventas.fecha);";
$resVentasDia = mysqli_query($conexion, $queryVentasDia);
$labelVentas = "";
$datosVentas = "";

while ($rowVentasDia = mysqli_fetch_assoc($resVentasDia)) {
  $labelVentas = $labelVentas . "'" . date_format(date_create($rowVentasDia['fecha']), "d-m-y") . "',";
  $datosVentas = $datosVentas.$rowVentasDia['total'] . ",";
}
$labelVentas = rtrim($labelVentas, ",");
$datosVentas = rtrim($datosVentas, ",");


?>
<script>
  var labelVentas = [<?php echo $labelVentas;?>];
  var datosVentas = [<?php echo $datosVentas;?>];
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
                <?php echo $rowNumVentas['num']; ?>
              </h3>
              <p>Ventas en los ultimos 7 dias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>
                <?php echo $rowNumProd['num']; ?><sup style="font-size: 20px"></sup>
              </h3>

              <p>Productos Cargados</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>
                <?php echo $rowNumCli['num']; ?>
              </h3>

              <p>Usuarios Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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