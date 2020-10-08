<?php 
require_once "clases/Conexion.php";
	$obj = new conectar();
	$dbh = $obj->conexion();
	$consulta = 'SELECT * FROM usuarios WHERE email = :email';
		$stmt = $dbh->prepare($consulta);
		$stmt->bindValue(':email', 'admin');		
		$stmt->execute();
		$validar = 0;
		$count = $stmt->rowCount();
		if($count> 0){
			header("location:index.php");
		}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
</head>
<body style="background-color: gray">
	<br>
	<br>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">Registrar Administrador </div>
					<div class="panel panel-body">

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
							<a href="index.php" class="btn btn-default">Regresar login</a>
						</form>
					</div>

				</div>



			</div>
			<div class="col-sm-4"></div>


		</div>


	</div>


</body>
</html>


<script type="text/javascript">
	$(document).ready(function(){
		$('#registro').click(function(){
			datos = validarFormVacio('frmRegistro');		
			if (datos>0){
				alert('Completar todos los campos');
				return false;
			}
		

			datos=$('#frmRegistro').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/regLogin/registrarUsuario.php",
				success:function(r){					
					if(r==1){
						alert('Agregado con exito');
					}else("fallo al agregar");

			}		
		});
	});
});


			</script>
