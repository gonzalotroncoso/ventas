<?php 
require_once "/storage/ssd1/013/8888013/public_html/clases/Conexion.php";

$c = new conectar();
$dbh = $c->conexion();

$stmt = $dbh->prepare("SELECT * FROM usuarios");
$stmt->execute();



 ?>

<table class="table table-hover table-condensed table-border" style ="text-align: center;">
	<caption><label>Usuarios</label></caption>
	<tr>
		<td>Nombre</td>
		<td>Apellido</td>
		<td>Usuario</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>
	<?php while ($unaFila = $stmt->fetch()): ?>
	<tr>
		<td><?php echo $unaFila['nombre'] ?></td>
		<td><?php echo $unaFila['apellido'] ?></td>
		<td><?php echo $unaFila['email'] ?></td>		
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalUpdateUsuario" onclick="agregaDatosUsuario('<?php echo $unaFila['id_usuario'] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
				</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaUsuario('<?php echo $unaFila['id_usuario'] ?>')">
				<span class="glyphicon glyphicon-remove" ></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>
