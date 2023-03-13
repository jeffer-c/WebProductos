<?php include "consultas.php";

	function pintaCategorias($defecto) {
        $categorias = getCategorias();
        if(is_string($categorias)){
            echo $categorias;
        }else{
            while($fila = mysqli_fetch_assoc($categorias)){
                echo "<option value='" . $fila["categoryID"] . "'>" . $fila["Name"] . "</option>";
            }
        }
	}
	
	function pintaTablaUsuarios(){
		$user = getListaUsuarios();
        if(is_string($user)){
            echo $user;
        }else{
            echo"
                <table>\n
                    <tr>\n
                        <th>Nombre</th>\n
                        <th>Email</th>\n
                        <th>Autorizado</th>\n
                    </tr>\n
                ";
            while ($fila = mysqli_fetch_assoc($user)) {
                echo"
                        <tr>\n
                            <td>" . $fila["FullName"] . "</td>\n
                            <td>" . $fila["Email"] . "</td>\n
                            "; 
                                if($fila['Enabled'] == 1){
                                    if(getPermisos() == 1){
                                        echo "<td class='on'>";   
                                    }else{
                                        echo "<td class='off'>\n";
                                    }
                                }else{
                                    echo "<td>";
                            }
                            echo $fila["Enabled"] . "</td>\n
                        </tr>\n    
                    ";
            }
            echo "</table>";
        }
	}
		
	function pintaProductos($orden) {
        $productos = getProductos($orden);
        if(isset($_GET['name'])){$nombre = $_GET['name'];}
        if(isset($_GET['correo'])){$correo = $_GET['correo'];}
        $user = "name=".$nombre."&correo=".$correo."";
        if(is_string($productos)){
            echo $productos;
        }else{
            echo"
                <button><a href='formArticulos.php?".$user."'>Añadir producto</a></button>
                <button><a href='index.php'>Salir</a></button><br><br>
                <table>\n
                    <tr>
                        <th><a href='articulos.php?orden=ProductID&".$user."'>ID</a></th>\n
                        <th><a href='articulos.php?orden=Name&".$user."'>Nombre</a></th>\n
                        <th><a href='articulos.php?orden=Cost&".$user."'>Coste</a></th>\n
                        <th><a href='articulos.php?orden=Price&".$user."'>Precio</a></th>\n
                        <th><a href='articulos.php?orden=Category&".$user."'>Categoría</a></th>\n
                        <th colspan='2'><a>Acciones</a></th>\n
                    </tr>\n
                ";
            while ($fila = mysqli_fetch_assoc($productos)) {
                echo"
                        <tr>\n
                            <td>" . $fila["ProductID"] . "</td>\n
                            <td>" . $fila["Name"] . "</td>\n
                            <td>" . $fila["Cost"] . "</td>\n
                            <td>" . $fila["Price"] . "</td>\n
                            <td>" . $fila["Category"] . "</td>\n
                            <td>
                                <a href='formArticulos.php?editar=".$fila["ProductID"]."&$user'>Editar</a>
                            </td>\n
                            <td>
                                <a href='articulos.php?borrar=".$fila["ProductID"]."&$user'>Borrar</a>
                            </td>\n
                        </tr>\n    
                    ";
            }
            echo "</table>";
        }
	}
?>