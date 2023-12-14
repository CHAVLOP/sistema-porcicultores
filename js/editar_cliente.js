document.addEventListener("DOMContentLoaded", function () {
    var deudaInput = document.getElementById("deuda");
    var creditoInput = document.getElementById("credito");

    deudaInput.addEventListener("input", function () {
        var value = this.value.replace(/[^0-9]/g, ""); // Elimina caracteres no numéricos
        this.value = numberWithCommas(value);
    });

    creditoInput.addEventListener("input", function () {
        var value = this.value.replace(/[^0-9]/g, ""); // Elimina caracteres no numéricos
        this.value = numberWithCommas(value);
    });

    // Función para agregar comas a los números
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
});