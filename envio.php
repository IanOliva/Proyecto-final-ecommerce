<?php
if ($_SESSION['id_cliente']) {
    // actualizo el cliente si se modifica sus datos
    if (isset($_REQUEST['guardar'])) {
        $nombreCli = $_REQUEST['nombreCli'] ?? '';
        $emailCli = $_REQUEST['emailCli'] ?? '';
        $direccionCli = $_REQUEST['direccionCli'] ?? '';
        $queryCli = "UPDATE clientes set nombre='$nombreCli',email='$emailCli',direccion='$direccionCli' where id='" . $_SESSION['id_cliente'] . "' ";
        $resCli = mysqli_query($conexion, $queryCli);
    //inserto los datos de la persona que recibe en la db
        $nombreRec = $_REQUEST['nombreRec'] ?? '';
        $emailRec = $_REQUEST['emailRec'] ?? '';
        $direccionRec = $_REQUEST['direccionRec'] ?? '';
        $queryRec = "INSERT INTO person_recibe (nombre,email,direccion,idCli) VALUES ('$nombreRec','$emailRec','$direccionRec','" . $_SESSION['id_cliente'] . "')
        ON DUPLICATE KEY UPDATE
        nombre='$nombreRec',email='$emailRec',direccion='$direccionRec'; ";
        $resRec = mysqli_query($conexion, $queryRec);
        if ($resCli && $resRec) {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=pasarela" />';
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Error
            </div>
            <?php
        }
    }

    //obtengo ambos datos de la db para mostrar en los inputs cliente y destino

    $queryCli = "SELECT nombre,email,direccion from clientes where id='" . $_SESSION['id_cliente'] . "';";
    $resCli = mysqli_query($conexion, $queryCli);
    $rowCli = mysqli_fetch_assoc($resCli);

    $queryRec = "SELECT nombre,email,direccion from person_recibe where idCli='" . $_SESSION['id_cliente'] . "';";
    $resRec = mysqli_query($conexion, $queryRec);
    $rowRec = mysqli_fetch_assoc($resRec);
    ?>

    <form method="post">
        <div class="container mt-3">
            <div class="row">
                <div class="col-6">
                    <h3>Datos del cliente</h3>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="nombreCli" id="nombreCli" class="form-control"
                            value="<?php echo $rowCli['nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="emailCli" id="emailCli" class="form-control" readonly="readonly"
                            value="<?php echo $rowCli['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Direccion</label>
                        <textarea name="direccionCli" id="direccionCli" class="form-control"
                            row="3"><?php echo $rowCli['direccion'] ?></textarea>
                    </div>
                </div>

                <div class="col-6">
                    <h3>Datos de quien recibe</h3>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="nombreRec" id="nombreRec" class="form-control"
                            value="<?php echo $rowRec['nombre']??'' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="emailRec" id="emailRec" class="form-control"
                            value="<?php echo $rowRec['email']??'' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Direccion</label>
                        <textarea name="direccionRec" id="direccionRec" class="form-control"
                            row="3"><?php echo $rowRec['direccion']??'' ?> </textarea>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="obtener">
                            Usar datos del cliente
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <a class="btn btn-warning" href="index.php?modulo=carrito" role="button">Regresar al carrito</a>
        <button type="submit" class="btn btn-primary float-right" name="guardar" value="guardar">Ir a pagar</button>
    </form>
    <?php
} else {
    ?>
    <div class="mt-5 text-center">
        Debe <a href="login.php">Ingresar</a> o <a href="registro.php">Registrarse</a>
    </div>

    <?php
}
?>