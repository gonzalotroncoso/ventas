<?php 
session_start();
require_once "/storage/ssd1/013/8888013/public_html/clases/Conexion.php";

require_once "/storage/ssd1/013/8888013/public_html/clases/categorias.php";
$fecha =date("Y-m-d");
$idusuario= $_SESSION ['iduser'];
$categoria=$_POST['categoria'];
$datos=array(
			$idusuario,
			$categoria,
			$fecha

			);
$obj = new categorias();
echo $obj->agregaCategoria($datos);
 ?>