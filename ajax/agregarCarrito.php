<!-- agregar productos a una lista de productos almacenada en una cookie. Si un producto ya está presente en la lista, se
actualiza su cantidad. Si no, se añade como un nuevo producto. Finalmente, se devuelve la lista de productos actualizada
en formato JSON. -->

<?php
$productos = unserialize($_COOKIE['productos'] ?? '');
if (is_array($productos) == false)
    $productos = array();
$siYaEstaProducto = false;
foreach ($productos as $key => $value) {
    if ($value['id'] == $_REQUEST['id']) {
        $productos[$key]['cantidad'] = $productos[$key]['cantidad'] + $_REQUEST['cantidad'];
        $siYaEstaProducto = true;
    }
}
if ($siYaEstaProducto == false) {
    $nuevo = [
        "id" => $_REQUEST['id'],
        "nombre" => $_REQUEST['nombre'],
        "path" => $_REQUEST['path'],
        "cantidad" => $_REQUEST['cantidad'],
        "precio" => $_REQUEST['precio']
    ];
    array_push($productos, $nuevo);
}
setcookie("productos", serialize($productos));
echo json_encode($productos);

?>