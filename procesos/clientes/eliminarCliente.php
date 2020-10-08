<?php 

include_once '../../clases/Clientes.php';
include_once '../../clases/Conexion.php';


   
$id = $_POST['id_cliente'];

$obj = new clientes();
echo $obj->eliminarCliente($id)



 ?>