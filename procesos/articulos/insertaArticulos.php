<?php 
session_start();
$iduser =$_SESSION['iduser'];
require_once'../../clases/Conexion.php';
require_once'../../clases/Articulos.php';
$obj = new articulos();

$_POST['categoriaSelect'];
$_POST['nombre'];
$_POST['descripcion'];
$_POST['cantidad'];
$_POST['precio'];


$nombreImg=$_FILES['imagen']['name'];
$rutaAlmacenamiento =$_FILES['imagen']['tmp_name'];
$carpeta= '../../archivos/';
$rutaFinal = $carpeta.$nombreImg;

$datosImg = array($_POST['categoriaSelect'],
					$nombreImg,
					$rutaFinal,
					);
if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
		echo $idimagen =$obj->agregaImagen($datosImg);
		if ($idimagen>0 ){
			$datos = array(
				$_POST['categoriaSelect'],
				$idimagen,
				$iduser,				
				$_POST['nombre'],
				$_POST['descripcion'],
				$_POST['cantidad'],
				$_POST['precio']				
				);
			echo $obj->insertaArticulo($datos);

		}
	}


 ?>
