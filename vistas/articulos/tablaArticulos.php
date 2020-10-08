<?php 

require_once "/storage/ssd1/013/8888013/public_html/clases/Conexion.php";
$c = new conectar();
$dbh = $c->conexion();



$stmt = $dbh->prepare("SELECT art.nombre,
	art.descripcion,
	art.cantidad,
	art.precio,
	img.ruta,
	cat.nombreCategoria,
	art.id_producto
	FROM articulos as art
	inner join imagenes as img
	on art.id_imagen=img.id_imagen
	inner join categorias as cat
	on art.id_categoria =cat.id_categoria											
	");
$stmt->execute();

?>
<div class="table-wrapper-scroll-y">
<table class="table table-hover table-condensed table-border table table-bordered table-striped" style ="text-align: center;" >
	<caption><label>Articulos</label></caption>
	<tr>
		<td>Nombre</td>
		<td>Descripcion</td>
		<td>Cantidd</td>
		<td>Precio</td>
		<td>Imagen</td>
		<td>Categoria</td>
		<td>Editar</td>
		<td>Eliminar</td>	
	</tr>
	<?php while ($unaFila = $stmt->fetch()): ?>
		<tr>		
			<td><?php echo $unaFila['nombre'] ?></td>
			<td><?php echo $unaFila['descripcion'] ?></td>
			<td><?php echo $unaFila['cantidad'] ?></td>
			<td><?php echo $unaFila['precio'] ?></td>
			<td>
				<?php 
				$imgver= explode("/", $unaFila['ruta']);
				$imgruta=$imgver[1]."/".$imgver[2]."/".$imgver[3];
				?>
				<img src="<?php echo $imgruta ?>" width="80" height="80">

			</td>
			<td><?php echo $unaFila['nombreCategoria'] ?></td>
			<?php $id=$unaFila['id_producto'] ?>
			<td>
				<span data-toggle="modal" data-target="#abremodalUpdateArticulo" class="btn btn-warning btn-xs" onclick="agregaDatosArticulo('<?php echo $id; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
				<?php $idp=$unaFila['id_producto'] ?>
				<span  class="btn btn-danger btn-xs" onclick="eliminaArticulo('<?php echo $idp ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>

			</tr>
		<?php endwhile; ?>


	</table>
</div>