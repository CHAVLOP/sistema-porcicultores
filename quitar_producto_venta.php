<?php
session_start();
$id = $_POST['id'];
$productos = $_SESSION['lista'];

foreach ($productos as $key => $producto) {
	if($producto->id == $id){
		unset($productos[$key]);
	}
}

$_SESSION['lista'] = $productos;
header("location: vender.php");
?>