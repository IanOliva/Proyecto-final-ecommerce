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
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
                <p class="login-box-msg">Iniciar Sesion</p>
                <?php
                if (isset($_REQUEST['login'])) {

                    session_start();
                    $email = $_REQUEST['email'] ?? '';
                    $pass = $_REQUEST['pass'] ?? '';
                    $pass = md5($pass);
                    include_once "DBecommerce.php";
                    $conexion = mysqli_connect($host, $user, $password, $db);
                    $query = "SELECT id,email,nombre FROM usuarios where email='" . $email . "' and pass='" . $pass . "'";
                    $res = mysqli_query($conexion, $query);
                    $row = mysqli_fetch_assoc($res);
                    if ($row) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['nombre'] = $row['nombre'];
                        header("location: panel.php");
                    } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Error al loguear
                        </div>
                        <?php

                    }
                }
                ?>

                <form method="post">

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                            aria-describedby="basic-addon1" name="email" required>

                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                        <input type="password" class="form-control" placeholder="Password" aria-label="contraseña"
                            name="pass" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-block" name="login">Ingresar</button>
                    </div>
            </div>
        </div>
        <div class="row">

            <!-- /.col -->

            <!-- /.col -->
        </div>
        </form>




        <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->


    </div>
    <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->



    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>

</html>