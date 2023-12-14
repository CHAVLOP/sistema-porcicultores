<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";

session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("location: login.php");
    exit();
}

$usuarios = obtenerUsuarios();

// Función para verificar la contraseña
function verificarContrasenaUniversal() {
    $contrasena = trim($_POST['contrasena']); // Obtén la contraseña proporcionada
    // Aquí puedes definir tu contraseña universal
    $contrasenaUniversal = "NewUserCreate"; // Reemplaza con tu contraseña real

    if ($contrasena === $contrasenaUniversal) {
        return true; // Contraseña correcta
    } else {
        return false; // Contraseña incorrecta
    }
}

?>

<div class="container">
    <h1>Usuarios</h1>
    <a class="btn btn-success btn-lg" href="agregar_usuario.php" onclick="return pedirContrasenaUniversal('agregar')">
        <i class="fa fa-plus"></i>
        Agregar
    </a>
    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($usuarios as $usuario) {
            ?>
                <tr>
                    <td><?php echo $usuario->usuario; ?></td>
                    <td><?php echo $usuario->nombre; ?></td>
                    <td><?php echo $usuario->telefono; ?></td>
                    <td><?php echo $usuario->direccion; ?></td>
                    <td>
                        <a class="btn btn-info" href="editar_usuario.php?id=<?php echo $usuario->id; ?>"
                            onclick="return pedirContrasenaUniversal('editar')">
                            <i class="fa fa-edit"></i>
                            Editar
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="eliminar_usuario.php?id=<?php echo $usuario->id; ?>"
                            onclick="return pedirContrasenaUniversal('eliminar')">
                            <i class="fa fa-trash"></i>
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src = "js/usuarios.js"></script>
