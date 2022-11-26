<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="titulo">
        <h1>Login</h1>
    </div>
    <div class="contenido">
        <div>
            <form action="login.php" method="post">
                <label><b>Usuario:</b></label>
                <input type="text" name="usuario"><br>
                <br>
                <label><b>Contraseña:</b></label>
                <input type="password" name="contraseña"><br>
                <br><br>
                <button class="button-input" type="submit">Entrar</button>
            </form>
            <?php
            if($_POST){
                $usuarioConfirmado = $_POST["usuario"];
                $claveEncriptada = hash('sha256',$_POST["contraseña"]);

                try{
                    $conexion=new PDO("mysql:host=localhost;dbname=proyecto","samuel","1234");
                    $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
                }catch(PDOException $e){
                    echo 'Error de conexión: ' . $e->getMessage();
                    exit;
                }

                try{
                    $busquedaUsuariosClave = $conexion->query("SELECT * FROM usuarios where usuario='$usuarioConfirmado' && clave='$claveEncriptada'");
                    $detallesUsuarioClave = $busquedaUsuariosClave->fetch();
                }catch(PDOException $ex){
                    echo 'Error de consulta: ' . $ex->getMessage();
                    exit;
                }

                if($detallesUsuarioClave){
                    session_start();

                    $_SESSION["usuario"] = $usuarioConfirmado;
                    header("location: listado.php");
                }else{
                    header("location: login.php");
                }
            }
            ?>
        </div>
    </div>
</body>
</html>