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
        <h1>Crear productos</h1>
    </div>
    <div class="contenido">
        <div>
            <form action="listado.php" method="get">
                <label><b>Nombre:</b></label>
                <input type="text" name="nombre"><br>
                <br>
                <label><b>Nombre corto:</b></label>
                <input type="text" name="nombrecorto"><br>
                <br>
                <label><b>Precio:</b></label>
                <input type="text" name="precio"><br>
                <br>
                <label><b>Familia:</b></label>
                <select name="familia">
                    <?php
                        $busqueda=$conexion->query("SELECT * FROM familias");
                        $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);

                        foreach($arrDatos as $muestra){
                            echo '<option value="'. $muestra['cod'].'">'. $muestra['nombre'].'</option>';
                        }
                    ?>  
                </select><br>
                <br>
                <label><b>Descripcion:</b></label>
                <br>
                <br>
                <textarea name="textarea" rows="10" cols="50" ></textarea><br>
                <br>
                <input name="accion" type="hidden" value="crear"><br>
                <input type="submit">
            </form>
        </div>
    </div>
</body>
</html>