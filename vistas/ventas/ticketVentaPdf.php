<?php 
require_once "/storage/ssd1/013/8888013/public_html/clases/Conexion.php";


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
echo '<style type="text/css">
		
@page {
            margin-top: 0.3em;
            margin-left: 0.6em;
        }
       body{
       		font-size: xx-small
       } 
	</style>';
echo"<p>Ticket de venta</p>";
$total = 0;
while($reporte = $stmt->fetch()){	
	if(empty($folio)){
		$folio = $reporte['id_venta'];
		echo "<p>Ticket nro: ".$folio."</p>";
	}
	if(empty($nombreCliente)){
		$sql="SELECT nombre, apellido from clientes where id_cliente = :idcliente";
		$stmt1=$dbh->prepare($sql);
		$stmt1->bindValue(':idcliente',$reporte['id_cliente'],PDO::PARAM_INT);
		$stmt1->execute();
		$cliente =$stmt1->fetch();
		$nombreCliente =$cliente['nombre']." ".$cliente['apellido'];
		if(isset($cliente)){
		echo "<p>Cliente: ".$nombreCliente."</p>";
		}else{
			echo  "<p>Cliente: Sin Cliente"."</p>";
		}
	}
	if(empty($fechaCompra)){
		$fechaCompra =$reporte['fechaCompra'];
		echo "<p>Fecha de Compra: ".$fechaCompra."</p>";

	}

	
	
	$sql="SELECT * FROM articulos where id_producto = :idproducto";
 	$stmt2 = $dbh->prepare($sql);
 	$stmt2->bindValue(':idproducto',$reporte['id_producto'],PDO::PARAM_INT);
 	$stmt2->execute();
 	$producto = $stmt2->fetch();
 	$total= $producto['precio']+$total;
 	echo "<p>Producto: ".$producto['nombre']."</p>";
 	echo "<p>Precio: ".$producto['precio']."</p>";
 	echo "<p>Cantidad: 1"."</p>";
 	
 

}
echo "Total: $".$total;



 ?>
 
 