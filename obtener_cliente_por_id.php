<?php
// incluir funciones.php y configurar la conexión a la base de datos
include_once "funciones.php";

// Verificar que se reciba un ID válido
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $clienteId = $_GET["id"];
    
    // Llamar a la función obtenerClientePorId para obtener los datos del cliente
    $cliente = obtenerClientePorId($clienteId);
    
    if ($cliente) {
        // Devolver los datos del cliente en formato JSON
        header("Content-Type: application/json");
        echo json_encode($cliente);
    } else {
        // Manejar el caso en el que el cliente no se encuentre
        header("HTTP/1.0 404 Not Found");
        echo json_encode(array("error" => "Cliente no encontrado"));
    }
} else {
    // Manejar solicitudes incorrectas
    header("HTTP/1.0 400 Bad Request");
    echo json_encode(array("error" => "Solicitud incorrecta"));
}
?>
