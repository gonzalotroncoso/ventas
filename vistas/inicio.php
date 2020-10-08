<?php 
	session_start();

	if (isset($_SESSION['usuario'])){


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<?php require_once "menu.php" ?>
</head>
<body>
	<p>Hola <?php echo ($_SESSION['usuario'] ) ?> </p>

</body>
</html>

<?php 
}else{
	header("location:../index.php");
}

 ?>