document.addEventListener("DOMContentLoaded", function () {
    var buscarUsuario = document.getElementById('buscarUsuario');
    var buscarCliente = document.getElementById('buscarCliente');
    var selectUsuario = document.getElementById('selectUsuario');
    var selectCliente = document.getElementById('selectCliente');

    var filterSelectOptions = function (select, filter) {
        var options = select.getElementsByTagName('option');
        for (var i = 0; i < options.length; i++) {
            var option = options[i];
            var text = option.textContent.toLowerCase();
            if (text.includes(filter)) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        }
    };

    buscarUsuario.addEventListener('input', function () {
        filterSelectOptions(selectUsuario, buscarUsuario.value.toLowerCase());
    });

    buscarCliente.addEventListener('input', function () {
        filterSelectOptions(selectCliente, buscarCliente.value.toLowerCase());
    });

    selectUsuario.addEventListener('change', function () {
        buscarUsuario.value = ''; // Limpia el campo de búsqueda al seleccionar un usuario
    });

    selectCliente.addEventListener('change', function () {
        buscarCliente.value = ''; // Limpia el campo de búsqueda al seleccionar un cliente
    });
});