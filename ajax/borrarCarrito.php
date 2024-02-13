<!-- eliminar la cookie llamada "productos" del navegador del usuario y devolver una respuesta JSON que representa una lista
de productos vacía, usado para eliminar el carrito -->

<?php

setcookie("productos", "");
echo json_encode(array());

?>