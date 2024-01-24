<!-- Navbar -->
<nav class="navbar navbar-expand navbar-dark bg-primary sticky-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">

        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php#contacto" class="nav-link">Contacto</a>
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
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search" name="nombre" value="<?php echo $_REQUEST['nombre'] ?? ''; ?>">
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

        <!-- carrito Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" id="iconoCarrito">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                <span class="badge badge-danger navbar-badge" id="badgeProducto"></span>

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="listaCarrito">

            </div>

        </li>
        <!-- user Dropdown Menu -->
        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <?php
                if (isset($_SESSION['id_cliente']) == false) {
                    ?>
                    <a href="login.php" class="dropdown-item">
                        <i class="fas fa-door-open mr-2 text-primary"></i>Ingresar
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="registro.php" class="dropdown-item">
                        <i class="fas fa-sign-in-alt mr-2 text-primary"></i>Registrarse
                    </a>
                    <?php
                } else {
                    
                    ?>
                    <a href="index.php?modulo=cliente&id=<?php echo $_SESSION['id_cliente']; ?> " class="dropdown-item">
                        <i class="fas fa-user text-primary mr-2"></i>Hola
                        <?php echo $_SESSION['nombre_cliente']; ?>
                    </a>
                    <form action="index.php" method="post">
                        <button name="accion" class="btn btn-danger dropdown-item" type="submit" value="cerrar">
                            <i class="fas fa-door-closed text-danger mr-2"></i>Cerrar sesion
                        </button>
                    </form>
                    <?php
                }
                ?>

            </div>
        </li>

    </ul>
</nav>
