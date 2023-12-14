<?php   
    include_once "funciones.php";
    session_start();
    
    if(isset($_POST['buscar'])){
        if(isset($_POST['codigo_o_nombre'])) {
            $codigo_o_nombre = $_POST['codigo_o_nombre'];
            
            // Verificar si es un número (código) o una cadena (nombre)
            if (is_numeric($codigo_o_nombre)) {
                $codigo = $codigo_o_nombre;
                $producto = obtenerProductoPorCodigo($codigo);
            } else {
                $nombre = $codigo_o_nombre;
                $producto = obtenerProductoPorNombre($nombre);
            }
            
            if(!$producto) {
                echo "
                <script type='text/javascript'>
                    alert('No se ha encontrado el producto');
                    window.location.href='vender.php';
                </script>";
                return;
            }
            
            if ($producto->existencia <= 0) {
                echo "
                <script type='text/javascript'>
                    alert('El producto está agotado');
                    window.location.href='vender.php';
                </script>";
                return;
            }
            
            print_r($producto);
            
            $_SESSION['lista'] = agregarProductoALista($producto,  $_SESSION['lista']);
            unset($_POST['codigo_o_nombre']);
            header("location: vender.php");
        }
    }
?>
