<!DOCTYPE html>
<html lang="es">
<head>
	<title>Articulos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://localhost/Workspace_PRO/PAC/assets/css/estilos.css?v=1.0" />
</head>
<body>
	<div class="content">
		<?php include "funciones.php";
			
			if(!isset($_GET['name'])){ $nombre = 'null'; }
			else{$nombre = $_GET['name'];}
			if(!isset($_GET['correo'])){ $correo = 'null'; }
			else{$correo = $_GET['correo'];}

			echo "<form class='formArticulos'>
					<header><h2>Lista de artículos</h2></header><br><br>";
			if(getUsuarioAutorizado($nombre, $correo) == 1){
				if(isset($_GET['borrar'])){ borrarProducto('null'); }
				pintaProductos('ProductID');
			}else{ 
				echo "<p>No tienes permisos para estar aqui.<a href='index.php'>Volver al inicio</a></p>";
			}
			echo "</form>";
		?>
	</div>
</body>
</html>