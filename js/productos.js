function confirmarEliminar(productoId) {
    const nombreProducto = event.target.getAttribute('data-nombre');

    Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Deseas eliminar el producto "${nombreProducto}"?`, // Usar el nombre del producto en el mensaje
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirigir para eliminar el producto si el usuario confirma
            window.location.href = `eliminar_producto.php?id=${productoId}`;
        }
    });
}
function imprimirTabla() {
    // Ocultar las columnas "Editar" y "Eliminar" antes de imprimir
    var columnasEditarEliminar = document.querySelectorAll('.table th:nth-last-child(-n+2), .table td:nth-last-child(-n+2)');
    columnasEditarEliminar.forEach(function (columna) {
        columna.style.display = 'none';
    });

    // Imprimir la página actual
    window.print();

    // Mostrar nuevamente las columnas "Editar" y "Eliminar" después de imprimir
    columnasEditarEliminar.forEach(function (columna) {
        columna.style.display = ''; // Restaurar la visualización predeterminada
    });
}