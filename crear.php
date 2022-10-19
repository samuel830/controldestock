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
        //echo "Versión: $version";

        $busqueda=$conexion->query("SELECT * FROM productos");

        /*Almacenamos el resultado de fetchAll en una variable*/
        $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);
        //print_r($arrDatos);
    ?>
    <div>
        <div class="titulo">
            <h1>Gestion de productos</h1>
        </div>

        <div>
            <form action="POST">
                <label>Nombre</label>
                <input type="text">
                <label>Nombre corto</label>
                <input type="text">
                <label>Precio</label>
                <input type="text">
                <label>Familia</label>
                <select name="" id=""></select>
                <label>Descripción</label>
                <input type="text">
            </form>
        </div>
    </div>
</body>
</html>