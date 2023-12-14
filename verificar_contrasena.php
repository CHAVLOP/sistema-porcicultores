<?php

// Recibe los datos enviados por la solicitud AJAX
$idUsuario = $_POST['idUsuario'];
$contrasena = $_POST['contrasena'];
$accion = $_POST['accion'];

// Conecta a la base de datos (reemplaza con tu configuración)
$mysqli = new mysqli("localhost", "root", "", "ventas_php");

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Consulta la base de datos para obtener la contraseña del usuario
$query = "SELECT admin_contra FROM usuarios WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$stmt->bind_result($contrasena_db);
$stmt->fetch();
$stmt->close();

// Verifica si la contraseña proporcionada coincide con la almacenada en la base de datos
if ($contrasena === $contrasena_db) {
    echo "ok"; // Contraseña correcta
} else {
    echo "error"; // Contraseña incorrecta
}

// Cierra la conexión a la base de datos
$mysqli->close();
?>