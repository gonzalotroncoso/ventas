<?php 
class categorias{
	public function agregaCategoria($datos){
		$c = new conectar();
		$dbh = $c->conexion();

		$consulta = 'INSERT INTO categorias';
		$consulta .= ' (id_usuario, nombreCategoria, fechaCaptura)';
		$consulta .= ' VALUES ';
		$consulta .= '(:id_usuario, :nombreCategoria, :fechaCaptura)';
		$stmt = $dbh->prepare($consulta);
		$stmt->bindValue(':id_usuario',$datos[0] , PDO::PARAM_STR);
		$stmt->bindValue(':nombreCategoria', $datos[1],
			PDO::PARAM_STR);
		$stmt->bindValue(':fechaCaptura', $datos[2],
			PDO::PARAM_STR);
		return $stmt->execute();

	}

	public function actualizaCategoria($datos){
		$c = new conectar();
		$dbh = $c->conexion();
		
		$consulta = 'UPDATE categorias';
		$consulta .= ' SET nombreCategoria = :nombre';
		$consulta .= ' WHERE id_categoria = :id';
		$stmt = $dbh->prepare($consulta);
		$stmt->bindValue(':nombre', $datos[1], PDO::PARAM_INT);
		$stmt->bindValue(':id', $datos[0], PDO::PARAM_INT);
		
		return $stmt->execute();

	}	
	public function eliminarCategoria($id){

		$c = new conectar();
		$dbh = $c->conexion();
		$consulta = 'DELETE FROM categorias';
		$consulta .= ' WHERE id_categoria = :id_categoria';
		$stmt = $dbh->prepare($consulta);
		$stmt->bindValue(':id_categoria', $id, PDO::PARAM_INT);
		if ($stmt->execute()){
			return true;
		}else {
			return $dbh->errorInfo();


		}

		
	}

}

?>