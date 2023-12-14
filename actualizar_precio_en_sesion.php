<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["nuevoPrecio"])) {
    $id = $_POST["id"];
    $nuevoPrecio = $_POST["nuevoPrecio"];
    
    // Obtén la lista de productos de la sesión
    $lista = $_SESSION['lista'];

    // Encuentra el producto con el ID correspondiente
    foreach ($lista as $key => $producto) {
        if ($producto->id == $id) {
            // Actualiza el precio seleccionado en el producto
            $lista[$key]->precioSeleccionado = $nuevoPrecio;
            break;
        }
    }

    // Guarda la lista actualizada en la sesión
    $_SESSION['lista'] = $lista;
}
?>
