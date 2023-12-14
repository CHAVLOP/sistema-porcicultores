function quitarProducto(id) {
    // Envía una solicitud AJAX para quitar el producto de la lista en la sesión PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "quitar_producto_venta.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Respuesta exitosa, recarga la página
            location.reload();
        }
    };
    xhr.send("id=" + id);
}

// Agrega un manejador de eventos para el botón "Quitar" en cada fila de la tabla
var botonesQuitar = document.querySelectorAll('button.btn-danger');
botonesQuitar.forEach(function (boton) {
    boton.addEventListener('click', function () {
        var productoId = this.parentElement.parentElement.getAttribute('data-id');
        quitarProducto(productoId);
    });
});