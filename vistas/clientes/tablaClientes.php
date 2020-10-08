<?php 

    $dsn = 'mysql:dbname=id8888013_ventas;host=localhost';
    $usuario = 'id8888013_gonzalo';
    $contrasenia = '12837gonzalo';
    $dbh = new PDO($dsn,$usuario, $contrasenia);;



$stmt = $dbh->prepare("SELECT * FROM clientes");
$stmt->execute();

 ?>


<table class="table table-responsive table-hover table-condensed table-border" style ="text-align: center;">
	<caption><label>Clientes</label></caption>
	<tr>
		<td>Nombre</td>
		<td>Apellido</td>
		<td>Direccion</td>
		<td>Email</td>
		<td>Telefono</td>
		<td>RFC</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>
	<?php while ($unaFila = $stmt->fetch()): ?>
	<tr>
		<td><?php echo $unaFila['nombre'] ?></td>
		<td><?php echo $unaFila['apellido'] ?></td>
		<td><?php echo $unaFila['direccion'] ?></td>
		<td><?php echo $unaFila['email'] ?></td>
		<td><?php echo $unaFila['telefono'] ?></td>
		<td><?php echo $unaFila['rfc'] ?></td>
		<td>
			<span class="btn btn-warning btn-xs"data-toggle="modal" data-target="#actualizaCliente" onclick="agregaDatosClientes('<?php echo $unaFila['id_cliente'] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
				</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaCliente('<?php echo $unaFila['id_cliente'] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
	<?php endwhile; ?>


</table>