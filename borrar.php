<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: login.php");
    }else{
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Crear producto</title>
            <link rel="stylesheet" href="estilos.css">
        </head>
        <body style="background-color: #<?php echo $_SESSION["colorfondo"] ?>; font-family: '<?php echo $_SESSION["tipoletra"] ?>'">
        <?php
            try{
                $conexion=new PDO("mysql:host=localhost;dbname=proyecto","samuel","1234");
                $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
            }catch(PDOException $ex){
                echo 'Error de conexión: ' . $e->getMessage();
                exit;
            }
            ?>
            <div class="titulo">
                <h1>Eliminar productos</h1>
            </div>
            <div class="contenido">
                <div>
                    <?php
                        $codigo = $_GET["codigo"]; 
                        $nombre = $_GET["nombre"]; 
                        echo "<h2>¿Desea eliminar el producto ".$nombre." con id ".$codigo."?</h2>";
                        echo '<a href="listado.php?codigo='.$codigo.'&accion=eliminar"><button type="button" class="eliminar">Eliminar</button></a>';
                        echo "<p>Esta opeación sera irreversible</p>";
                    ?>
                </div>
            </div>
        </body>
        </html>

        <?php
        $conexion = null;
    }
?>