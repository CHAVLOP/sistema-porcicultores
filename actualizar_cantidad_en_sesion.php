<?php
// Verificar si se recibieron los parámetros necesarios
if (isset($_POST['id']) && isset($_POST['cantidad'])) {
    $productoId = $_POST['id'];
    $nuevaCantidad = intval($_POST['cantidad']);

    // Iniciar o reanudar la sesión
    session_start();

    // Verificar si la lista de productos existe en la sesión
    if (isset($_SESSION['lista'])) {
        $lista = $_SESSION['lista'];

        // Buscar el producto por su ID en la lista
        foreach ($lista as &$producto) {
            if ($producto->id == $productoId) {
                // Actualizar la cantidad del producto
                $producto->cantidad = $nuevaCantidad;
                break;
            }
        }

        // Actualizar la lista en la sesión
        $_SESSION['lista'] = $lista;
        
        // Responder con éxito
        echo "Cantidad actualizada exitosamente.";
    } else {
        // La lista de productos no existe en la sesión, responder con un error
        echo "Error: La lista de productos no existe en la sesión.";
    }
} else {
    // Los parámetros no están completos, responder con un error
    echo "Error: Parámetros incompletos.";
}
?>
