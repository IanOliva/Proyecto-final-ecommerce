<?php

if ($_SESSION['id_cliente']) {
    if (isset($_REQUEST['pagar'])) {
        ?>
        
        <?php
        $queryVenta = "INSERT INTO ventas (idCli,fecha)
                           VALUES ('" . $_SESSION['id_cliente'] . "',now())";
        $resVenta = mysqli_query($conexion, $queryVenta);
        $id = mysqli_insert_id($conexion);

        // if ($resVenta) {
        //     echo "El pedido a sido confirmado con el id = " .$id;
        // }
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
    <table class="table">
        <thead>
            <tr>
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
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3" class="text-center">Detalle de venta</th>
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
                    <td><?php echo $row['precio'] ?></td>
                    <td><?php echo $row['subTotal'] ?></td>
                </tr>
                <?php
                    }
                ?>
                <tr>
                    <td colspan="3" class="text-right">Total:</td>
                    <td><?php echo $total; ?></td>
                </tr>

            </tbody>
        </table>
        <?php
        }

?>