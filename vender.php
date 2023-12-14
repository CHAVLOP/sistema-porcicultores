<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();
if (empty($_SESSION['usuario'])) header("location: login.php");
$_SESSION['lista'] = (isset($_SESSION['lista'])) ? $_SESSION['lista'] : [];
$total = calcularTotalLista($_SESSION['lista'], 'venta'); // Valor predeterminado 'precio_kilo'
$clientes = obtenerClientes();
$clienteSeleccionado = (isset($_SESSION['clienteVenta'])) ? obtenerClientePorId($_SESSION['clienteVenta']) : null;

// Función para actualizar la cantidad de un producto en la lista

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ventas</title>
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-3">
    <form action="agregar_producto_venta.php" method="post" class="row">
        <div class="col-10">
            <input class="form-control form-control-lg" name="codigo_o_nombre" id="codigo_o_nombre" type="text" placeholder="Ingresa el Código o Nombre del producto" aria-label="codigoBarrasNombre">
            <div id="resultados" class="mt-2"></div>
        </div>
        <div class="col">
            <input type="submit" value="Buscar" name="buscar" class="btn btn-success mt-2">
        </div>
    </form>
</div>
<?php if ($_SESSION['lista']) { ?>
    <div class="container mt-3">
    <table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Código</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Quitar</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($_SESSION['lista'] as $lista) { ?>
        <tr data-id="<?php echo $lista->id; ?>">
            <td><?php echo $lista->codigo; ?></td>
            
            <td><?php echo $lista->nombre; ?></td>
            <td>
                <?php
                $precioSeleccionado = property_exists($lista, 'precioSeleccionado') ? $lista->precioSeleccionado : 'venta';
                ?>
                <select name="precioSeleccionado" onchange="actualizarPrecio(<?php echo $lista->id; ?>); actualizarSubtotal(<?php echo $lista->id; ?>)">
                    <option value="precio_kilo" <?php if ($precioSeleccionado == "precio_kilo") echo "selected"; ?>>$<?php echo number_format($lista->precio_kilo, 2); ?> por Kilo</option>
                    <option value="venta" <?php if ($precioSeleccionado == "venta") echo "selected"; ?>>$<?php echo number_format($lista->venta, 2); ?> venta</option>
                    <option value="precio_bulto" <?php if ($precioSeleccionado == "precio_bulto") echo "selected"; ?>>$<?php echo number_format($lista->precio_bulto, 2); ?> por Bulto</option>
                    <option value="precio_tonelada" <?php if ($precioSeleccionado == "precio_tonelada") echo "selected"; ?>>$<?php echo number_format($lista->precio_tonelada, 2); ?> por Tonelada</option>
                </select>
            </td>

            <td>

                <input type="number" name="cantidad" value="<?php echo $lista->cantidad; ?>" onchange="actualizarCantidad(<?php echo $lista->id; ?>, this.value)">
            </td>

            <td><span id="subtotal_<?php echo $lista->id; ?>"><?php echo number_format($lista->cantidad * $lista->{$precioSeleccionado}, 2); ?></span></td>
            <td>
                <!-- Botón para quitar el producto de la lista -->
                <button class="btn btn-danger" onclick="quitarProducto(<?php echo $lista->id; ?>)">
                    <i class="fa fa-times"></i>
                </button>
              <script src="js/quitar_producto.js"></script>
            </td>
        </tr>
    <?php } ?>
</tbody>

</table>
<div class="text-center mt-2">
    <button class="btn btn-primary float-right" id="calcularSubtotalBtn">Calcular TOTAL</button>
</div>
<script src="js/btnTotal.js"></script>
<br>
<br>
<form class="row" method="post" action="establecer_cliente_venta.php">
    <div class="col-10">
        <input class="form-control mt-2" type="text" id="buscarCliente" placeholder="Buscar cliente...">
    </div>
    <div class="col-10">
        <select class="form-select" aria-label="Default select example" name="idCliente" id="clienteSelect">
            <option selected value="">Selecciona el cliente</option>
            <?php foreach ($clientes as $cliente) { ?>
                <option value="<?php echo $cliente->id; ?>"><?php echo $cliente->nombre; ?></option>
            <?php } ?>
        </select>
        </div>
        
        <div class="col-2">
            <input class="btn btn-info mt-1" type="submit" value="Seleccionar cliente">
        </div>
    </div>
    </form>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const inputBuscarCliente = document.getElementById('buscarCliente');
    const selectCliente = document.getElementById('clienteSelect');
    const clientes = <?php echo json_encode($clientes); ?>; // Convierte la lista de clientes a un objeto JavaScript

    inputBuscarCliente.addEventListener('input', function() {
        const query = inputBuscarCliente.value.toLowerCase(); // Convierte la búsqueda a minúsculas

        // Filtra los clientes en función de la búsqueda
        const resultados = clientes.filter(cliente => cliente.nombre.toLowerCase().includes(query));

        // Actualiza el select con los resultados filtrados
        selectCliente.innerHTML = '<option selected value="">Selecciona el cliente</option>';
        resultados.forEach(cliente => {
            const option = document.createElement('option');
            option.value = cliente.id;
            option.textContent = cliente.nombre;
            selectCliente.appendChild(option);
        });
    });
});
</script>
    <?php if ($clienteSeleccionado) { ?>
    <?php if ($clienteSeleccionado->credito < $total) { ?>
        <!-- El cliente ha superado su límite de crédito -->
        <div class="alert alert-danger" role="alert">El cliente ha superado su límite de crédito. No se puede completar la venta.</div>
    <?php } else { ?>
        <!-- Permitir que la venta se complete -->
        <div class="alert alert-success" role="alert">Venta completada con éxito.</div>
    <?php } ?>

    <div class="alert alert-primary mt-3" role="alert">
        <b>Cliente seleccionado: </b>
        <br>
        <b>Nombre: </b> <?php echo $clienteSeleccionado->nombre; ?><br>
        <b>Teléfono: </b> <?php echo $clienteSeleccionado->telefono; ?><br>
        <b>Dirección: </b> <?php echo $clienteSeleccionado->direccion; ?><br>
        <b>Deuda:</b> $<?php echo $clienteSeleccionado->deuda; ?><br>
        <b>DCredito:</b> $<?php echo $clienteSeleccionado->deuda; ?><br>
        <button class="btn btn-warning" onclick="quitarCliente()">Quitar</button>
    </div>
    <?php } ?>

    <div class="text-center mt-3">
        <h1>Total: <span id="total"><?php echo '$' . number_format($total, 2, '.', ','); ?></span></h1>
        <a class="btn btn-primary btn-lg" id="terminarVentaBtn" href="registrar_venta.php">
            <i class="fa fa-check"></i>
            Terminar venta
        </a>
        <a class="btn btn-danger btn-lg" href="cancelar_venta.php">
            <i class="fa fa-times"></i>
            Cancelar
        </a>
    </div>
</div>
<?php } ?>
<script src="js/seleccionar_prooducto.js"></script>
<script>
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

   
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
