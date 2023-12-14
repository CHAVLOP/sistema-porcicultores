<?php
// Configura la conexión a la base de datos (debes completar con tus propios datos).
$servername = "localhost";
$username = "root";
$password = "";
$database = "ventas_php";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener las categorías
$sql = "SELECT id_categoria, categoria FROM categorias";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $categorias = array();

    // Recorre los resultados y agrega cada categoría a un array
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }

    // Devuelve las categorías como un objeto JSON
    header('Content-Type: application/json');
    echo json_encode($categorias);
} else {
    echo "No se encontraron categorías";
}

// Cierra la conexión a la base de datos
$conn->close();
?>
