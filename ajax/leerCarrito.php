<!-- obtener la lista de productos almacenada en una cookie llamada "productos" y devolverla al cliente en formato JSON. Si
la cookie no existe o no se puede deserializar, se devuelve un array vacío en formato JSON. -->

<?php
$productos = unserialize($_COOKIE['productos'] ?? '');
echo json_encode($productos);

?>