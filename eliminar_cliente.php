<?php
$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el cliente';
    exit;
}
include_once "funciones.php";

$resultado = eliminarCliente($id);
if($resultado){
    header("Location: clientes.php");
    echo "Error al eliminar";
    return;
}

echo "Error al eliminar";
?>