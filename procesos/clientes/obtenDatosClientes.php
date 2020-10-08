<?php 
require_once"../../clases/Conexion.php";
require_once"../../clases/Clientes.php";
 $idcliente=$_POST['id_cliente'];
$obj = new clientes();
echo json_encode ($obj->obtenDatosCliente($idcliente));

 ?>