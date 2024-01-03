<?php
if ($_SESSION['id_cliente']) {
    if (isset($_REQUEST['guardar'])) {
        $nombrecli=$_REQUEST['nombrecli']??'';
        $emailcli=$_REQUEST['emailcli']??'';
        $direccioncli=$_REQUEST['direccioncli']??'';

        $querycli="UPDATE clientes set nombre= '$nombrecli', email='$emailcli',direccion='$direccioncli' WHERE id ='".$_SESSION['id_cliente']."'";
        $rescli=mysqli_query($conexion,$querycli);

        
        if ( $rescli) {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=pasarela" /> ';
        }else {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>ERROR</strong> 
                </div>
                
                <script>
                  $(".alert").alert();
                </script>
            <?php 
        }
    }

    $querycli="SELECT nombre,email,direccion from clientes where id= '".$_SESSION['id_cliente']."';";
    $rescli = mysqli_query($conexion,$querycli);
    $rowcli = mysqli_fetch_assoc($rescli);

   
    ?>

    <form method="post">


        <div class="container mt-3">
            <div class="row">
                <div class="col-6">
                    <h3>Datos del cliente</h3>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="nombrecli" id="nombrecli" class="form-control" value="<?php echo $rowcli['nombre']?>">

                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="emailcli" id="emailcli" class="form-control" readonly="readonly" value="<?php echo $rowcli['email']?>">

                    </div>
                    <div class="form-group">
                        <label for="">Direccion</label>
                        <textarea class="form-control" name="direccioncli" id="direccioncli" rows="3" ><?php echo $rowcli['direccion']?></textarea>
                    </div>
                </div>
                <div class="col-6 d-flex flex-column align-items-center justify-content-center">
                    <a class="btn btn-primary m-2" href="index.php?modulo=carrito" role="button">Volver al carrito</a>
                    <button type="submit" class="btn btn-success m-2" name="guardar" value="guardar">Proceder al pago</button>
                </div>
            </div>

        </div>
        </div>
       
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