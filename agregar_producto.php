<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

?>
<div class="container">
    <h3>Agregar producto</h3>
    <form method="post">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código del producto</label>
            <input type="text" name="codigo" class="form-control" id="codigo" placeholder="Escribe el código del producto">
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre o descripción</label>
            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ej. Papas">
        </div>
        
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select name="categoria" class="form-control" id="categoria">
                <option value="">Seleccione una categoría</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="presentacion" class="form-label">Presentacion</label>
            <input type="text" name="presentacion" class="form-control" id="presentacion" placeholder="Ej. Pellet">
        </div>
        <div class="row">
            <div class="col">
                <label for="compra" class="form-label">Precio compra</label>
                <input type="number" name="compra" step="any" id="compra" class="form-control" placeholder="Precio de compra" aria-label="">
            </div>
            <div class="col">
                <label for="venta" class="form-label">Precio venta</label>
                <input type="number" name="venta" step="any" id="venta" class="form-control" placeholder="Precio de venta" aria-label="">
            </div>
            <div class="col">
                <label for="kilo" class="form-label">Precio por kilo</label>
                <input type="number" name="kilo" step="any" id="kilo" class="form-control" placeholder="Precio por kilo" aria-label="">
            </div>
            <div class="col">
                <label for ="bulto" class="form-label">Precio por bulto</label>
                <input type="number" name="bulto" step="any" id="bulto" class="form-control" placeholder="Precio por bulto" aria-label="">
            </div>
            <div class="col">
                <label for="tonelada" class="form-label">Precio por tonelada</label>
                <input type="number" name="tonelada" step="any" id="tonelada" class="form-control" placeholder="Precio por tonelada" aria-label="">
            </div>
            <div class="col">
                <label for="existencia" class="form-label">Existencia</label>
                <input type="number" name="existencia" step="any" id="existencia" class="form-control" placeholder="Existencia" aria-label="">
            </div>
         
            <label for="fecha_registro">Fecha de ingreso:</label>
            <input type="date" id="fecha_registro" name="fecha_registro">

        </div>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">

            </input>
            <a class="btn btn-danger btn-lg" href="productos.php">
                <i class="fa fa-times"></i>
                Cancelar
            </a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/agregar_producto.js"></script>

<?php
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
    if(empty($codigo)
    || empty($nombre)
    || empty($categoria)
    || empty($presentacion)
    || empty($fecha_registro)
    || empty($existencia)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos. 
        </div>';
        return;
    }

    include_once "funciones.php";
    $resultado = registrarProducto($codigo, $nombre, $categoria, $presentacion, $compra, $venta, $kilo, $bulto, $tonelada, $existencia, $fecha_registro);
    if ($resultado) {
        echo '
            <script>
                // Mostrar un cuadro de diálogo de alerta
                alert("Información del producto registrada con éxito.");
                
                // Redirigir a otra página cuando el usuario haga clic en "Aceptar"
                window.location.href = "productos.php";
            </script>';
    }

}
?>
