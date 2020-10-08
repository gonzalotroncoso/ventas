<?php 
class ventas{

	public function obtenDatosProducto($id){
		$c =  new conectar();
	$dbh = $c->conexion();
	$sql = "SELECT art.id_producto, art.nombre, art.descripcion, art.cantidad, img.ruta, art.precio FROM articulos as art inner join imagenes as img on art.id_imagen = img.id_imagen and art.id_producto = :idarticulo";
	$stmt = $dbh->prepare($sql);	
	$stmt->bindValue(':idarticulo' ,$id, PDO::PARAM_INT);
	$stmt->execute();						
	$art = $stmt->fetch();
	$imgver= explode("/", $art['ruta']);
	$imgruta=$imgver[1]."/".$imgver[2]."/".$imgver[3];


	$dato=array(
		"id_producto"=>$art['id_producto'],		
		"nombre"=>$art['nombre'],
		"descripcion"=>$art['descripcion'],
		"ruta"=>$imgruta,
		"cantidad"=>$art['cantidad'],
		"precio"=>$art['precio']
	);
	return $dato;


	}

public function crearVenta(){
	$c =  new conectar();
	$dbh = $c->conexion();
	$fecha = date('Y-m-d');
	$idventa=self::creaFolio();
	$datos=$_SESSION['tablaComprasTemp'];
	
	
	$r=0;
	for ($i=0; $i <count($datos) ; $i++) { 
		$d = explode("||", $datos[$i]);
		$sql ="INSERT INTO ventas 
				(id_venta, id_cliente, id_producto, id_usuario, precio, fechaCompra) values
					(:id_venta, :id_cliente, :id_producto, :id_usuario, :precio, :fechaCompra) ";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id_venta', $idventa, PDO::PARAM_INT);			
		$stmt->bindValue(':id_cliente',$d[5], PDO::PARAM_INT);			
		$stmt->bindValue(':id_producto', $d[0], PDO::PARAM_INT);			
		$stmt->bindValue(':id_usuario', $_SESSION ['iduser'], PDO::PARAM_INT);			
		$stmt->bindValue(':precio',$d[3] , PDO::PARAM_STR);			
		$stmt->bindValue(':fechaCompra', $fecha, PDO::PARAM_STR);
		$r = $r + $stmt->execute();
		self::descuentaCantidad($d[0],1);


		# code...
	}
	return $r;
}	
public function descuentaCantidad($idproducto,$cantidad){
	$c = new conectar();
	$dbh=$c->conexion();
	$sql="SELECT cantidad from articulos where id_producto=:idproducto";
	$stmt=$dbh->prepare($sql);
	$stmt->bindValue(':idproducto',$idproducto,PDO::PARAM_INT);
	$stmt->execute();
	$cantidad1 = $stmt->fetch();
	$cantidadNueva=abs($cantidad-$cantidad1['cantidad']);
	$sql2="UPDATE articulos set cantidad=:cantidad WHERE id_producto=:idproducto";
	$stmt1=$dbh->prepare($sql2);
	$stmt1->bindValue(':cantidad',$cantidadNueva,PDO::PARAM_INT);
	$stmt1->bindValue(':idproducto',$idproducto,PDO::PARAM_INT);
	$stmt1->execute();
}


public function creaFolio(){
	$c= new conectar();
		$dbh=$c->conexion();

		$sql="SELECT id_venta from ventas group by id_venta desc";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();	
		$unaFila = $stmt->fetch()[0];


		if($unaFila=="" or $unaFila==null or $unaFila==0){
			return 1;

		}else{
			return $unaFila + 1;
	
		}
	}

	public function nombreCliente($idcliente){

		$c = new conectar();
		$dbh = $c->conexion();
		$sql = "SELECT nombre, apellido FROM clientes where id_cliente=:idcliente";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':idcliente',$idcliente,PDO::PARAM_INT);
		$stmt->execute();
		$cliente =$stmt->fetch();	

		

		

		return $cliente['apellido']." ".$cliente['nombre'];
		
	}

	public function obtenerTotal($idventa){
		$c= new conectar();
		$dbh=$c->conexion();
		$sql="SELECT precio 
				from ventas 
				where id_venta='$idventa'";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':idcliente',$idventa,PDO::PARAM_INT);
		$stmt->execute();
		
		

		$total=0;

		while($ver=$stmt->fetch()){
			$total=$total + $ver['precio'];
		}

		return $total;
	}

}

 ?>