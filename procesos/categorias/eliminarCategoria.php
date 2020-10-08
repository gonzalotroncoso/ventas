<?php 

require_once "/storage/ssd1/013/8888013/public_html/clases/Conexion.php";

require_once "/storage/ssd1/013/8888013/public_html/clases/categorias.php";



$id = $_POST['idcategoria'];

$obj = new categorias();
echo $obj->eliminarCategoria($id);

 ?>