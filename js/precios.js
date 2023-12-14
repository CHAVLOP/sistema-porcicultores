function actualizarPrecio(id) {
    var select = document.querySelector('tr[data-id="' + id + '"] select[name="precioSeleccionado"]');
    var precioSeleccionado = select.value;
    var cantidad = parseFloat(document.querySelector('tr[data-id="' + id + '"] input[name="cantidad"]').value);
    var precioKilo = parseFloat(<?php echo json_encode($lista->precio_kilo); ?>);
    var precioBulto = parseFloat(<?php echo json_encode($lista->precio_bulto); ?>);
    var precioTonelada = parseFloat(<?php echo json_encode($lista->precio_tonelada); ?>);
    var venta = parseFloat(<?php echo json_encode($lista->venta); ?>);

    switch (precioSeleccionado) {
        case "precio_kilo":
            var subtotal = cantidad * precioKilo;
            break;
            case "venta":
            var subtotal = cantidad * venta;
            break;
        case "precio_bulto":
            var subtotal = cantidad * precioBulto;
            break;
        case "precio_tonelada":
            var subtotal = cantidad * precioTonelada;
            break;
        default:
            var subtotal = 0;
    }
}

function actualizarCantidad(id, nuevaCantidad) {
    if (nuevaCantidad <= 0) {
        quitarProducto(id);
    } else {
        var select = document.querySelector('tr[data-id="' + id + '"] select[name="precioSeleccionado"]');
        var precioSeleccionado = select.value;
        var precioKilo = parseFloat(<?php echo json_encode($lista->precio_kilo); ?>);
        var precioBulto = parseFloat(<?php echo json_encode($lista->precio_bulto); ?>);
        var precioTonelada = parseFloat(<?php echo json_encode($lista->precio_tonelada); ?>);
        var venta = parseFloat(<?php echo json_encode($lista->venta); ?>);

        switch (precioSeleccionado) {
            case "precio_kilo":
                var subtotal = nuevaCantidad * precioKilo;
                break;
                case "venta":
                var subtotal = nuevaCantidad * venta;
                break;
            case "precio_bulto":
                var subtotal = nuevaCantidad * precioBulto;
                break;
            case "precio_tonelada":
                var subtotal = nuevaCantidad * precioTonelada;
                break;
            default:
                var subtotal = 0;
        }
// Comprobar si la cantidad ingresada es mayor a la existencia
var existencia = parseFloat(<?php echo json_encode($lista->existencia); ?>);

if (nuevaCantidad > existencia) {
// Mostrar un mensaje de error
alert("¡Solo hay " + existencia + " unidades en existencia!");

// Restaurar la cantidad al valor máximo de existencia
document.querySelector('tr[data-id="' + id + '"] input[name="cantidad"]').value = existencia;

// No actualices nada más
return;
}

document.getElementById('subtotal_' + id).textContent = '$' + subtotal.toFixed(2);

// Actualizar la cantidad en la lista de productos en la sesión
actualizarCantidadEnSesion(id, nuevaCantidad);

    }
}

function actualizarCantidadEnSesion(id, nuevaCantidad) {
    // Envía una solicitud AJAX para actualizar la cantidad en la sesión PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "actualizar_cantidad_en_sesion.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Respuesta exitosa, no es necesario hacer nada aquí
        }
    };
    xhr.send("id=" + id + "&cantidad=" + nuevaCantidad);
}



function quitarCliente() {
    // Envía una solicitud AJAX para quitar el cliente de la sesión PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "quitar_cliente_en_sesion.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Respuesta exitosa, recarga la página
            location.reload();
        }
    };
    xhr.send();
}