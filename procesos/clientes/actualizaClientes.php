<?php 
include_once '../../clases/Clientes.php';
include_once '../../clases/Conexion.php';

$obj= new clientes();
$datos=array(
			 $_POST['id_cliente'],
			 $_POST['nombreu'],
			 $_POST['apellidou'],
			 $_POST['direccionu'],
			 $_POST['emailu'],
			 $_POST['telefonou'],			 
			 $_POST['rfcu']
			);



echo $obj->ActualizaCliente($datos);



 ?>