<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";
	$id =$_POST['idproducto'];
	$venta = new ventas();
	echo json_encode ($venta->obtenDatosProducto($id));



 ?>