<?php 
	session_start();

	if (isset($_SESSION['usuario'])){


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Clientes</title>
	<?php require_once "menu.php" ?>
</head>
<body>
	<div class="container">
		<h1>Clientes</h1>
		<div class="row">
			<div class="col-sm-4">
			<form id="frmClientes">

				<label>Nombre</label>
				<input type="text" class="form-control input-sm" id="nombre" name="nombre">
				<label>Apellido</label>
				<input type="text" class="form-control input-sm" id="apellido" name="apellido">
				<label>Direccion</label>
				<input type="text" class="form-control input-sm" id="direccion" name="direccion">
				<label>Email</label>
				<input type="text" class="form-control input-sm" id="email" name="email">
				<label>Telefono</label>
				<input type="text" class="form-control input-sm" id="telefono" name="telefono">
				<label>RFC</label>
				<input type="text" class="form-control input-sm" id="rfc" name="rfc">
				<p></p>
				<span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>


			</form>







			</div>
		<div class="col-sm-8" id="tablaClientesLoad"></div>	

		</div>

	</div>


<?php //////////////////////////////////////////////////////////////////////////// ?>
<?php //////////////////////////////////////////////////////////////////////////// ?>
<?php //////////////////////////////////////////////////////////////////////////// ?>
<?php //////////////////////////////////////////////////////////////////////////// ?>
<?php //////////////////////////////////////////////////////////////////////////// ?>
<?php //////////////////////////////////////////////////////////////////////////// ?>
<?php //////////////////////////////////////////////////////////////////////////// ?>
<?php //////////////////////////////////////////////////////////////////////////// ?>
<?php //////////////////////////////////////////////////////////////////////////// ?>
<?php //////////////////////////////////////////////////////////////////////////// ?>



<div class="modal fade" id="actualizaCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClienteU">
							<input type="text"  id="id_cliente" hidden=""  name="id_cliente" >
							<label>Nombre</label>
							<input type="text" name="nombreu" id="nombreu" class="form-control input-sm">
							<label>Apellido</label>
							<input type="text" name="apellidou" id="apellidou" class="form-control input-sm">
							<label>Direccion</label>
							<input type="text" name="direccionu" id="direccionu" class="form-control input-sm">
							<label>Mail</label>
							<input type="text" name="emailu" id="emailu" class="form-control input-sm">
							<label>Telefono</label>
							<input type="text" name="telefonou" id="telefonou" class="form-control input-sm">
							<label>UFC</label>
							<input type="text" name="rfcu" id="rfcu" class="form-control input-sm">

						</form>

					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizaCliente" class="btn btn-warning" data-dismiss="modal">Guardar</button>

					</div>
				</div>
			</div>
		</div>


</body>
</html>



<script type="text/javascript">
		function agregaDatosClientes(id_cliente){
			$.ajax({
				type:"POST",
				data:"id_cliente= "+ id_cliente,
				url:"../procesos/clientes/obtenDatosClientes.php",
				success:function(r){					
							
					datos=jQuery.parseJSON(r);
					$('#id_cliente').val(datos['id_cliente']);
					$('#nombreu').val(datos['nombre']);
					$('#apellidou').val(datos['apellido']);
					$('#direccionu').val(datos['direccion']);
					$('#emailu').val(datos['email']);
					$('#telefonou').val(datos['telefono']);
					$('#rfcu').val(datos['rfc']);

					


				}
			});

			


		}

		function eliminaCliente(id_cliente){
			alertify.confirm('¿Desea eliminar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"id_cliente=" + id_cliente,
					url:"../procesos/clientes/eliminarCliente.php",
					success:function(r){
										
						if(r==1){							
							alertify.success("Eliminado con exito!!");
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
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






</script>


<script type="text/javascript">
		$(document).ready(function(){
	$('#tablaClientesLoad').load("clientes/tablaClientes.php");

	$('#btnAgregarCliente').click(function(){
		vacios=validarFormVacio('frmClientes');
		if(vacios>0){
			alertify.alert("Debes llenar todos los campos");
			return false;
		}

	
		datos=$('#frmClientes').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"../procesos/clientes/agregaClientes.php",
			
			success:function(r){
				
				if(r==1){
					$('#frmClientes')[0].reset();
					$('#tablaClientesLoad').load("clientes/tablaClientes.php");
					alertify.success("Cliente agregado con exito");
				}else{
					alertify.error("No se pudo agregar cliente");
				}

			}
		})		
		
	});
	

	})
</script>

<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaCliente').click(function(){

				datos=$('#frmClienteU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/actualizaClientes.php",
					success:function(r){						
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success('Datos actualizados');

						}else{
							alertify.error('No se pudo actualizar');
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