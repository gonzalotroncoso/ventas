<?php 
	session_start();

	if (isset($_SESSION['usuario'])){


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ventas</title>
	<?php require_once "menu.php" ?>
</head>
<body>
<div class="container">
	<h1>Ventas de productos</h1>
	<div class="row">
		<div class="col-sm-12"></div>
		<span class="btn btn-default" id="btnVenderProductos">Vender productos</span>
		<span class="btn btn-default" id="btnVentasHechas">Ventas hechas</span>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div id="ventasProductos"></div>
			<div id="vemtasHechas"></div>


		</div>
	</div>



</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
			
		$('#btnVenderProductos').click(function(){
			esconderSeccionVenta();
			$('#ventasProductos').load('ventas/ventasDeProductos.php');
			$('#ventasProductos').show();

		});

		$('#btnVentasHechas').click(function(){
			esconderSeccionVenta();
			$('#vemtasHechas').load('ventas/ventasyreportes.php');
			$('#vemtasHechas').show();

		});

	});
	function esconderSeccionVenta(){
		$('#ventasProductos').hide();
		$('#vemtasHechas').hide();

	}

</script>

<?php 
}else{
	header("location:../index.php");
}

 ?>