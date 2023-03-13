<?php require "conexion.php";

	function tipoUsuario($nombre, $correo){
		$DB = crearConexion();
		$sql = "SELECT * FROM user WHERE Fullname = '$nombre' AND Email = '$correo';";
		$result = mysqli_query($DB, $sql);

		if (mysqli_num_rows($result) > 0){
            if(esSuperadmin($nombre,$correo)){
				header("Location: usuarios.php?name=$nombre&correo=$correo");

				// echo "	<p>Bienvenido " . $nombre . ". Pulsa 
				// 		<a href='usuarios.php?name=".$nombre."&correo=".$correo."'>AQUI</a>  
				// 		para entrar en el panel de usuarios.</p>";
			}else{
				header("Location: articulos.php?name=$nombre&correo=$correo");

				// echo "
				// 		<p>Bienvenido " . $nombre . ". Pulsa 
				// 		<a href='articulos.php?name=".$nombre."&correo=".$correo."'>AQUI</a> 
				// 		para entrar en el panel de artículos.</p>";
			}
        }else{
            echo "<div class='noRegitrado'><p>El usuario no está registrado en el sistema.<p></div>";
        }
		cerrarConexion($DB);
	}

	function esSuperadmin($nombre, $correo){
		$DB = crearConexion();
        $sql = "SELECT * FROM user A INNER JOIN setup B ON A.UserID = B.SuperAdmin
				WHERE A.Fullname = '" . $nombre . "' AND A.Email = '" . $correo . "';";
		$result = mysqli_query($DB, $sql);
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
		cerrarConexion($DB);
	}

	function getPermisos(){
		$DB = crearConexion();
		$sql = "SELECT * FROM setup;";
		$result = mysqli_query($DB, $sql);
		$filas = mysqli_fetch_array($result);
		if($filas['Autenticación']==1){
			return 1;
		}else{
			return 0;
		}
		cerrarConexion($DB);
	}

	function cambiarPermisos(){
		$DB = crearConexion();
		if(getPermisos() == 1){
			$sql = "UPDATE setup SET Autenticación = 0;";
		}else{
			$sql = "UPDATE setup SET Autenticación = 1;";
		}
		$result = mysqli_query($DB, $sql);
		if ($result){
			return $result;
        }else{
            echo "Error en la función borrar el producto.";
        }
		cerrarConexion($DB);
	}

	function getCategorias(){
		$DB = crearConexion();
        $sql = "SELECT categoryID, Name FROM category";
        $result = mysqli_query($DB, $sql);
        if (mysqli_num_rows($result) > 0){
            return $result;
        }else{
            echo "No hay nada en la lista de países.";
        }
        cerrarConexion($DB);
	}

	function getListaUsuarios(){
		$DB = crearConexion();
        $sql = "SELECT FullName, Email, Enabled FROM user ORDER BY UserID ASC;";
        $result = mysqli_query($DB, $sql);
        if (mysqli_num_rows($result) > 0){
            return $result;
        }else{
            echo "No hay nadie en la lista de usuario.";
        }
		cerrarConexion($DB);
	}

	function getUsuarioAutorizado($nombre, $correo){
		$DB = crearConexion();
        $sql = "SELECT FullName, Email, Enabled FROM user 
				WHERE Fullname = '".$nombre."' AND Email = '".$correo."' AND Enabled = 1;";
        $result = mysqli_query($DB, $sql);
        if (mysqli_num_rows($result) > 0){
            return 1;
        }else{
            return 0;
        }
		cerrarConexion($DB);
	}

	function getProductos($orden){
		$DB = crearConexion();
		if(!isset($_GET['orden'])){ 
			$orden = 'ProductID'; 
		}else{ 
			$orden = $_GET['orden']; 
		}
		if(getPermisos() == 1){
			$sql = "SELECT A.ProductID, A.Name, A.Cost, A.Price, B.Name AS Category
			FROM product A INNER JOIN category B ON A.CategoryID = B.CategoryID
			ORDER BY " . $orden . " ASC;";
			$result = mysqli_query($DB, $sql);
			if (mysqli_num_rows($result) > 0){
				return $result;
			}else{
				echo "No hay nadie en la lista de productos.";
			}
		}else{
			return "<p>No tienes permisos para estar aqui. <a href='index.php'>Volver al inicio</a></p>";
		}
		cerrarConexion($DB);
	}

	function getProducto($id){
		$DB = crearConexion();
		if(!isset($_GET['editar'])){
            $id = 'null';
        }else{
            $id = $_GET['editar'];
        }
        $sql = "SELECT * FROM product WHERE ProductID = $id";
        $result = mysqli_query($DB, $sql);
		return $result;
		cerrarConexion($DB);
	}

	function anadirProducto($nombre, $coste, $precio, $categoria){
		$DB = crearConexion();
        $sql = "INSERT INTO product (Name, Cost, Price, CategoryID)
				VALUES ('$nombre','$coste','$precio','$categoria');";
        $result = mysqli_query($DB, $sql);
		if ($result){
			return $result;
		}else{
			echo "Error en funcion añadir el producto.";
		}
		cerrarConexion($DB);
	}

	function borrarProducto($id){
		$DB = crearConexion();
		if(!isset($_GET['borrar'])){
            $id = 'null';
        }else{
            $id = $_GET['borrar'];
        }
        $sql = "DELETE FROM product WHERE ProductID = ". $id .";";
        $result = mysqli_query($DB, $sql);
		if ($result){
			return $result;
        }else{
            echo "Error en la función borrar el producto.";
        }
		cerrarConexion($DB);
	}

	function editarProducto($id, $nombre, $coste, $precio, $categoria){
		$DB = crearConexion();
		$sql = "UPDATE product SET 
					Name = '$nombre',
					Cost = '$coste',
					Price = '$precio',
					CategoryID = '$categoria'
				WHERE ProductID = '$id';";
		$result = mysqli_query($DB, $sql);
		if ($result){
            return $result;
        }else{
            echo "Error en la función modificar el producto.";
        }
		cerrarConexion($DB);
	}
?>