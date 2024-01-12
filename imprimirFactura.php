<?php 
session_start();
include_once "admin/DBecommerce.php";
$conexion = mysqli_connect($host, $user, $password, $db);



global $conexion;
$queryRecibe="SELECT nombre,email,direccion 
from person_recibe 
where idCli='".$_SESSION['id_cliente']."';";
$resRecibe=mysqli_query($conexion,$queryRecibe);
$rowRecibe=mysqli_fetch_assoc($resRecibe);

global $conexion;
$queryCli="SELECT nombre,email,direccion 
from clientes 
where id ='".$_SESSION['id_cliente']."';";
$resCli=mysqli_query($conexion,$queryCli);
$rowCli=mysqli_fetch_assoc($resCli);

$idVenta= mysqli_real_escape_string($conexion,$_REQUEST['idVenta']??'');
$queryVenta="SELECT v.id,v.fecha
FROM ventas AS v
WHERE v.id = '$idVenta';";
$resVenta=mysqli_query($conexion,$queryVenta);
$rowVenta=mysqli_fetch_assoc($resVenta);


?>

<?php ob_start(); ?>
<div>
    <img src="admin/imagenes/logo ian.png" style="width: 30px;">
    Proyecto Ecommerce
</div>

<table style="width: 750px; margin-top: 20px;">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Destinatario</th>
            <th>Datos de la factura</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <strong>Nombre:</strong> <?php echo $rowCli['nombre'] ?><br>
                <strong>Email:</strong> <?php echo $rowCli['email'] ?><br>
                <strong>Dirección:</strong> <?php echo $rowCli['direccion'] ?><br>

            </td>
            <td>
                <strong>Nombre:</strong> <?php echo $rowRecibe['nombre'] ?><br>
                <strong>Email:</strong> <?php echo $rowRecibe['email'] ?><br>
                <strong>Dirección:</strong> <?php echo $rowRecibe['direccion'] ?><br>
            </td>
            <td>
                <strong>ID:</strong> <?php echo $rowVenta['id'] ?><br>
                <strong>fecha:</strong> <?php echo $rowVenta['fecha'] ?><br>


            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<table style="width: 750px;margin-top:30px">
            <thead>
                
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
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
<?php $html=ob_get_clean(); ?>
    <?php 
    include_once"dompdf/autoload.inc.php"; 
    use Dompdf\Dompdf;
    $pdf=new Dompdf();
    $pdf->load_html($html);
    $pdf->setPaper("A4","landingscape");
    $pdf->render();
    $pdf->stream();
    
    ?>