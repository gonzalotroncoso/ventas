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
			$validar=1;
		}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login de usuario</title>
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
				<div class="panel panel-primary">
					<div class="panel panel-heading">Sistema de ventas y almacen</div>
					<div class="panel panel-body">
					<form id="frmLogin">
						<label>Usuario</label>
						<input type="text" class="form-control input-sm" name="usuario" id="usuario" >
						<label>Password</label>
						<input type="Password" name="Password" id="Password" class="form-control input-sm" >
						<p></p>
						<span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
						<?php if(!$validar): ?>
						<a href="registro.php" class="btn btn-danger btn-sm">Registro</a>
						<?php endif; ?>
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
			$('#entrarSistema').click(function(){
				datos = validarFormVacio('frmLogin');		
			if (datos>0){
				alert('Completar todos los campos');
				return false;
			}
		

		datos=$('#frmLogin').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"procesos/regLogin/login.php",
			success:function(r){				
				if(r==1){
					window.location="vistas/ventas.php"
				}else{

					alert(r);
				}

			}
		});
	});

	})

</script>