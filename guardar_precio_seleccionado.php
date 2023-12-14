<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && isset($_POST["precioSeleccionado"])) {
        $id = $_POST["id"];
        $precioSeleccionado = $_POST["precioSeleccionado"];

        // Guardar el precio seleccionado en la sesión
        $_SESSION['lista'][$id]->precioSeleccionado = $precioSeleccionado;

        echo "Precio seleccionado guardado en la sesión correctamente.";
    } else {
        echo "Parámetros no válidos.";
    }
} else {
    echo "Acceso no permitido.";
}
?>