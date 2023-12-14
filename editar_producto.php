<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el producto';
    exit;
}
include_once "funciones.php";
$producto = obtenerProductoPorId($id);



if(isset($_POST['registrar'])){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $presentacion = $_POST['presentacion'];
    $compra = $_POST['compra'];
    $venta = $_POST['venta'];
    $kilo = $_POST['kilo'];
    $bulto = $_POST['bulto'];
    $tonelada = $_POST['tonelada'];
    $existencia = $_POST['existencia'];
    $fecha_registro = $_POST['fecha_registro'];
    
    // Inicializar una variable para rastrear si se encontraron campos vacíos
    $camposVacios = false;

    // Comprobar si algún campo está vacío
    if(empty($codigo)
    || empty($nombre)
    || empty($categoria)
    || empty($presentacion)
    || empty($fecha_registro )
    || empty($existencia)){
        $camposVacios = true;
    }

    // Mostrar mensaje de error si se encontraron campos vacíos
    if ($camposVacios) {
        echo '
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
    } else {
        include_once "funciones.php";
        $resultado = editarProducto($codigo, $nombre, $categoria, $presentacion, $compra, $venta, $kilo, $bulto, $tonelada, $existencia,$fecha_registro, $id);
        if ($resultado) {
            echo '
                <script>
                    // Mostrar un cuadro de diálogo de alerta
                    alert("La Información del producto se actualizó con ÉXITO.");


                    // Redirigir a otra página cuando el usuario haga clic en "Aceptar"
                    window.location.href = "productos.php";
                </script>';
        }
    }
}
?>

<div class="container">
    <h3>Editar producto</h3>
    <form method="post" onsubmit="return validarFormulario();">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código del producto</label>
            <input type="text" name="codigo" class="form-control" value="<?php echo $producto->codigo;?>" id="codigo" placeholder="Escribe el código de barras del producto">
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre o descripción</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $producto->nombre;?>" id="nombre" placeholder="Ej. Papas">
        </div>
        <div class="mb-3">
    <label for="categoria" class="form-label">Categoria</label>
    <select name="categoria" class="form-control" id="categoria">
        <option value=""><?php echo $producto->categoria;?></option>
        
    </select>
</div>
        <div class="mb-3">
            <label for="presentacion" class="form-label">Presentacion</label>
            <input type="text" name="presentacion" class="form-control" value="<?php echo $producto->presentacion;?>" id="presentacion" placeholder="Ej. Pellet">
        </div>
        <div class="row">
            <div class="col">
                <label for="compra" class="form-label">Precio compra</label>
                <input type="number" name="compra" step="any" value="<?php echo $producto->compra;?>" id="compra" class="form-control" placeholder="Precio de compra" aria-label="">
            </div>
            <div class="col">
                <label for="kilo" class="form-label">Precio por kilo</label>
                <input type="number" name="kilo" step="any" value="<?php echo $producto->precio_kilo;?>" id="kilo" class="form-control" placeholder="Precio por kilo" aria-label="">
            </div>
            <div class="col">
                <label for ="bulto" class="form-label">Precio por bulto</label>
                <input type="number" name="bulto" step="any" value="<?php echo $producto->precio_bulto;?>" id="bulto" class="form-control" placeholder="Precio por bulto" aria-label="">
            </div>
            <div class="col">
                <label for="tonelada" class="form-label">Precio por tonelada</label>
                <input type="number" name="tonelada" step="any" value="<?php echo $producto->precio_tonelada;?>" id="tonelada" class="form-control" placeholder="Precio por tonelada" aria-label="">
            </div>
            <div class="col">
                <label for="venta" class="form-label">Precio venta</label>
                <input type="number" name="venta" step="any" value="<?php echo $producto->venta;?>" id="venta" class="form-control" placeholder="Precio de venta" aria-label="">
            </div>
            <div class="col">
                <label for="existencia" class="form-label">Existencia</label>
                <input type="number" name="existencia" step="any" value="<?php echo $producto->existencia;?>" id="existencia" class="form-control" placeholder="Existencia" aria-label="">
            </div>
            <label for="fecha_registro">Fecha de ingreso:</label>
            <input type="date" id="fecha_registro" name="fecha_registro" value="<?php echo $producto->fecha_registro;?>">


            
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            <a href="productos.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
<scrip src="js/editar_producto.js"></script>

