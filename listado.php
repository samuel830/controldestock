<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de stock</title>
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
    <div class="contenido">
        <div>
            <a href="crear.php"><button type="button" class="success">Crear</button></a>
            <br>
            <br>
            <table>
                <tr>
                    <th class="detalle">Detalle</th>
                    <th class="codigo">Codigo</th>
                    <th class="nombre">Nombre</th> 
                    <th class="acciones">Acciones</th>
                    <?php
                        foreach ($arrDatos as $muestra) {
                            echo '<tr>';
                    
                            echo '<td><a href="detalle.php?codigo='.$muestra['id'].'"><button type="button" class="info">Detalle</button></a></td>';
                            echo '<td>' . $muestra['id'] . '</td>';
                            echo '<td>' . $muestra['nombre'] . '</td>';
                            echo '<td>
                                <a href="update.php?codigo='.$muestra['id'].'"><button type="button" class="warning">Actualizar</button></a>
                                <a href="borrar.php?codigo='.$muestra['id'].'"><button type="button" class="danger">Eliminar</button></a>
                                </td>';
                        }
                    ?>
                    </tr>
                <tr>
            </table>
        </div>
    </div>
</body>
</html>

<?php
    $conexion = null;
?>