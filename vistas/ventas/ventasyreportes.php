<?php 
	require_once"../../clases/Conexion.php";
	require_once"../../clases/Ventas.php";
	$obj = new ventas();
	$sql = "SELECT * FROM ventas group by id_venta";
	$c= new conectar();
	$dbh=$c->conexion();
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

 ?>
<h4>Reportes y ventas</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-border" style ="text-align: center;">
				<caption><label>Ventas</label></caption>
				<tr>
					<td>Folio</td>
					<td>Fecha</td>
					<td>Cliente</td>
					<td>Total de compra</td>
					<td>Ticket</td>
					<td>Reporte</td>

				</tr>
				<?php while ($unaFila = $stmt->fetch()): ?>
				<tr>
					<td><?php echo $unaFila['id_venta'] ?></td>
					<td><?php echo $unaFila['fechaCompra'] ?></td>					
					<td>
					<?php 
							if($obj->nombreCliente($unaFila['id_cliente'])==" "){
								echo "S/C";
							}else{
								echo $obj->nombreCliente($unaFila['id_cliente']);
							}
						 ?>
					</td>
					<td><?php echo "$".$obj->obtenerTotal($unaFila['id_venta']) ?></td>
					<td><a href="../procesos/ventas/crearTicketPdf.php?idventa=<?php echo $unaFila['id_venta'] ?>"class="btn btn-danger btn-sm">Ticket <span class="glyphicon glyphicon-file"></span></a> </td>
					<td><a href="../procesos/ventas/crearReportePdf.php?idventa=<?php echo $unaFila['id_venta'] ?>" class="btn btn-danger btn-sm">Reporte <span class="glyphicon glyphicon-list-alt"></span></a></td>

				</tr>
			<?php endwhile; ?>
			</table>
		</div>

	</div>

	<div class="col-sm-1"></div>
</div>