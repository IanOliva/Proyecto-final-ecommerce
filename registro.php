<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Proyecto ecommerce</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->

    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- iconos -->
    <script src="https://kit.fontawesome.com/84f1588987.js" crossorigin="anonymous"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <p><b>Proyecto</b> ecommerce</p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body">
                <p class="login-box-msg">Crea tu cuenta</p>
                <?php
                //registrar un nuevo cliente
                if (isset($_REQUEST['registro'])) {

                    session_start();
                    $nombre = $_REQUEST['nombre'] ?? '';
                    $apellido = $_REQUEST['apellido'] ?? '';
                    $telefono = $_REQUEST['telefono'] ?? '';
                    $email = $_REQUEST['email'] ?? '';
                    $pass = $_REQUEST['pass'] ?? '';
                    $confpass = $_REQUEST['pass'] ?? '';

                    if ($pass === $confpass) {
                        $pass = password_hash($pass, PASSWORD_DEFAULT);
                        include_once "admin/DBecommerce.php";
                        $conexion = mysqli_connect($host, $user, $password, $db);

                        $query = "INSERT INTO clientes(nombre, apellido, telefono, email, pass) VALUES (?, ?, ?, ?, ?)";
                        $stmt = mysqli_prepare($conexion, $query);

                        
                        mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $telefono, $email, $pass);

                       
                        $res = mysqli_stmt_execute($stmt);
                    }



                    if ($res) {
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Usuario creado exitosamente</strong>
                            <a href="login.php">Ir al inicio de sesion</a>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Error al Registrarse
                        </div>

                        <?php
                        mysqli_stmt_close($stmt);
                        mysqli_close($conexion);
                    }
                }
                ?>

                <form method="post">

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre"
                            aria-describedby="basic-addon1" name="nombre" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Apellido" aria-label="Apellido"
                            aria-describedby="basic-addon1" name="apellido" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        <input type="number" class="form-control" placeholder="Telefono" aria-label="Telefono"
                            aria-describedby="basic-addon1" name="telefono" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                            aria-describedby="basic-addon1" name="email" required>

                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                        <input type="password" class="form-control" placeholder="Contraseña" aria-label="contraseña"
                            name="pass" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                        <input type="password" class="form-control" placeholder="Confirmar contraseña" name="confpass"
                            required>

                    </div>
                    <div class="m-2 row">
                        <button type="submit" class="btn btn-primary btn-block" name="registro">Registrarse</button>
                        <a href="login.php" class="text-success text-center mt-2">Ingresar</a>
                    </div>
                </form>
            </div>
        </div>






        <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->


    </div>



    <!-- AdminLTE App -->
    <script src="admin/dist/js/adminlte.min.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>

</html>