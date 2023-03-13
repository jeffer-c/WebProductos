<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index.php</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/Workspace_PRO/PAC/assets/css/estilos.css?v=1.0">
</head>
<body>
    <div class="form contentIndex">
        <div class="imgForm"></div>
        <form class="formLogin" action="index.php" method="GET">
            <div class="titelForm">
                <h2>Bienvenido</h2>
                <p>Inicia sesión con tu cuenta</p>
            </div>
            <div class="input">
                <label for="usuario">Usuario: </label>
                <input placeholder="Ingresa tu usuario" type="text" name="name" id="usuario" />
            </div>
            <div class="input">
                <label for="correo">Correo: </label>
                <input placeholder="Ingresa tu correo" type="text" name="correo" id="correo" />
            </div>
            <div class="input">
                <input type="submit" name="enviar" value="Login" />
            </div>
            <?php include "consultas.php";
                if(isset($_GET['enviar'])){
                    session_start();
                    if(isset($_GET['name'])){$nombre = $_GET['name'];}
                    if(isset($_GET['correo'])){$correo = $_GET['correo'];}
                    if(!isset($_SESSION['Usuario'])){
                        $_SESSION['Usuario'] = null;  
                    }else{
                        $_SESSION['Usuario'] = $nombre;  
                    }
                    tipoUsuario($nombre,$correo);
                }
            ?>
        </form>
    </div>
</body>
</html>