<?php 
session_start();

if (isset($_SESSION['usuario'])){


	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Articulos</title>
		<?php require_once "menu.php" ?>
		<?php require_once "../clases/Conexion.php";
		$c= new conectar();
		$dbh = $c->conexion(); 
		$stmt = $dbh->prepare("SELECT * FROM categorias ");
		$stmt->execute();

		?>
	</head>
	<body>
		

		
		<div class="container">
			<h1>Articulos</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmArticulos" enctype="multipart/form-data">
						<label>Categoria</label>
						<select class="form-control input-sm" id="categoriaSelect" name="categoriaSelect">
							<option value="A">Selecciona Categoria</option>
							<?php while ($unaFila = $stmt->fetch()): ?>
								<option value="<?php echo $unaFila['id_categoria'] ?>">  <?php echo $unaFila['nombreCategoria'] ?> </option>	
							<?php endwhile; ?>

						</select>
						<label>Nombre	</label>
						<input type="text" class="form-control input-sm" name="nombre" id="nombre">
						<label>Descripcion	</label>
						<input type="text" class="form-control input-sm" name="descripcion" id="descripcion">
						<label>Cantidad</label>
						<input type="text" class="form-control input-sm" name="cantidad" id="cantidad">
						<label>Precio	</label>
						<input type="text" class="form-control input-sm" name="precio" id="precio">
						<label>Imagen</label>
						<input type="file" id="imagen" name="imagen">
						<p></p>
						<span id="btnAgregarArticulo" class="btn btn-primary">AGREGAR</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaArticuloLoad"></div>
				</div>
			</div>
		</div>

		
		
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>




		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdateArticulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Actualiza Articulo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<form id="frmArticulosU" >
							<input type="text" hidden="" id="idarticulo" name="idarticulo">
							<input type="text" hidden="" id="idart" name="idart">
							<label>Categoria</label>
							<select class="form-control input-sm" id="categoriaSelectu" name="categoriaSelectu">
								<option value="A">Selecciona Categoria</option>


								<?php
								$c= new conectar();
								$dbh = $c->conexion(); 
								$stmt = $dbh->prepare("SELECT * FROM categorias ");
								$stmt->execute();


								while ($unaFila = $stmt->fetch()): ?>
									<option value="<?php echo $unaFila['id_categoria'] ?>">  <?php echo $unaFila['nombreCategoria'] ?> </option>	
								<?php endwhile; ?>

							</select>
							<label>Nombre	</label>
							<input type="text" class="form-control input-sm" name="nombreu" id="nombreu">
							<label>Descripcion	</label>
							<input type="text" class="form-control input-sm" name="descripcionu" id="descripcionu">
							<label>Cantidad</label>
							<input type="text" class="form-control input-sm" name="cantidadu" id="cantidadu">
							<label>Precio	</label>
							<input type="number" class="form-control input-sm" name="preciou" id="preciou">							
							<p></p>							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaArticulo"type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>	


	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaArticulo').click(function(){

				datos=$('#frmArticulosU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/articulos/actualizaArticulos.php",
					success:function(r){
						
						if(r==1){
							$('#tablaArticuloLoad').load("articulos/tablaArticulos.php");
							alertify.success('Datos actualizados');

						}else{
							alertify.error('No se pudo actualizar');
						}

					}
				});
			});



		});
	</script>

	<script type="text/javascript">
	
		function agregaDatosArticulo(idarticulo){
			$.ajax({
				type:"POST",
				data:"idart= "+ idarticulo,
				url:"../procesos/articulos/obtenDatosArticulo.php",
				success:function(r){
									
					datos=jQuery.parseJSON(r);
					$('#idarticulo').val(datos['id_producto']);
					$('#categoriaSelectu').val(datos['id_categoria']);
					$('#nombreu').val(datos['nombre']);
					$('#descripcionu').val(datos['descripcion']);
					$('#cantidadu').val(datos['cantidad']);
					$('#preciou').val(datos['precio']);

					


				}
			});

			


		}

		function eliminaArticulo(idArticulo){
			alertify.confirm('¿Desea eliminar este articulo?', function(){ 
				$.ajax({
					type:"POST",
					data:"idarticulo=" + idArticulo,
					url:"../procesos/articulos/eliminarArticulo.php",
					success:function(r){
										
						if(r==1){							
							alertify.success("Eliminado con exito!!");
							$('#tablaArticuloLoad').load("articulos/tablaArticulos.php");
						}else{
							alertify.error("No se pudo eliminar :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}

		
	
		</script>



		<script type="text/javascript">
			$(document).ready(function(){
				$('#tablaArticuloLoad').load("articulos/tablaArticulos.php");
				$('#btnAgregarArticulo').click(function(){
					vacios =  validarFormVacio('frmArticulos');
					if(vacios>0){
						alertify.alert("Debes llenar todos los campos")
						return false;
					}

					var formData = new FormData(document.getElementById("frmArticulos"));


					$.ajax({
						url: "../procesos/articulos/insertaArticulos.php",
						type: "post",
						dataType: "html",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,

						success:function(r){					

							if(r > 1){
								$('#frmArticulos')[0].reset();
								$('#tablaArticuloLoad').load('articulos/tablaArticulos.php');
								alertify.success("Agregado con exito :D");
							}else{
								alertify.error("Fallo al subir el archivo :(");
							}
						}
					});

				});


			});
		</script>

		<?php 
	}else{
		header("location:../index.php");
	}
	?>


	<?php 
/*
<select class="form-control input-sm" id="categoriaSelectU" name="categoriaSelectU">
								<option value="A">Selecciona Categoria</option>
								<?php 
								$sql="SELECT id_categoria,nombreCategoria
								from categorias";
								$result=mysqli_query($conexion,$sql);
								?>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
								<?php endwhile; ?>
							</select>
							*/
							?>							