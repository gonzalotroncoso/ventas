<?php 
session_start();

if (isset($_SESSION['usuario'])){


	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Usuarios</title>
		<?php require_once "menu.php" ?>
	</head>
	<body>
		<div class="container">
			<h1>Administrar Usuarios</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmRegistro">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellido" name="apellido">
						<label>Usuario</label>
						<input type="text" class="form-control input-sm" id="usuario" name="usuario">
						<label>Password</label>
						<input type="password" class="form-control input-sm" id="password" name="password">							
						<p></p>
						<span class="btn btn-primary" id="registro">Registrar</span>						
					</form>
				</div>
			<div class="col-sm-7" id="tablaUsuarioLoad"></div>

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
		<div class="modal fade" id="abremodalUpdateUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Actualiza Usuario</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<form id="frmUsuarioU" >
							<input type="text" hidden="" id="idusuario" name="idusuario">												
							<label>Nombre	</label>
							<input type="text" class="form-control input-sm" name="nombreu" id="nombreu">
							<label>Apellido	</label>
							<input type="text" class="form-control input-sm" name="apellidou" id="apellidou">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuariou" id="usuariou">
							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaUsuario"type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>	


	</body>
	</html>

<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaUsuario').click(function(){

				datos=$('#frmUsuarioU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/actualizaUsuarios.php",
					success:function(r){
					
						if(r==1){
								$('#tablaUsuarioLoad').load("usuarios/tablausuario.php");
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
			function agregaDatosUsuario(idusuario){
			$.ajax({
				type:"POST",
				data:"idusuario="+ idusuario,
				url:"../procesos/usuarios/obtenDatoUsuarios.php",
				success:function(r){		
			
					datos=jQuery.parseJSON(r);
					$('#idusuario').val(datos['id_usuario']);
					$('#nombreu').val(datos['nombre']);
					$('#apellidou').val(datos['apellido']);
					$('#usuariou').val(datos['email']);
				}
			});
		}

			function eliminaUsuario(idusuario){
			alertify.confirm('Desea eliminar este usuario?', function(){
				$.ajax({
					type:"POST",
					data:"idusuario=" +idusuario ,
					url:"../procesos/usuarios/eliminarUsuario.php",
					success:function(r){
						

						if (r==1){
							$('#tablaUsuarioLoad').load("usuarios/tablausuario.php");
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
			$('#tablaUsuarioLoad').load("usuarios/tablausuario.php");


			$('#registro').click(function(){
				datos = validarFormVacio('frmRegistro');		
				if (datos>0){
					alertify.alert('Completar todos los campos');
					return false;
				}


				datos=$('#frmRegistro').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/regLogin/registrarUsuario.php",
					success:function(r){					
						if(r==1){
							$('#tablaUsuarioLoad').load("usuarios/tablausuario.php");
							alertify.success("Agregado con exito");
						}else{

						alertify.error("fallo al agregar");
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