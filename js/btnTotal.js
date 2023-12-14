document.addEventListener('DOMContentLoaded', function() {
    // Obtén una referencia al botón "Calcular Subtotal"
    var calcularSubtotalBtn = document.getElementById('calcularSubtotalBtn');

    // Agrega un manejador de eventos al hacer clic en el botón
    calcularSubtotalBtn.addEventListener('click', function() {
        // Obtén todos los elementos de la tabla que contienen la información del producto
        var filasProductos = document.querySelectorAll('table tbody tr');

        // Inicializa el total en 0
        var total = 0;

        // Itera a través de las filas de productos para calcular el subtotal de cada uno
        filasProductos.forEach(function(fila) {
            var cantidadInput = fila.querySelector('input[name="cantidad"]');
            var precioSeleccionado = fila.querySelector('select[name="precioSeleccionado"]').value;

            // Obtén el precio y la cantidad
            var precio = parseFloat(fila.querySelector('select[name="precioSeleccionado"] option[value="' + precioSeleccionado + '"]').textContent.replace('$', '').replace(',', ''));
            var cantidad = parseFloat(cantidadInput.value);

            // Calcula el subtotal
            var subtotal = precio * cantidad;

            // Actualiza el subtotal en la fila de la tabla
            fila.querySelector('span[id^="subtotal_"]').textContent = '$' + subtotal.toFixed(2);

            // Agrega el subtotal al total
            total += subtotal;
        });

        // Actualiza el elemento HTML que muestra el total
        document.getElementById('total').textContent = '$' + total.toFixed(2);
    });
});