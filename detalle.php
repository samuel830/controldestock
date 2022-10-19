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
        $conexion=new PDO("mysql:host=localhost;dbname=proyecto","samuel","1234");
        $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
    ?>
    <div class="titulo">
        <h1>Detalles del producto</h1>
    </div>
    <div class="contenido">
        <?php
            $codigo = $_GET["codigo"]; 

            $busqueda=$conexion->query("SELECT * FROM productos WHERE id = $codigo");
            $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);
            //print_r($arrDatos);

            echo '<div class="infotexto">';

            foreach($arrDatos as $muestra){
                echo $muestra['nombre'] . '</br>';
                echo $muestra['nombre_corto'] . '</br>';
                echo $muestra['familia'] . '</br>';
                echo $muestra['pvp'] . '</br>';
                echo $muestra['descripcion'] . '</br>';
            }
        ?>
        </div>
    </div>
</body>
</html>