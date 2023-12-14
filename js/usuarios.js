function pedirContrasenaUniversal(accion) {
    var contrasena = prompt("Ingresa la contraseña:");
    if (contrasena === null || contrasena === "") {
        return false;
    }

    // Realiza la verificación de la contraseña
    if (verificarContrasenaUniversal()) {
        if (accion === 'agregar') {
            // Realiza la acción de agregar usuario
            window.location.href = "agregar_usuario.php";
        } else if (accion === 'editar') {
            // Realiza la acción de edición
            return true;
        } else if (accion === 'eliminar') {
            // Realiza la acción de eliminación
            return true;
        }
    } else {
        // La contraseña es incorrecta, muestra un mensaje de error
        alert("Contraseña incorrecta. Inténtalo de nuevo.");
    }

    return false;
}