<?php
$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el producto';
    exit;
}
include_once "funciones.php";

$resultado = eliminarProducto($id);
if($resultado){
    header("Location: productos.php");
    echo "Se elimino correctamente el producto";
    
}

echo "Oh, No se pudo eliminar el producto";
return;
?>