<?php 
require_once"../../clases/Conexion.php";
require_once"../../clases/Articulos.php";
 $idart=$_POST['idart'];
$obj = new articulos();
echo json_encode ($obj->obtenDatosArticulo($idart));

 ?>