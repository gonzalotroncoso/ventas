<?php 
include_once '../../clases/Articulos.php';
include_once '../../clases/Conexion.php';

$obj= new articulos();
$datos=array(
			 $_POST['idarticulo'],
			 $_POST['categoriaSelectu'],
			 $_POST['nombreu'],
			 $_POST['descripcionu'],
			 $_POST['cantidadu'],
			 $_POST['preciou']
			);



echo $obj->actualizaArticulo($datos);



 ?>