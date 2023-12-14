<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if (empty($_SESSION['usuario'])) header("location: login.php");

$nombreProducto = (isset($_POST['nombreProducto'])) ? $_POST['nombreProducto'] : null;
$fechaInicio = (isset($_POST['fechaInicio'])) ? $_POST['fechaInicio'] : null;
$fechaFin = (isset($_POST['fechaFin'])) ? $_POST['fechaFin'] : null;
$productos = [];

if (isset($_POST['buscarProducto'])) {
 
    $sql = "SELECT * FROM productos WHERE 1";
    if (!empty($nombreProducto)) {
        $sql .= " AND nombre LIKE '%$nombreProducto%'";
    }
    if (!empty($fechaInicio)) {
        $sql .= " AND fecha_registro >= '$fechaInicio'";
    }
    if (!empty($fechaFin)) {
        $sql .= " AND fecha_registro <= '$fechaFin'";
    }
    $productos = obtenerProductosPersonalizada($sql);
} else {
    $productos = obtenerProductos();
}

$cartas = [
    ["titulo" => "No. Productos", "icono" => "fa fa-box", "total" => count($productos), "color" => "#3578FE"],
    ["titulo" => "Total productos", "icono" => "fa fa-shopping-cart", "total" => obtenerNumeroProductos(), "color" => "#4F7DAF"],
    ["titulo" => "Categorias", "icono" => "fa fa-money-bill", "total" => contarCategoriasRegistradas(), "color" => "#1FB824"],
    ["titulo" => "Ganancia", "icono" => "fa fa-wallet", "total" => "$" . calcularGananciaProductos(), "color" => "#D55929"],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/productos.css">
    
</head>
<body>
<div class="container mt-3 ">
    <h1>
        <a class="btn btn-success btn-lg no-imprimir" href="agregar_producto.php">
            <i class="fa fa-plus"></i>
            Agregar
        </a>
        Ingreso de productos
    </h1>
    <?php include_once "cartas_totales.php"; ?>

    <form action="" method="post" class="input-group mb-3 mt-3 no-imprimir">
        <input autofocus name="nombreProducto" type="text" class="form-control"
               placeholder="Escribe el nombre o código del producto que deseas buscar" aria-label="Nombre producto"
               aria-describedby="button-addon2">
        <input name="fechaInicio" type="date" class="form-control" placeholder="Fecha de inicio">
        <input name="fechaFin" type="date" class="form-control" placeholder="Fecha de fin">
        <button type="submit" name="buscarProducto" class="btn btn-primary" id="button-addon2">
            <i class="fa fa-search"></i>
            Buscar
        </button>
    </form>

    <button class="btn btn-primary no-imprimir" onclick="imprimirTabla()">
        <i class="fa fa-print"></i> Imprimir Tabla
    </button>

    <!-- Agregar un contenedor para centrar la tabla -->
    <div class="table-container">
        <table class="table center-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Presentacion</th>
                    <th>Precio compra</th>
                    <th>Precio venta</th>
                    <th>Precio por kilo</th>
                    <th>Precio por bulto</th>
                    <th>Precio por tonelada</th>
                    <th>Ganancia</th>
                    <th>Existencia</th>
                    <th>Fecha de ingreso</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($productos as $producto) {
                    // Verificar si la existencia es igual a cero y aplicar la clase CSS correspondiente
                    $existenciaClase = ($producto->existencia == 0) ? 'existencia-cero' : '';
                ?>
                    <tr class="<?= $existenciaClase; ?>">
                        <td><?= $producto->codigo; ?></td>
                        <td><?= $producto->nombre; ?></td>
                        <td><?= $producto->categoria; ?></td>
                        <td><?= $producto->presentacion; ?></td>
                        <td><?= '$' . $producto->compra; ?></td>
                        <td><?= '$' . $producto->venta; ?></td>
                        <td><?= '$' . $producto->precio_kilo; ?></td>
                        <td><?= '$' . $producto->precio_bulto; ?></td>
                        <td><?= '$' . $producto->precio_tonelada; ?></td>
                        <td><?= '$' . floatval($producto->venta - $producto->compra); ?></td>
                        <td><?= $producto->existencia; ?></td>
                        <td><?= $producto->fecha_registro; ?></td>
                        <td>
                            <a class="btn btn-info" href="editar_producto.php?id=<?= $producto->id; ?>">
                                <i class="fa fa-edit"></i>
                                Editar
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-danger" data-nombre="<?= htmlspecialchars($producto->nombre); ?>" onclick="confirmarEliminar(<?= $producto->id; ?>)">
                                <i class="fa fa-trash"></i>
                                Eliminar
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/productos.js"></script>
</body>
</html>
