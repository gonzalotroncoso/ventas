<?php 
class clientes{


	public function registroClientes($datos){

		$c = new conectar();
		$dbh = $c->conexion();
		



			$consulta = 'INSERT INTO clientes';
			$consulta .= ' (id_usuario, nombre,	apellido, direccion, email,	telefono,rfc)';
			$consulta .= ' VALUES ';
			$consulta .= '(	:id_usuario, :nombre,:apellido, :direccion,	:email, :telefono, :rfc)';
			$stmt = $dbh->prepare($consulta);
			$stmt->bindValue(':id_usuario', $datos[0], PDO::PARAM_INT);
			$stmt->bindValue(':nombre', $datos[1], PDO::PARAM_STR);
			$stmt->bindValue(':apellido', $datos[2], PDO::PARAM_STR);
			$stmt->bindValue(':direccion', $datos[3], PDO::PARAM_STR);
			$stmt->bindValue(':email', $datos[4],PDO::PARAM_STR);
			$stmt->bindValue(':telefono', $datos[5],PDO::PARAM_INT);
			$stmt->bindValue(':rfc', $datos[6],PDO::PARAM_STR);

			 
			 if ($stmt->execute()){
			 	return 1;
			 }else{
			 	return $dbh->errorInfo();
			 }



	}


public function obtenDatosCliente($id)	{
	$c =  new conectar();
	$dbh = $c->conexion();
	$sql = "SELECT * FROM clientes where id_cliente = :id";
	$stmt = $dbh->prepare($sql);	
	$stmt->bindValue(':id' ,$id , PDO::PARAM_INT);
	$stmt->execute();						
	$art = $stmt->fetch();
	$dato=array(
		"id_cliente"=>$art['id_cliente'],		
		"nombre"=>$art['nombre'],
		"apellido"=>$art['apellido'],
		"direccion"=>$art['direccion'],
		"email"=>$art['email'],
		"telefono"=>$art['telefono'],
		"rfc"=>$art['rfc']		
	);
	return $dato;

}


public function ActualizaCliente($datos){
	$c =  new conectar();
	$dbh = $c->conexion();
	$sql = "UPDATE clientes SET 
	nombre = :nombre, apellido = :apellido,
	direccion = :direccion , email=:email, telefono = :telefono, rfc =:rfc
	where id_cliente = :id_cliente";

	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(':id_cliente', $datos['0'], PDO::PARAM_INT);
	$stmt->bindValue(':nombre', $datos['1'], PDO::PARAM_STR);
	$stmt->bindValue(':apellido', $datos['2'], PDO::PARAM_STR);
	$stmt->bindValue(':direccion', $datos['3'], PDO::PARAM_STR);
	$stmt->bindValue(':email', $datos['4'], PDO::PARAM_STR);
	$stmt->bindValue(':telefono', $datos['5'], PDO::PARAM_INT);
	$stmt->bindValue(':rfc', $datos['6'], PDO::PARAM_STR);
	if($stmt->execute()){
		return true;

	}else {
		return false;
	}


	
}

public function eliminarCliente($id){

		$c = new conectar();
		$dbh = $c->conexion();
		$consulta = "DELETE FROM clientes
					 WHERE id_cliente = :id_cliente";
		$stmt = $dbh->prepare($consulta);
		$stmt->bindValue(':id_cliente', $id, PDO::PARAM_INT);
		return $stmt->execute();

	

}



}



 ?>