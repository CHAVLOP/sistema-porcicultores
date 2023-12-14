$(document).ready(function() {
    cargarCategorias(); // Carga las categorías al cargar la página.

    function cargarCategorias() {
        // Realiza una solicitud AJAX para obtener las categorías desde tu base de datos.
        $.ajax({
            url: 'obtener_categorias.php', // Reemplaza esto con la URL de tu script PHP para obtener las categorías.
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var select = $("#categoria");
                select.empty(); // Limpia las opciones existentes.

                // Agrega la opción "Seleccione una categoría" por defecto.
                select.append($('<option>', {
                    value: '',
                    text: 'Seleccione una categoría'
                }));

                // Agrega una opción para cada categoría en los datos recibidos.
                $.each(data, function(index, categoria) {
                    select.append($('<option>', {
                        value: categoria.categoria, // Usa el nombre de la categoría como valor
                        text: categoria.categoria // Usa el nombre de la categoría como texto
                    }));
                });
            },
            error: function() {
                alert('Error al cargar las categorías');
            }
        });
    }

    // Agrega un evento de clic para quitar la selección de "Seleccione una categoría" cuando se haga clic en el campo.
    $("#categoria").on("click", function() {
        $(this).find("option:first").prop("selected", false);
    });
});