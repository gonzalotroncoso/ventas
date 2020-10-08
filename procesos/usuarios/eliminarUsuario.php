<?php 

include_once '../../clases/Usuarios.php';
include_once '../../clases/Conexion.php';


   
$id = $_POST['idusuario'];

$obj = new usuarios();
echo $obj->eliminarUsuario($id)



 ?>