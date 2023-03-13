<!DOCTYPE html>
<html lang="es">
<head>
	<title>Formulario de artículos</title>
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

			if(getUsuarioAutorizado($nombre, $correo) == 1){
				if(isset($_POST['nombre'])){$Nombre = $_POST['nombre'];}
				if(isset($_POST['coste'])){$Coste = $_POST['coste'];}
				if(isset($_POST['precio'])){$Precio = $_POST['precio'];}
				if(isset($_POST['categoria'])){$Categoria = $_POST['categoria'];}
				if(isset($_GET['editar'])){
					$id = $_GET['editar'];
					$datos = mysqli_fetch_assoc(getProducto($id));
					$ticulo = "<header><h2>Vamos a editar </h2</header><br><br>";
					$submit = "Editar";
				}else{
					$id = "";
					$datos = [
						"ProductID" => "",
						"Name" => "",
						"Cost" => "",
						"Price" => "",
						"Category" => ""
					];
					$ticulo = "<header><h2>Vamos a crear </h2></header><br><br>";
					$submit = "Añadir";
				}
				echo "
					<form class='formArticulo' action='formArticulos.php?name=".$nombre."&correo=".$correo."'  method='POST'>";
						echo $ticulo; 
						echo "
						<label>ID: </label><input type='text' name='id' value='"; echo $datos["ProductID"]; echo "' disabled><br><br>
						<label>Nombre: </label><input type='text' name='nombre' value='"; echo $datos["Name"]; echo"'><br><br>
						<label>Coste: </label><input type='text' name='coste' value="; echo $datos["Cost"]; echo"><br><br>
						<label>Precio: </label><input type='text' name='precio' value="; echo $datos["Price"]; echo "><br><br>
						<label>Categoria: </label><select name='categoria'>"; pintaCategorias($datos["Category"]); echo "</select><br><br>
						<br>
						<input type='hidden' name='id' value="; echo $id; echo">
						<input type='submit' name='anadir' value="; echo $submit; echo " />
						<button><a href='articulos.php?name=".$nombre."&correo=".$correo."'>Volver</a></button><br><br>";

						if(isset($_POST['id'])){
							$Nombre = $_POST['nombre'];
							$Coste = $_POST['coste'];
							$precio = $_POST['precio'];
							$categoria = $_POST['categoria'];
							$id = $_POST['id'];
							if($id > 0){
								if(editarProducto($id,$Nombre,$Coste,$Precio,$Categoria)){
									echo "<br><hr><br><h3>Se ha modificado el producto:</h3>";
									echo "<div class='result'>";
									echo "<p>Nombre: " . $Nombre . "</p>";
									echo "<p>Coste: " . $Coste . "</p>";
									echo "<p>Precio: " . $Precio . "</p>";
									echo "<p>Categoría: " . $Categoria . "</p>";
									echo "</div>";
								}else{
									echo "No se ha podido modificar el producto."; 
								}
							}else if(anadirProducto($Nombre,$Coste,$Precio,$Categoria)){
								echo "<br><hr><br><h3>Se ha añadido un nuevo producto:</h3>";
								echo "<div class='result'>";
								echo "<p>Nombre: " . $Nombre . "</p>";
								echo "<p>Coste: " . $Coste . "</p>";
								echo "<p>Precio: " . $Precio . "</p>";
								echo "<p>Categoría: " . $Categoria . "</p>";
								echo "</div>";
							}else{
								echo "No se ha podido añadir el producto.";
							}
						}
					echo "</form>";
			}else{ 
				echo "<p>No tienes permisos para estar aqui.<a href='index.php'>Volver al inicio</a></p>";
			}
		?>
	</div>
</body>
</html>