<?php
// inserto en la db los detalles de la venta
if ($_SESSION['id_cliente']) {
    if (isset($_REQUEST['pagar'])) {
        ?>
        
        <?php
        $queryVenta = "INSERT INTO ventas (idCli,fecha)
                           VALUES ('" . $_SESSION['id_cliente'] . "',now())";
        $resVenta = mysqli_query($conexion, $queryVenta);
        $id = mysqli_insert_id($conexion);

        
    }

    $insertaDetalle = "";
    $cantProd = count($_REQUEST['id']);
    for ($i = 0; $i < $cantProd; $i++) {
        $subTotal = $_REQUEST['precio'][$i] * $_REQUEST['cantidad'][$i];
        $insertaDetalle = $insertaDetalle . "('" . $_REQUEST['id'][$i] . "','$id','" . $_REQUEST['cantidad'][$i] . "','" . $_REQUEST['precio'][$i] . "','$subTotal'),";
    }
    $insertaDetalle = rtrim($insertaDetalle, ",");
    $queryDetalle = "INSERT INTO detalleventas 
    (idprod, idventa, cantidad, precio, subTotal) values 
    $insertaDetalle;";
    $resDetalle = mysqli_query($conexion, $queryDetalle);
    if ($resVenta && $resDetalle) {
        ?>
        <div class="container">
            <h1 class="display-1 text-center">¡Gracias por tu compra!</h1>
        </div>
        <div class="row">
            <div class="col-6">
                <?php muestraRecibe($id); ?>
            </div>
            <div class="col-6">
                <?php muestraDetalle($id); ?>
            </div>
        </div>
        <?php
        borrarCarrito();
        }
    }

    //funciones para crear las tablas y eliminar los datos del carrito al terminar el pedido
    function borrarCarrito(){
        ?>
            <script>
                $.ajax({
                    type: "post",
                    url: "ajax/borrarCarrito.php",
                    dataType: "json",
                    success: function (response) {
                        $("#badgeProducto").text("");
                        $("#listaCarrito").text("");
                    }
                });
            </script>
        <?php
    }
    function muestraRecibe($idVenta){
    ?>
    <table class="table table-bordered">
        <thead>
            <tr class="table-info">
                <th colspan="3" class="text-center">Persona que recibe</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //se transforma la variable conexion con global para poder usarla dentro de la funcion
                global $conexion;
                $queryRecibe="SELECT nombre,email,direccion 
                from person_recibe 
                where idCli='".$_SESSION['id_cliente']."';";
                $resRecibe=mysqli_query($conexion,$queryRecibe);
                $row=mysqli_fetch_assoc($resRecibe);
            ?>
            <tr>
                <td><?php echo $row['nombre'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['direccion'] ?></td>
            </tr>
        </tbody>
    </table>
    <?php
    }
    function muestraDetalle($idVenta){
        ?>
        <table class="table table-bordered">
            <thead>
                <tr class="table-info">
                    <th colspan="4" class="text-center">Detalle de venta</th>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    global $conexion;
                    $queryDetalle="SELECT
                    p.nombre,
                    dv.cantidad,
                    dv.precio,
                    dv.subTotal
                    FROM
                    ventas AS v
                    INNER JOIN detalleVentas AS dv ON dv.idVenta = v.id
                    INNER JOIN productos AS p ON p.id = dv.idProd
                    WHERE
                    v.id = '$idVenta'";
                    $resDetalle=mysqli_query($conexion,$queryDetalle);
                    $total=0;
                    while($row=mysqli_fetch_assoc($resDetalle)){
                        $total=$total+$row['subTotal'];
                ?>
                <tr>
                    <td><?php echo $row['nombre'] ?></td>
                    <td><?php echo $row['cantidad'] ?></td>
                    <td><?php echo number_format($row['precio'],2) ?></td>
                    <td><?php echo number_format($row['subTotal'],2) ?></td>
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                    <td><strong>$<?php echo number_format($total,2); ?></strong></td>
                </tr>

            </tbody>
        </table>

        <a id="" class="btn btn-secondary float-right" target="_blank" href="imprimirFactura.php?idVenta=<?php echo $idVenta ?>" role="button"><i class="fa fa-file" aria-hidden="true"></i> Ver factura</a>

        <?php
        }

?>