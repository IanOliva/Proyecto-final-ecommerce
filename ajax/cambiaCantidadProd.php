<!-- actualizar la cantidad de un producto específico en la lista de productos almacenada en una cookie, ya sea incrementando
o decrementando su cantidad, según el tipo de acción recibida en la solicitud ($_REQUEST['tipo']). Luego, se devuelve la
lista de productos actualizada en formato JSON. -->

<?php
$productos = unserialize($_COOKIE['productos']);
foreach ($productos as $key => $value) {
    if ($_REQUEST['id'] == $value['id']) {
        if ($_REQUEST['tipo'] == "mas")
            $productos[$key]['cantidad']++;
        else
            $productos[$key]['cantidad']--;
    }
}
setcookie("productos", serialize($productos));
echo json_encode($productos);
?>