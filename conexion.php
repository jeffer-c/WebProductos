<?php 
	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "";
		$database = "pac3_daw";
		$conexion = mysqli_connect($host,$user,$pass,$database);
		if(!$conexion){
			die("<br>Error de la conexión con la base de datos: " . mysqli_conect_error());
		}else{
			echo "<script>console.log('Conexion correcta a la base de datos: ". $database ."');</script>";
		}
		return $conexion;
	}

	function cerrarConexion($conexion) {
		mysqli_close($conexion);
	}
?>