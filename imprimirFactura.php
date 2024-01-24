<?php
session_start();
include_once "admin/DBecommerce.php";
$conexion = mysqli_connect($host, $user, $password, $db);



global $conexion;
$queryRecibe = "SELECT nombre,email,direccion 
from person_recibe 
where idCli='" . $_SESSION['id_cliente'] . "';";
$resRecibe = mysqli_query($conexion, $queryRecibe);
$rowRecibe = mysqli_fetch_assoc($resRecibe);

global $conexion;
$queryCli = "SELECT nombre,email,direccion 
from clientes 
where id ='" . $_SESSION['id_cliente'] . "';";
$resCli = mysqli_query($conexion, $queryCli);
$rowCli = mysqli_fetch_assoc($resCli);

$idVenta = mysqli_real_escape_string($conexion, $_REQUEST['idVenta'] ?? '');
$queryVenta = "SELECT v.id,v.fecha
FROM ventas AS v
WHERE v.id = '$idVenta';";
$resVenta = mysqli_query($conexion, $queryVenta);
$rowVenta = mysqli_fetch_assoc($resVenta);


?>

<?php ob_start(); ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Factura
        <?php echo $rowRecibe['nombre']; ?>
    </title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading th {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ url('admin/imageness/logo ian.png') }}" style="width:100%; max-width:100px;">
                            </td>

                            <td>
                                <strong>ID:</strong>
                                <?php echo $rowVenta['id'] ?><br>
                                <strong>Fecha:</strong>
                                <?php echo $rowVenta['fecha'] ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Ecommerce<br>
                                Buenos Aires, Arg<br>
                                Sunnyville, CA 12345
                            </td>

                            <td>
                                <strong>Nombre:</strong>
                                <?php echo $rowCli['nombre'] ?><br>
                                <strong>Email:</strong>
                                <?php echo $rowCli['email'] ?><br>
                                <strong>Dirección:</strong>
                                <?php echo $rowCli['direccion'] ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>



            <tr class="heading">
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>SubTotal</th>
            </tr>

            <?php

            $queryDetalle = "SELECT
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
            $resDetalle = mysqli_query($conexion, $queryDetalle);
            $total = 0;
            while ($row = mysqli_fetch_assoc($resDetalle)) {
                $total = $total + $row['subTotal'];
                ?>
                <tr>
                    <td>
                        <?php echo $row['nombre'] ?>
                    </td>
                    <td>
                        <?php echo $row['cantidad'] ?>
                    </td>
                    <td>
                        <?php echo $row['precio'] ?>
                    </td>
                    <td>
                        <?php echo $row['subTotal'] ?>
                    </td>
                </tr>
                <?php
            }
            ?>


            <tr class="total">
                <td></td>

                <td>
                    <strong>TOTAL:</strong>
                    <?php echo $total; ?>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>

<?php $html=ob_get_clean(); ?>
<?php
include_once"dompdf/autoload.inc.php"; 
use Dompdf\Dompdf;
$pdf=new Dompdf();
$pdf->loadhtml($html);
$pdf->setPaper("A4","landingscape");
$pdf->render();
$pdf->stream("Factura");

?>