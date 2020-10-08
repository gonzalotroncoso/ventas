<?php 
session_start();

if (isset($_SESSION['usuario'])){


	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Categorias</title>
		<?php require_once "menu.php" ?>		
	</head>
	<body>
		<div class="container">
			<h1>Categorias</h1>
			<div class=row>
				<div class="col-sm-4">
					<form id="frmCategoria">
						<label>Cateogria</label>
						<input type="text" class="form-control input-sm" name="categoria" id="cateogria">
						<p></p>
						<span class="btn btn-primary" id="btnAgregaCategoria">Agregar</span>
					</form>
				</div>
				<div class="col-sm-6">
					<div id="tableCategoriaLoad"></div>
				</div>
			</div>

		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza categorias</h4>
					</div>
					<div class="modal-body">
						<form id="frmCategoriaU">
							<input type="text"  id="idcategoria" hidden=""  name="idcategoria" >
							<label>Categoria</label>
							<input type="text" name="categoriaU" id="categoriaU" class="form-control input-sm">

						</form>

					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Guardar</button>

					</div>
				</div>
			</div>
		</div>


	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#tableCategoriaLoad').load("categorias/tabla_categorias.php");

			$('#btnAgregaCategoria').click(function(){
				vacios=validarFormVacio('frmCategoria');
				if(vacios>0){
					alertify.alert("Debes llenar todos los campos");
					return false;
				}


				datos=$('#frmCategoria').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/categorias/agregaCategoria.php",
					success:function(r){
						if(r==1){
							$('#frmCategoria')[0].reset();
							$('#tableCategoriaLoad').load("categorias/tabla_categorias.php");
							alertify.success("Categoria agregada con exito");
						}else{
							alert(r);
							alertify.error("No se pudo agregar categoria");
						}

					}
				})		

			});


		})
	</script>

	<script type="text/javascript">


		function agregaDato(idCategoria, categoria){
			$('#idcategoria').val(idCategoria);
			$('#categoriaU').val(categoria);

		}
		function eliminaCategoria(idcategoria){
			alertify.confirm('Desea eliminar esta categoria?', function(){
				$.ajax({
					type:"POST",
					data:"idcategoria=" +idcategoria ,
					url:"../procesos/categorias/eliminarCategoria.php",
					success:function(r){

						if (r==1){
							$('#tableCategoriaLoad').load("categorias/tabla_categorias.php");
							alertify.success("Eliminado con exito");
						}else{
							alertify.error("No se pudo eliminar");
							
						}

					}
				});
			},
			function(){ 
				alertify.error('Cancelo!')});


		}



	</script>
	<script type="text/javascript">

		$(document).ready(function(){

			$('#btnActualizaCategoria').click(function(){

				datos=$('#frmCategoriaU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/categorias/actualizaCategoria.php",
					success:function(r){
						if (r==1){
							$('#tableCategoriaLoad').load("categorias/tabla_categorias.php")
							alertify.success("Categoria actualizada");

						}else {
							alertify.error("Fallo la actualización");
						}

					}
				});
			});


		})

	</script>


	<?php 
}else{
	header("location:../index.php");
}

?>