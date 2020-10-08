<?php 
require_once "/storage/ssd1/013/8888013/public_html/clases/categorias.php";
require_once "/storage/ssd1/013/8888013/public_html/clases/Conexion.php";



$id = $_POST['idcategoria'];
$nombre =$_POST['categoriaU'];
$datos = array($id,$nombre);

$obj = new categorias();
echo $obj->actualizaCategoria($datos);

 ?>