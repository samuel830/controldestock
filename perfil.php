<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: login.php");
    }else{
        try{
            $conexion=new PDO("mysql:host=localhost;dbname=proyecto","samuel","1234");
            $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
        }catch(PDOException $e){
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }

        $busquedaUsuarios = $conexion->query("SELECT * FROM usuarios where usuario='".$_SESSION["usuario"]."'");
        $detallesUsuario = $busquedaUsuarios->fetch();

        $nombreUsuario = $detallesUsuario["nombrecompleto"];

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Perfil</title>
            <link rel="stylesheet" href="estilos.css">
        </head>
        <body>
            <div class="titulo">
            <h1>Perfil</h1>
            </div>
            <div class="contenido">
                <div>
                    <h2>Hola <?php echo $nombreUsuario ?></h2>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
?>
