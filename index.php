<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand navbar-dark">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">

                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                    </ul>

                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Navbar Search -->
                        <li class="nav-item">
                            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                                <i class="fas fa-search"></i>
                            </a>
                            <div class="navbar-search-block">
                                <form class="form-inline" action="index.php">
                                    <div class="input-group input-group-sm">
                                        <input class="form-control form-control-navbar" type="search"
                                            placeholder="Search" aria-label="Search" name="nombre" value="<?php echo $_REQUEST['nombre']??'';?>">
                                            <input type="hidden" name="modulo" value="productos">
                                        <div class="input-group-append">
                                            <button class="btn btn-navbar" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Messages Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-cart-plus"></i>

                                <span class="badge badge-danger navbar-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="admin/dist/img/user1-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 mr-3 img-circle">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Brad Diesel
                                                <span class="float-right text-sm text-danger"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">Call me whenever you can...</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="admin/dist/img/user8-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                John Pierce
                                                <span class="float-right text-sm text-muted"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">I got your message bro</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="admin/dist/img/user3-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 img-circle mr-3">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Nora Silvester
                                                <span class="float-right text-sm text-warning"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">The subject goes here</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                            </div>
                        </li>
                        <!-- Notifications Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">

                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="badge badge-warning navbar-badge">15</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-item dropdown-header">15 Notifications</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                                    <span class="float-right text-muted text-sm">3 mins</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-users mr-2"></i> 8 friend requests
                                    <span class="float-right text-muted text-sm">12 hours</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-file mr-2"></i> 3 new reports
                                    <span class="float-right text-muted text-sm">2 days</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- /.navbar -->
                <div class="row mt-2">
                    <?php 
                        include_once "admin/DBecommerce.php";
                        $conexion=mysqli_connect($host,$user,$password,$db);
                        $where=" where 1=1 ";
                        $nombre= mysqli_real_escape_string($conexion,$_REQUEST['nombre']??'');
                        if( empty($nombre)==false ){
                            $where="where nombre like '%".$nombre."%'";
                        }
                        $queryCuenta="SELECT COUNT(*) as cuenta FROM productos  $where ;";
                        $resCuenta=mysqli_query($conexion,$queryCuenta);
                        $rowCuenta=mysqli_fetch_assoc($resCuenta);
                        $totalRegistros=$rowCuenta['cuenta'];
    
                        $elementosPorPagina=6;
    
                        $totalPaginas=ceil($totalRegistros/$elementosPorPagina);
    
                        $paginaSel=$_REQUEST['pagina']??false;
    
                        if($paginaSel==false){
                            $inicioLimite=0;
                            $paginaSel=1;
                        }else{
                            $inicioLimite=($paginaSel-1)* $elementosPorPagina;
                        }
                        $limite=" limit $inicioLimite,$elementosPorPagina ";
                       

                        $query="SELECT id,nombre,precio,stock,imagenes FROM productos $where $limite";
                        $res=mysqli_query($conexion,$query);                            
                        while ($row=mysqli_fetch_assoc($res)) {

                            $path= "admin/".$row['imagenes']; //ubicacion de las imagenes
                        ?>
                        <div class="col-4">
                            <div class="card border-primary">
                              <img class="card-img-top img-thumbnail" src="<?php echo $path?>" alt="">
                              <div class="card-body">
                                <h4 class="card-title "><?php echo $row ['nombre'] ?> </h4>
                                <p class="card-text"><strong>Precio: </strong><?php echo $row ['precio'] ?></p>
                                <p class="card-text"><strong>Stock: </strong><?php echo $row ['stock'] ?> </p>
                                <a class="btn btn-primary" href="#" role="button" >Ver</a>
                              </div>
                            </div>
                        </div>
                        
                        <?php
                        }
                     ?>
                    
                </div>
                <?php
                if($totalPaginas>0){
                ?>
                    <nav aria-label="Page navigation">
                      <ul class="pagination">
                        <?php
                            if( $paginaSel!=1 ){
                        ?>
                        <li class="page-item">
                          <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel-1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <?php
                        }
                        ?>

                        <?php
                        for($i=1;$i<=$totalPaginas;$i++){
                        ?>
                        <li class="page-item <?php echo ($paginaSel==$i)?" active ":" "; ?>">
                            <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php
                        }
                        ?>
                        <?php
                            if( $paginaSel!=$totalPaginas ){
                        ?>
                        <li class="page-item">
                          <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel+1); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                        <?php
                            }
                        ?>
               
                <?php
                }
                 ?>
            </div>
        </div>

    </div>


    <!-- jQuery -->
    <script src="admin/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="admin/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- daterangepicker -->
    <script src="admin/plugins/moment/moment.min.js"></script>
    <script src="admin/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- AdminLTE App -->
    <script src="admin/dist/js/adminlte.js"></script>


</body>

</html>