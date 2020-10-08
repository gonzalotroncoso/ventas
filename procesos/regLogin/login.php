<?php 
session_start();
require_once"../../clases/Conexion.php";
require_once "../../clases/Usuarios.php";

$obj= new usuarios();
$datos=array($_POST['usuario'],
			$_POST['Password']);


echo $obj->loginUser($datos);

 

 ?>