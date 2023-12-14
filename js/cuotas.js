$(document).ready(function() {
      
    function getFormattedDate() {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
  var yyyy = today.getFullYear();
  return dd + '/' + mm + '/' + yyyy;
}

// Agrega la fecha actual al final de la página de impresión
function addPrintDate() {
var date = getFormattedDate();
$('#fecha').text('Fecha de impresión: ' + date);
}

// Agrega un controlador de eventos al botón de impresión
$('#imprimirTablas').on('click', function() {
  // Oculta el botón de impresión antes de imprimir
  $(this).hide();

  // Agrega la fecha al final de la página de impresión
  addPrintDate();

  // Llama al método window.print() para imprimir la página actual
  window.print();

  // Muestra nuevamente el botón después de imprimir
  $(this).show();
});
    $('#miTabla1').DataTable({
      "paging": false,  // Deshabilitar paginación
      "searching": false,  // Deshabilitar búsqueda
      "info": false  // Deshabilitar información del número de registros
    });

    $('#miTabla2').DataTable({
      "paging": false,  // Deshabilitar paginación
      "searching": false,  // Deshabilitar búsqueda
      "info": false  // Deshabilitar información del número de registros
    });

    // Escuchar eventos de entrada en los campos de cuota y cantidad (Tabla 1)
    $('#miTabla1 .cuota, #miTabla1 .cantidad').on('input', function() {
      // Obtener los valores de cuota y cantidad
      var cuota = parseFloat($(this).closest('tr').find('.cuota').val()) || 0;
      var cantidad = parseFloat($(this).closest('tr').find('.cantidad').val()) || 0;
      
      // Calcular el total
      var total = cuota * cantidad;
      
      // Actualizar el campo de total en la misma fila
      $(this).closest('tr').find('.total').val(total);

      // Calcular la suma de la cantidad total (Tabla 1)
      var sumaCantidadTotal1 = 0;
      $('#miTabla1 .cantidad').each(function() {
        sumaCantidadTotal1 += parseFloat($(this).val()) || 0;
      });

      // Actualizar el campo de suma de cantidad total (Tabla 1)
      $('#totalCantidad1').val(sumaCantidadTotal1);

      // Calcular la suma total (Tabla 1)
      var sumaTotal1 = 0;
      $('#miTabla1 .total').each(function() {
        sumaTotal1 += parseFloat($(this).val()) || 0;
      });

      // Actualizar el campo de suma total (Tabla 1)
      $('#totalSuma1').val(sumaTotal1);
    });

    // Escuchar eventos de entrada en los campos de cuota y cantidad (Tabla 2)
    $('#miTabla2 .cuota, #miTabla2 .cantidad').on('input', function() {
      // Obtener los valores de cuota y cantidad
      var cuota = parseFloat($(this).closest('tr').find('.cuota').val()) || 0;
      var cantidad = parseFloat($(this).closest('tr').find('.cantidad').val()) || 0;
      
      // Calcular el total
      var total = cuota * cantidad;
      
      // Actualizar el campo de total en la misma fila
      $(this).closest('tr').find('.total').val(total);

      // Calcular la suma de la cantidad total (Tabla 2)
      var sumaCantidadTotal2 = 0;
      $('#miTabla2 .cantidad').each(function() {
        sumaCantidadTotal2 += parseFloat($(this).val()) || 0;
      });

      // Actualizar el campo de suma de cantidad total (Tabla 2)
      $('#totalCantidad2').val(sumaCantidadTotal2);

      // Calcular la suma total (Tabla 2)
      var sumaTotal2 = 0;
      $('#miTabla2 .total').each(function() {
        sumaTotal2 += parseFloat($(this).val()) || 0;
      });

      // Actualizar el campo de suma total (Tabla 2)
      $('#totalSuma2').val(sumaTotal2);
    });

    // ---------------------------------------------TABLA3---------------------------------------------------
    $('#miTabla3 .cuota, #miTabla3 .cantidad').on('input', function() {
      // Obtener los valores de cuota y cantidad
      var cuota = parseFloat($(this).closest('tr').find('.cuota').val()) || 0;
      var cantidad = parseFloat($(this).closest('tr').find('.cantidad').val()) || 0;
      
      // Calcular el total
      var total = cuota * cantidad;
      
      // Actualizar el campo de total en la misma fila
      $(this).closest('tr').find('.total').val(total);

      // Calcular la suma de la cantidad total (Tabla 2)
      var sumaCantidadTotal3 = 0;
      $('#miTabla3 .cantidad').each(function() {
        sumaCantidadTotal3 += parseFloat($(this).val()) || 0;
      });

      // Actualizar el campo de suma de cantidad total (Tabla 2)
      $('#totalCantidad3').val(sumaCantidadTotal3);

      // Calcular la suma total (Tabla 2)
      var sumaTotal3 = 0;
      $('#miTabla3 .total').each(function() {
        sumaTotal3 += parseFloat($(this).val()) || 0;
      });

      // Actualizar el campo de suma total (Tabla 2)
      $('#totalSuma3').val(sumaTotal3);
    });
    // ---------------------------------------------TABLA4---------------------------------------------------
    $('#miTabla4 .cuota, #miTabla4 .cantidad').on('input', function() {
      // Obtener los valores de cuota y cantidad
      var cuota = parseFloat($(this).closest('tr').find('.cuota').val()) || 0;
      var cantidad = parseFloat($(this).closest('tr').find('.cantidad').val()) || 0;
      
      // Calcular el total
      var total = cuota * cantidad;
      
      // Actualizar el campo de total en la misma fila
      $(this).closest('tr').find('.total').val(total);

      // Calcular la suma de la cantidad total (Tabla 2)
      var sumaCantidadTotal4 = 0;
      $('#miTabla4 .cantidad').each(function() {
        sumaCantidadTotal4 += parseFloat($(this).val()) || 0;
      });

      // Actualizar el campo de suma de cantidad total (Tabla 2)
      $('#totalCantidad4').val(sumaCantidadTotal4);

      // Calcular la suma total (Tabla 2)
      var sumaTotal4 = 0;
      $('#miTabla4 .total').each(function() {
        sumaTotal4 += parseFloat($(this).val()) || 0;
      });

      // Actualizar el campo de suma total (Tabla 2)
      $('#totalSuma4').val(sumaTotal4);
    });




    $('#limpiarTodo').on('click', function() {
      // Limpiar los campos de la Tabla 1
      $('#miTabla1 input[type="number"]').val('');
      $('#totalSuma1').val('');
      $('#totalCantidad1').val('');

      // Limpiar los campos de la Tabla 2
      $('#miTabla2 input[type="number"]').val('');
      $('#totalSuma2').val('');
      $('#totalCantidad2').val('');

      // Limpiar los campos de la Tabla 3
      $('#miTabla3 input[type="number"]').val('');
      $('#totalSuma3').val('');
      $('#totalCantidad3').val('');

      // Limpiar los campos de la Tabla 4
      $('#miTabla4 input[type="number"]').val('');
      $('#totalSuma4').val('');
      $('#totalCantidad4').val('');
  });

  });