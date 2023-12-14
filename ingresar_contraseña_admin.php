<?php
session_start();

if (isset($_POST['admin_password']) && $_POST['admin_password'] === 'tu_contraseña_de_administrador') {
    $_SESSION['admin_authenticated'] = true;
    header('Location: index.php'); // Redirige a la página principal
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresa la Contraseña de Administrador</title>
    <link rel="stylesheet" href="tu_estilo.css">
</head>
<body>
<div class="container">
    <h1>Ingresa la Contraseña de Administrador</h1>
    <form method="post">
        <input type="password" name="admin_password" placeholder="Contraseña de administrador" required>
        <input type="submit" value="Ingresar">
    </form>
</div>
</body>
</html>
