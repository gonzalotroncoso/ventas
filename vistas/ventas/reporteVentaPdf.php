<?php 
require_once "../../clases/Conexion.php";

$idventa =   $_GET['idventa']; 

$c =  new conectar();
$dbh = $c->conexion();
$sql = "SELECT * from ventas where id_venta = :idventa";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':idventa',$idventa,PDO::PARAM_INT);
$stmt->execute();

//	echo "Cliente: ".$nombreCliente."<br>";
$nombreCliente=null;
$fechaCompra=null;
$folio=null;
echo"<h1>Reporte de venta</h1>";
echo "<table border="."1".">
			<tr>
				<td>Nombre</td>
				<td>Precio</td>
				<td>Cantidad</td>
				<td>Descripcion</td>
			</tr>";
while($reporte = $stmt->fetch()){	
	if(empty($folio)){
		$folio = $reporte['id_venta'];
		echo "Folio: ".$folio."<br>";
	}
	if(empty($nombreCliente)){
		$sql="SELECT nombre, apellido from clientes where id_cliente = :idcliente";
		$stmt1=$dbh->prepare($sql);
		$stmt1->bindValue(':idcliente',$reporte['id_cliente'],PDO::PARAM_INT);
		$stmt1->execute();
		$cliente =$stmt1->fetch();
		$nombreCliente =$cliente['nombre']." ".$cliente['apellido'];
		if(isset($cliente)){
		echo "Cliente: ".$nombreCliente."<br>";
		}else{
			echo  "Cliente: Sin Cliente"."<br>";
		}
	}
	if(empty($fechaCompra)){
		$fechaCompra =$reporte['fechaCompra'];
		echo "Fecha de Compra: ".$fechaCompra."<br>";

	}

	
	
	$sql="SELECT * FROM articulos where id_producto = :idproducto";
 	$stmt2 = $dbh->prepare($sql);
 	$stmt2->bindValue(':idproducto',$reporte['id_producto'],PDO::PARAM_INT);
 	$stmt2->execute();
 	$producto = $stmt2->fetch();
 	echo "<tr>";
 	echo "<td>".$producto['nombre']."</td>";
 	echo "<td>".$producto['precio']."</td>";
 	echo "<td>"."1"."</td>";
 	echo "<td>".$producto['descripcion']."</td>";
 	echo "</tr>";
 

}
	echo "</table>";

 ?>
 
 