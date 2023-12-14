document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('codigo_o_nombre');
    const resultados = document.getElementById('resultados');

    input.addEventListener('input', function() {
        const query = input.value;

        // Realiza una solicitud AJAX para buscar productos en la base de datos
        $.ajax({
            type: 'POST',
            url: 'buscar_productos.php',
            data: { query: query },
            success: function(response) {
                resultados.innerHTML = response;
            }
        });
    });

    // Manejador de eventos para el doble clic en los resultados
    resultados.addEventListener('dblclick', function(e) {
        if (e.target.classList.contains('resultado')) {
            const nombreProducto = e.target.getAttribute('data-nombre');
            input.value = nombreProducto; // Rellena el campo de búsqueda con el nombre del producto
        }
    });

    // Manejador de eventos para el cambio de selección de precio
    document.addEventListener("change", function (e) {
        if (e.target.name === 'precioSeleccionado') {
            const productId = e.target.getAttribute('data-product-id');
            const cantidadInput = document.querySelector(`tr[data-id="${productId}"] input[name="cantidad"]`);
            cantidadInput.value = 0;
        }
    });
});