<?php
// Archivo buscar_cliente.php

// Incluye la configuración de tu conexión a la base de datos


if (isset($_POST['consulta'])) {
    $consulta = $_POST['consulta'];

    // Conecta a la base de datos (debes configurar tu propia conexión)
    $conexion = new mysqli("localhost", "root", "", "ventas_php");

    // Verifica si hay errores de conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Escapa la consulta para evitar inyección SQL
    $consulta = $conexion->real_escape_string($consulta);

    // Realiza una consulta SQL para buscar clientes que coincidan con la consulta
    $sql = "SELECT nombre FROM clientes WHERE nombre LIKE '%$consulta%'";

    // Ejecuta la consulta
    $resultado = $conexion->query($sql);

    // Verifica si hay resultados
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            // Imprime los resultados como opciones desplegables
            echo "<div class='opcion' onclick='seleccionarCliente(\"" . $fila['nombre'] . "\")'>" . $fila['nombre'] . "</div>";
        }
    } else {
        // Si no se encontraron resultados
        echo "<div class='opcion'>No se encontraron clientes.</div>";
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>
