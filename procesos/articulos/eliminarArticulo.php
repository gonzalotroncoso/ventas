<?php 
include_once '../../clases/Articulos.php';
include_once '../../clases/Conexion.php';


   
$id = $_POST['idarticulo'];

$obj = new articulos();
echo $obj->eliminarArticulo($id)


 ?>