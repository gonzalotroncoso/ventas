<?php 

require_once "/storage/ssd1/013/8888013/public_html/clases/Conexion.php";

require_once "/storage/ssd1/013/8888013/public_html/clases/Usuarios.php";


$id = $_POST['idusuario'];
$nombre =$_POST['nombreu'];
$apellido =$_POST['apellidou'];
$usr=$_POST['usuariou'];

$datos = array($id,$nombre,$apellido,$usr);

$obj = new usuarios();
echo $obj->actualizaUsuario($datos);


 ?>