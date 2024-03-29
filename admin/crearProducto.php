<?php

// insertar en bd los datos del producto 

if (isset($_REQUEST['guardar'])) {
    include_once "DBecommerce.php";
    $conexion = mysqli_connect($host, $user, $password, $db);

    $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre'] ?? '');
    $precio = mysqli_real_escape_string($conexion, $_REQUEST['precio'] ?? '');
    $stock = mysqli_real_escape_string($conexion, $_REQUEST['stock'] ?? '');

    if ($_FILES["imagenes"]["error"] == UPLOAD_ERR_OK) {
        $nombre_base = basename($_FILES["imagenes"]["name"]);
        $nombre_final = date("d-m-y") . "-" . date("h-i-s") . "-" . $nombre_base; // Diferenciar imágenes
        $ruta = "archivos/" . $nombre_final;

        $subirarchivo = move_uploaded_file($_FILES["imagenes"]["tmp_name"], $ruta);
        if ($subirarchivo) {
            $query = "INSERT INTO productos (nombre, precio, stock, imagenes) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conexion, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $nombre, $precio, $stock, $ruta);
                $res = mysqli_stmt_execute($stmt);

                if ($res) {
                    echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=productos&mensaje=Producto creado correctamente" />';
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Error al crear producto:
                        <?php echo mysqli_error($conexion); ?>
                    </div>
                    <?php
                }

                // Cerrar la consulta preparada
                mysqli_stmt_close($stmt);
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    Error en la preparación de la consulta:
                    <?php echo mysqli_error($conexion); ?>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Error al subir el archivo. Asegúrate de que la carpeta "archivos" existe y tiene los permisos adecuados.
            </div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            Error al subir el archivo:
            <?php echo $_FILES["imagenes"]["error"]; ?>
        </div>
        <?php
    }


}
?>






<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1>Crear Producto</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 m-auto">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="panel.php?modulo=crearProducto" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                    <small id="helpId" class="text-muted">Nombre sin numeros</small>
                                </div>

                                <div class="form-group">
                                    <label>Precio</label>
                                    <input type="number" name="precio" class="form-control" required>
                                    <small id="helpId" class="text-muted">Precio unitario del producto</small>
                                </div>
                                <div class="form-group">
                                    <label>stock</label>
                                    <input type="number" name="stock" class="form-control" required>
                                    <small id="helpId" class="text-muted">Cantidad existente</small>
                                </div>

                                <div class="form-group">
                                    <label>Imagenes</label>
                                    <input type="file" name="imagenes" class="form-control-file" required>
                                    <small id="helpId" class="form-text text-muted">Imagenes del producto</small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                                </div>
                            </form>

                        </div>



                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>