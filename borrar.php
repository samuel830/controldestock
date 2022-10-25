<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear producto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php
    try{
        $conexion=new PDO("mysql:host=localhost;dbname=proyecto","samuel","1234");
        $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
    }catch(PDOException $ex){
        die("Error en la conexion, mensaje de erro:".$ex->getMessage());
    }
    ?>
    <div class="titulo">
        <h1>Eliminar productos</h1>
    </div>
    <div class="contenido">
        <div>
            <?php
                $codigo = $_GET["codigo"]; 
                echo "<h2>¿Desea eliminar el producto con id ".$codigo."?</h2>";
                echo '<a href="listado.php?codigo='.$codigo.'&accion=eliminar"><button type="button" class="eliminar">Eliminar</button></a>';
            ?>
        </div>
    </div>
</body>
</html>