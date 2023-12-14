<?php
include_once "funciones.php"; // Incluye el archivo con las funciones de acceso a la base de datos

if (isset($_POST['query'])) {
    $query = $_POST['query'];

    // Realiza una conexión a la base de datos (reemplaza con tus propios datos de conexión)
    $conn = mysqli_connect("localhost", "root", "", "ventas_php");

    if (!$conn) {
        die("Error en la conexión a la base de datos: " . mysqli_connect_error());
    }

    // Escapa la consulta para evitar inyección SQL (mejor aún, considera usar sentencias preparadas)
    $query = mysqli_real_escape_string($conn, $query);

    // Realiza una consulta a la base de datos para buscar productos que coincidan con la query
    $sql = "SELECT nombre FROM productos WHERE nombre LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
           // Modifica la parte del archivo PHP que genera los resultados
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="resultado" data-nombre="' . $row['nombre'] . '">' . $row['nombre'] . '</div>';
}

        } else {
            echo 'No se encontraron resultados';
        }
    } else {
        echo 'Error en la consulta: ' . mysqli_error($conn);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conn);
}
?>
