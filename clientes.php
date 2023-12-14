<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if (empty($_SESSION['usuario'])) header("location: login.php");

$clientes = obtenerClientesConTipo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <title></title>
    <link rel="stylesheet" href="css/clientes.css">
</head>
<body>
<div class="container">
    <h1 class="encabezado">
        <a class="btn btn-success btn-lg no-imprimir" href="agregar_cliente.php">
            <i class="fa fa-plus"></i>
            Agregar
        </a>
        Clientes
    </h1>

    <!-- Caja de selección para el filtro -->
    <div class="form-group">
        <label for="filtroClientes" class="no-imprimir">Filtrar clientes:</label>
        <select id="filtroClientes" class="form-control no-imprimir">
            <option value="todos">Mostrar todos los clientes</option>
            <option value="limite">Mostrar solo clientes que superaron el límite de crédito</option>
        </select>
    </div>

    <!-- Campo de búsqueda automática -->
    <div class="form-group">
        <label for="busquedaClientes" class="no-imprimir">Buscar cliente:</label>
        <input type="text" id="busquedaClientes" class="form-control no-imprimir" placeholder="Ingrese el nombre del cliente">
    </div>

    <!-- Botón de "Imprimir Reporte" -->
    <button id="imprimirReporte" class="btn btn-primary no-imprimir" onclick="imprimirTabla()">Imprimir Reporte</button>

    <table id="tablaClientes" class="table">
    <thead>
        <tr>
            <th><strong>Nombre Completo</strong></th>
            <th><strong>Teléfono</strong></th>
            <th><strong>Dirección</strong></th>
            <th><strong>Tipo de cliente</strong></th>
            <th><strong>Deuda</strong></th>
            <th><strong>Límite de crédito</strong></th>
            <th><strong>Estado</strong></th> <!-- Nueva columna para el estado -->
            <th><strong class="no-imprimir">Editar</strong></th>
            <th><strong class="no-imprimir">Eliminar</strong></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($clientes as $cliente) {
            // Comprueba si la deuda es mayor que el crédito
            $deuda = floatval($cliente->deuda);
            $credito = floatval($cliente->credito);

            // Agrega un texto de estado
            $estado = ($deuda > $credito) ? 'Límite de crédito superado' : 'Dentro del límite de crédito';

            // Define una clase CSS para resaltar la fila en rojo si el límite de crédito se ha superado
            $filaClass = ($deuda > $credito) ? 'text-danger' : '';

        ?>
            <tr class="<?php echo $filaClass; ?>">
                <td><strong><?php echo $cliente->nombre; ?></strong></td>
                <td><strong><?php echo $cliente->telefono; ?></strong></td>
                <td><strong><?php echo $cliente->direccion; ?></strong></td>
                <td><strong><?php echo $cliente->tipo_cliente; ?></strong></td>
                <td><strong>$<?php echo number_format($deuda, 2); ?></strong></td> <!-- Agrega "$" y formato de número -->
                <td><strong>$<?php echo number_format($credito, 2); ?></strong></td> <!-- Agrega "$" y formato de número -->
                <td>
                    <div style="padding: 5px; border: 2px solid red; background-color: pink;">
                        <?php echo $estado; ?>
                    </div>
                </td> <!-- Columna de estado con borde y fondo rojo -->
                <td class="no-imprimir"><strong>
                    <a class="btn btn-info" href="editar_cliente.php?id=<?php echo $cliente->id; ?>">
                        <i class="fa fa-edit"></i>
                        Editar
                    </a>
                </strong></td>
                <td class="no-imprimir">
    <strong>
        <button class="btn btn-danger eliminar-cliente" data-cliente-id="<?php echo $cliente->id; ?>">
            <i class="fa fa-trash"></i>
            Eliminar
        </button>
    </strong>
</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Agregar un elemento modal al cuerpo del documento -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalContent"></div>
    </div>
</div>
<script src="js/clientes.js"></script>
</body>
</html>
