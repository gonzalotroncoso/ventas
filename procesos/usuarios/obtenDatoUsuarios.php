<?php 

require_once "/storage/ssd1/013/8888013/public_html/clases/Conexion.php";

require_once "/storage/ssd1/013/8888013/public_html/clases/Usuarios.php";

 $idusr=$_POST['idusuario'];
$obj = new  usuarios();
echo json_encode ($obj->obtenDatosUsuarios($idusr));



 ?>