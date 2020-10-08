<?php 
	class conectar{		
		private $dsn = 'mysql:dbname=id8888013_ventas;host=localhost';
		private $usuario = 'id8888013_gonzalo';
		private $contrasenia = '12837gonzalo';



		public function conexion(){
			$dbh = new PDO($this->dsn,$this->usuario, $this->contrasenia);				
			return $dbh;
		}
	}

	

	

 ?>