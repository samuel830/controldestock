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
    <div class="titulo">
        <h1>Crear productos</h1>
    </div>
    <div class="contenido">
        <div>
            <form action="listado.php" method="get">
                <label><b>Nombre:</b></label>
                <input type="text" name="nombre"><br>
                <br>
                <label><b>Email:</b></label>
                <input type="text" name="correo"><br>
                <br>
                <label><b>Selecciona una marca:</b></label><br>
                <br>
                <select multiple name="marcas[]">
                    <option>nike</option>
                    <option>adidas</option>
                    <option>reebook</option>
                    <option>new valance</option>
                </select><br>
                <br>
                <textarea name="textarea" rows="5" cols="30" placeholder="Háblanos sobre tus playeras favoritas..."></textarea><br>
                <br>
                <label><b>¿Estas registrado con nosotros?</b></label><input type="checkbox" name="registro">si<br>
                <br>
                <label><b>Selecciona tu edad:</b></label><br>
                <input type="radio" id="age1" name="edad" value="0-30">
                <label for="age1">0 - 30</label><br>
                <input type="radio" id="age2" name="edad" value="31-60">
                <label for="age2">31 - 60</label><br>  
                <input type="radio" id="age3" name="edad" value="61-100">
                <label for="age3">61 - 100</label><br>
                <br>
                <input type="submit">
            </form>
        </div>
    </div>
</body>
</html>