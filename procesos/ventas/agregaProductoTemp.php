<?php 
		session_start();
		require_once "../../clases/Conexion.php";
		$idcliente= $_POST['clienteVenta'];
		$idproducto=$_POST['ProductoVenta'];
		$descripcion=$_POST['descripcionV'];
		$cantidad = $_POST['cantidadV'];
		$precio = $_POST['precioV'];

		$c = new conectar();
		$dbh = $c->conexion();
		$sql = "SELECT nombre, apellido FROM clientes where id_cliente=:idcliente";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':idcliente',$idcliente,PDO::PARAM_INT);
		$stmt->execute();

		$cliente =$stmt->fetch();
		
		$sql ="SELECT nombre from articulos where id_producto = :id_producto";
		$stmt2 = $dbh->prepare($sql)	;
		$stmt2->bindValue('id_producto',$idproducto,PDO::PARAM_INT);
		$stmt2->execute();

		$producto = $stmt2->fetch();

		$articulo = $idproducto."||".$producto['nombre']."||".$descripcion."||".$precio."||".$cliente['nombre']."||".$idcliente;
		$_SESSION['tablaComprasTemp'][]=$articulo;



?>