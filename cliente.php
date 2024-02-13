<?php
//obtengo los datos de cliente

include_once "admin/DBecommerce.php";
$conexion = mysqli_connect($host, $user, $password, $db);


$id = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');
// Consulta preparada para evitar la inyección de SQL
$query = "SELECT id, nombre, apellido, email, telefono, direccion FROM clientes WHERE id = ?";
$stmt = mysqli_prepare($conexion, $query);
// Vincula el parámetro
mysqli_stmt_bind_param($stmt, "i", $id);
// Ejecuta la consulta
mysqli_stmt_execute($stmt);
// Vincula el resultado a variables
mysqli_stmt_bind_result($stmt, $resultId, $resultNombre, $resultApellido, $resultEmail, $resultTelefono, $resultDireccion);
// Obtiene el resultado
mysqli_stmt_fetch($stmt);
$resId = $resultId;
$resNombre = $resultNombre;
$resApellido = $resultApellido;
$resEmail = $resultEmail;
$resTelefono = $resultTelefono;
$resDireccion = $resultDireccion;
// Cierra la consulta preparada 
mysqli_stmt_close($stmt);


//obtengo cantidad de compras del cliente
$id = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');
$queryventas = "SELECT COUNT(id) as num FROM ventas WHERE idcli = ?";
$stmtventas = mysqli_prepare($conexion, $queryventas);

mysqli_stmt_bind_param($stmtventas, "i", $id);
mysqli_stmt_execute($stmtventas);
mysqli_stmt_bind_result($stmtventas, $resultVentas);
mysqli_stmt_fetch($stmtventas);
$resVentas = $resultVentas;
mysqli_stmt_close($stmtventas);
?>




<div class="col-12 text-center ">
    <h1 class="display-2">

    </h1>
    <p class="lead">
        Aqui puedes ver la información de tu cuenta y modificarla
    </p>

</div>



<div class="row">

    <div class="card card-primary  col-6 ">
        <div class="card-body box-profile m-5">


            <h3 class="profile-username text-center"><i class="fa fa-user" aria-hidden="true"></i> Perfil de
                <?php echo $resNombre . " " . $resApellido; ?>
            </h3>

            <p class="text-muted text-center">Cliente</p>

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <?php

                    ; ?>
                    <b>Compras</b> <a class="float-right">
                        <?php echo $resVentas;
                         ?>
                    </a>
                </li>


            </ul>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->




    <div class="card col-6 ">

        <!-- /.card-header -->
        <div class="card-body">
            <form action="modificarCliente.php" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $resEmail ?>" required>
                    <small id="helpId" class="text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?php echo $resNombre ?>" required>
                    <small id="helpId" class="text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="<?php echo $resApellido ?>"
                        required>
                    <small id="helpId" class="text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="number" name="telefono" class="form-control" value="<?php echo $resTelefono ?>"
                        required>
                    <small id="helpId" class="text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="<?php echo $resDireccion ?>"
                        required>
                    <small id="helpId" class="text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="pass" class="form-control" required>
                    <small id="helpId" class="text-muted"></small>
                </div>
                <div class="form-group">
                    <label>Confirmar contraseña</label>
                    <input type="password" name="confpass" class="form-control" required>
                    <small id="helpId" class="text-muted"></small>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $resId ?>">
                    <button type="submit" class="btn btn-primary" name="confCambios">Confirmar cambios</button>
                </div>
            </form>

        </div>
    </div>


</div>
