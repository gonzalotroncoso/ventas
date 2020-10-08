<?php 

require_once "/storage/ssd1/013/8888013/public_html/clases/Conexion.php";
$c = new conectar();
$dbh = $c->conexion();



$stmt = $dbh->prepare("SELECT * FROM categorias");
$stmt->execute();


 ?>



<table class="table table-hover table-condensed table-border" style ="text-align: center;">
	<caption><label>Categorias</label></caption>
	<tr>
		<td>Categoria</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>
	<?php while ($unaFila = $stmt->fetch()): ?>
	<tr>		
		<td><?php echo $unaFila['nombreCategoria'] ?></td>
		<td>
			<?php $id = $unaFila['id_categoria']; ?>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizaCategoria" onclick="agregaDato('<?php echo $unaFila['id_categoria'] ?>', '<?php echo $unaFila['nombreCategoria'] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
				</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaCategoria('<?php echo $id; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>