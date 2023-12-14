document.addEventListener("DOMContentLoaded", function () {
    const filtroClientes = document.getElementById("filtroClientes");
    const rows = document.querySelectorAll("tbody tr");
    const busquedaClientes = document.getElementById("busquedaClientes");
    const imprimirReporte = document.getElementById("imprimirReporte");
    const tablaClientes = document.getElementById("tablaClientes");

    filtroClientes.addEventListener("change", function () {
        const filtro = filtroClientes.value;
        aplicarFiltro(filtro);
    });

    busquedaClientes.addEventListener("input", function () {
        const filtro = filtroClientes.value;
        const busqueda = busquedaClientes.value.trim().toLowerCase();

        rows.forEach(function (row) {
            if (filtro === "todos" || (filtro === "limite" && row.classList.contains("text-danger"))) {
                const nombreCliente = row.querySelector("td:nth-child(1)").textContent.trim().toLowerCase();
                if (nombreCliente.includes(busqueda)) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            }
        });
    });

    function aplicarFiltro(filtro) {
        rows.forEach(function (row) {
            if (filtro === "todos" || (filtro === "limite" && row.classList.contains("text-danger"))) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const filtroClientes = document.getElementById("filtroClientes");
    const rows = document.querySelectorAll("tbody tr");
    const busquedaClientes = document.getElementById("busquedaClientes");
    const imprimirReporte = document.getElementById("imprimirReporte");
    const tablaClientes = document.getElementById("tablaClientes");

    filtroClientes.addEventListener("change", function () {
        const filtro = filtroClientes.value;
        aplicarFiltro(filtro);
    });

    busquedaClientes.addEventListener("input", function () {
        const filtro = filtroClientes.value;
        const busqueda = busquedaClientes.value.trim().toLowerCase();

        rows.forEach(function (row) {
            if (filtro === "todos" || (filtro === "limite" && row.classList.contains("text-danger"))) {
                const nombreCliente = row.querySelector("td:nth-child(1)").textContent.trim().toLowerCase();
                if (nombreCliente.includes(busqueda)) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            }
        });
    });

    function aplicarFiltro(filtro) {
        rows.forEach(function (row) {
            if (filtro === "todos" || (filtro === "limite" && row.classList.contains("text-danger"))) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }

const eliminarButtons = document.querySelectorAll(".eliminar-cliente");
    eliminarButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            const clienteId = button.getAttribute("data-cliente-id");

            // Llamar a la función obtenerClientePorId para obtener los datos del cliente
            fetch("obtener_cliente_por_id.php?id=" + clienteId)
                .then(response => response.json())
                .then(cliente => {
                    const nombreCliente = cliente.nombre;

                    // Mostrar un mensaje de confirmación con SweetAlert2
                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: `¿Deseas eliminar al cliente "${nombreCliente}"?`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si el usuario confirma la eliminación, redirigir a eliminar_cliente.php con el ID del cliente
                            window.location.href = `eliminar_cliente.php?id=${clienteId}`;
                        }
                    });
                });
        });
    });
});

// Función para imprimir la tabla
function imprimirTabla() {
    window.print();
}