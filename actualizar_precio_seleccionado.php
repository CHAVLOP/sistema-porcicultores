<?php
// Obtén los datos del producto y el precio seleccionado enviados por AJAX
$id = $_POST['id'];
$precioSeleccionado = $_POST['precioSeleccionado'];

// Actualiza la propiedad "precioSeleccionado" del producto en la lista de la sesión
foreach ($_SESSION['lista'] as &$producto) {
    if ($producto->id == $id) {
        $producto->precioSeleccionado = $precioSeleccionado;
        break;
    }
}

// Recalcula el subtotal y devuelve la nueva información
$total = calcularTotalLista($_SESSION['lista']);
echo json_encode(['subtotal' => $total]);
