<?php
include_once "funciones.php";

$id = $_GET['id'];

if (!$id) {
    echo 'No se ha seleccionado el usuario';
    exit;
}

$resultado = eliminarUsuario($id);

if ($resultado) { // Aquí se corrigió la condición
    echo "Se eliminó correctamente";
    header("Location: usuarios.php");
} else {
    echo "Error al eliminar el usuario";
}
?>
