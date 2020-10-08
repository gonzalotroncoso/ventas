<?php 
	session_start();
	if (isset($_SESSION['tiempo'])){
		echo "hay tabla";
	}else{
		echo "no hay tabla";
	}
	

 ?>