<?php 

class articulos{

	public function agregaImagen($datos){
		$fecha = date('Y-m-d');
		$c =  new conectar();
		$dbh = $c->conexion();
		$sql = 'INSERT INTO imagenes ';
		$sql .='(id_categoria,
		nombre,
		ruta,
		fechaSubida) ';
		$sql .='VALUES (:id_categoria,
		:nombre,
		:ruta,
		:fechaSubida
	)';
	$stmt = $dbh->prepare($sql);	
	$stmt->bindValue(':id_categoria',$datos[0] , PDO::PARAM_INT);
	$stmt->bindValue(':nombre',$datos[1] , PDO::PARAM_STR);				
	$stmt->bindValue(':ruta',$datos[2],PDO::PARAM_STR);
	$stmt->bindValue(':fechaSubida',$fecha,PDO::PARAM_STR);
	$stmt->execute();
	return $dbh->lastInsertId(); 
}


public function insertaArticulo($datos){
	$fecha = date('Y-m-d');
	$c =  new conectar();
	$dbh = $c->conexion();
	$sql = 'INSERT INTO articulos';
	$sql .= '(id_categoria,
	id_imagen,
	id_usuario,
	nombre,
	descripcion,
	cantidad,
	precio,
	fechaCaptura)';
	$sql .= 'VALUES(:id_categoria,
	:id_imagen,
	:id_usuario,
	:nombre,
	:descripcion,
	:cantidad,
	:precio,					
	:fechaCaptura)';

	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(':id_categoria',$datos[0] , PDO::PARAM_INT);
	$stmt->bindValue(':id_imagen',$datos[1] , PDO::PARAM_INT);
	$stmt->bindValue(':id_usuario',$datos[2] , PDO::PARAM_INT);
	$stmt->bindValue(':nombre',$datos[3] , PDO::PARAM_STR);
	$stmt->bindValue(':descripcion',$datos[4] , PDO::PARAM_STR);
	$stmt->bindValue(':cantidad',$datos[5] , PDO::PARAM_INT);
	$stmt->bindValue(':precio',$datos[6] , PDO::PARAM_STR);	
	$stmt->bindValue(':fechaCaptura',$fecha , PDO::PARAM_INT);
	return $stmt->execute();						
}

public function obtenDatosArticulo($idarticulo){
	$c =  new conectar();
	$dbh = $c->conexion();
	$sql = "SELECT * FROM articulos where id_producto = :idarticulo";
	$stmt = $dbh->prepare($sql);	
	$stmt->bindValue(':idarticulo' ,$idarticulo , PDO::PARAM_INT);
	$stmt->execute();						
	$art = $stmt->fetch();
	$dato=array(
		"id_producto"=>$art['id_producto'],
		"id_categoria"=>$art['id_categoria'],
		"nombre"=>$art['nombre'],
		"descripcion"=>$art['descripcion'],
		"cantidad"=>$art['cantidad'],
		"precio"=>$art['precio']
	);
	return $dato;

}
public function actualizaArticulo($datos){
	$c =  new conectar();
	$dbh = $c->conexion();
	$sql = "UPDATE articulos SET 
	id_categoria = :id_categoria, nombre = :nombre, descripcion = :descripcion,
	cantidad = :cantidad , precio=:precio
	where id_producto = :id_producto";

	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(':id_categoria', $datos['1'], PDO::PARAM_INT);
	$stmt->bindValue(':nombre', $datos['2'], PDO::PARAM_STR);
	$stmt->bindValue(':descripcion', $datos['3'], PDO::PARAM_STR);
	$stmt->bindValue(':cantidad', $datos['4'], PDO::PARAM_INT);
	$stmt->bindValue(':precio', $datos['5'], PDO::PARAM_STR);
	$stmt->bindValue(':id_producto', $datos['0'], PDO::PARAM_INT);
	if($stmt->execute()){
		return true;

	}else {
		return false;
	}


	
}


public function eliminarArticulo($id){
	$c = new conectar();
	$dbh = $c->conexion();
	$id_imagen= self::obtenIdImagen($id);
	$consulta = 'DELETE FROM articulos';
	$consulta .= ' WHERE id_producto = :id_producto';
	$stmt = $dbh->prepare($consulta);
	$stmt->bindValue(':id_producto', $id, PDO::PARAM_INT);
	if($stmt->execute()){
		$ruta=self::obtenRutaImagen($id_imagen);
   		$consulta = 'DELETE FROM imagenes
		WHERE id_imagen = :id';
		$stmt=$dbh->prepare($consulta);
		$stmt->bindValue(':id',$id_imagen, PDO::PARAM_INT);
		if($stmt->execute()){
				if(unlink($ruta)){
					return 1;
				}//fin if unlink
			

		}//fin if execute boorar fila

	}//fin if execute borrar articulo


}//fin funcion eliminar articulo

public function obtenIdImagen($id){
	$c = new conectar();
	$dbh = $c->conexion();
	$sql = 'SELECT * FROM articulos where id_producto=:id ';
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$imagen = $stmt->fetch();
	return $imagen['id_imagen'];

}


public function obtenRutaImagen($idImg){
	$c= new conectar();
	$dbh=$c->conexion();

	$sql="SELECT ruta 	from imagenes where id_imagen=:idImg";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(':idImg', $idImg , PDO::PARAM_INT);
	$stmt->execute();
	$result= $stmt->fetch();

	return ($result['ruta']);

}


}//fin clase



?>




