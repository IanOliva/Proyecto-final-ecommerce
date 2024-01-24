<?php
include_once "admin/DBecommerce.php";
$conexion = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['confCambios'])) {


    $email = mysqli_real_escape_string($conexion, $_REQUEST['email'] ?? '');
    $nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre'] ?? '');
    $apellido = mysqli_real_escape_string($conexion, $_REQUEST['apellido'] ?? '');
    $telefono = mysqli_real_escape_string($conexion, $_REQUEST['telefono'] ?? '');
    $direccion = mysqli_real_escape_string($conexion, $_REQUEST['direccion'] ?? '');
    $pass = mysqli_real_escape_string($conexion, $_REQUEST['pass'] ?? '');
    $confpass = mysqli_real_escape_string($conexion, $_REQUEST['confpass'] ?? '');
    $id = mysqli_real_escape_string($conexion, $_REQUEST['id'] ?? '');

    if ($pass === $confpass) {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $query = "UPDATE clientes SET email=?, pass=?, nombre=?, apellido=?, telefono=?, direccion=? WHERE id=?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "ssssssi", $email, $pass, $nombre, $apellido, $telefono, $direccion, $id);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            // Redirige a la misma página con un mensaje de éxito
            header("Location: index.php?modulo=cliente&id=$id&mensaje=Usuario modificado correctamente");
            exit(); // Asegura que no se ejecuten más instrucciones después de la redirección
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Error al crear usuario
                <?php ?>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            Las contraseñas no coinciden
        </div>
        <?php
    }
}
?>