<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda |</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="admin/plugins/daterangepicker/daterangepicker.css">
    <?php
    session_start();
    $accion = $_REQUEST['accion'] ?? '';
    if ($accion == 'cerrar') {
        session_destroy();
        header("Refresh:0");
    }
    ?>
</head>

<body>
 <!-- jQuery -->
 <script src="admin/plugins/jquery/jquery.min.js"></script>
 
    <?php
    include_once "admin/DBecommerce.php";
    $conexion = mysqli_connect($host, $user, $password, $db);
    ?>


    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                include_once "menu.php";
                ?>
                <?php
                $modulo = $_REQUEST['modulo'] ?? '';
                if ($modulo == 'productos' || $modulo == "") {
                    include_once "productosTienda.php";
                }
                if ($modulo == "detalleproducto") {
                    include_once "detalleproducto.php";
                }
                if ($modulo == "carrito") {
                    include_once "carrito.php";
                }
                if ($modulo == "envio") {
                    include_once "envio.php";
                }
                if ($modulo == "pasarela") {
                    include_once "pasarela.php";
                }
                if( $modulo=="factura" ){
                    include_once "factura.php";
                }        
                ?>
            </div>

        </div>


       
        <!-- jQuery UI 1.11.4 -->
        <script src="admin/plugins/jquery-ui/jquery-ui.min.js"></script>

        <!-- Bootstrap 4 -->
        <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- daterangepicker -->
        <script src="admin/plugins/moment/moment.min.js"></script>
        <script src="admin/plugins/daterangepicker/daterangepicker.js"></script>

        <!-- AdminLTE App -->
        <script src="admin/dist/js/adminlte.js"></script>

        <script src="admin/js/ecommerce.js"></script>
</body>

</html>