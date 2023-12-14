<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el cliente';
    exit;
}
include_once "funciones.php";
$cliente = obtenerClientePorId($id);
?>

<div class="container">
    <h3>Editar cliente</h3>
    <form method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $cliente->nombre;?>" id="nombre" placeholder="Escribe el nombre del cliente">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="<?php echo $cliente->telefono;?>" id="telefono" placeholder="Ej. 2111568974">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="<?php echo $cliente->direccion;?>" id="direccion" placeholder="Ej. Av Collar 1005 Col Las Cruces">
        </div>

        <div class="mb-3">
    <label for="tipo_cliente" class="form-label">Tipo de Cliente</label>
    <select class="form-select" name="tipo_cliente" id="tipo_cliente">
        <?php
        // Obtén los tipos de cliente usando la función que creamos
        $tiposDeCliente = obtenerTiposDeCliente();
        foreach ($tiposDeCliente as $tipo) {
            // Verifica si el tipo de cliente actual es el seleccionado
            $selected = ($tipo['id_tipo'] == $cliente->tipo) ? 'selected' : '';

            echo '<option value="' . $tipo['id_tipo'] . '" ' . $selected . '>' . $tipo['tipos'] . '</option>';
        }
        ?>
    </select>

    <div class="mb-3">
    <label for="deuda" class="form-label">Total de deuda</label>
    <input type="text" name="deuda" class="form-control" value="<?php echo $cliente->deuda;?>" id="deuda" placeholder="ej. 1000$">
</div>
<div class="mb-3">
    <label for="credito" class="form-label">Credito disponible</label>
    <input type="text" name="credito" class="form-control" value="<?php echo $cliente->credito;?>" id="credito" placeholder="5000$">
</div>
</div>
<script src="js/editar_cliente.js"></script>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            <a href="clientes.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
        </div>
    </form>
</div>
<?php
if(isset($_POST['registrar'])){
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $tipo_cliente = $_POST['tipo_cliente'];
    $deuda = $_POST['deuda'];
    $credito = $_POST['credito'];
    if(empty($nombre) 
    || empty($telefono) 
    || empty($tipo_cliente)  
    || empty($direccion)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    include_once "funciones.php";
    $resultado = editarCliente($nombre, $telefono, $direccion, $tipo_cliente, $deuda, $credito, $id);

    if ($resultado) {
        echo '
        <script>
            alert("Información del cliente actualizada con éxito.");
            window.location.href = "clientes.php";
        </script>';
    } else {
        echo '
        <div class="alert alert-danger mt-3" role="alert">
            Hubo un error al actualizar la información del cliente.
        </div>';
    }
    
}
?>