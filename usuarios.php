<!DOCTYPE html>
<html lang="es">
<head>
	<title>Usuarios</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://localhost/Workspace_PRO/PAC/assets/css/estilos.css?v=1.0" />
</head>
<body class="content">
	<div class="content">
		<?php include "funciones.php";
			if(!isset($_GET['name'])){ $nombre = 'null'; }
			else{$nombre = $_GET['name'];}
			if(!isset($_GET['correo'])){ $correo = 'null'; }
			else{$correo = $_GET['correo'];}
			
			echo 
			"<form class='formUsuarios' action='usuarios.php?name=".$nombre."&correo=".$correo."'  method='POST'> 
				<header><h2>Lista de usuarios</h2></header>";
			if(esSuperadmin($nombre, $correo)){
				if(isset($_POST['cambiar'])){
					cambiarPermisos();
				}
				if(getPermisos() == 1 ){
					$permisos = "habilidatos";
				}else{
					$permisos = "deshabilidatos";
				}
						echo "<p>Los permisos actuales están ".$permisos.".</p><br><br>
						<input type='submit' name='cambiar' value='Cambiar permisos' />
						<button> <a href='index.php'>Salir</a></button><br><br>";
						pintaTablaUsuarios();
				echo "</form>";
			}else{ 
				echo "<p>No tienes permisos para estar aqui.<a href='index.php'>Volver al inicio</a></p>";
			}	
		?>
	</div>
</body>
</html>