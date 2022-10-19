<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
    <h1>Gestion de productos</h1>
    <a href=""><button type="button" class="btn btn-success">Crear</button></a>
    <br>
    <table class="table table-striped table-dark">
        <tr>
            <th scope="col">Detalle</th>
            <th scope="col">Codigo</th>
            <th scope="col">Nombre</th> 
            <th scope="col">Acciones</th>
            <?php
                foreach ($arrDatos as $muestra) {
                    echo '<tr>';
            
                    echo '<td scope="row"><a href=""><button type="button" class="btn btn-info">Detalle</button></a></td>';
                    echo '<td scope="row">' . $muestra['id'] . '</td>';
                    echo '<td scope="row">' . $muestra['nombre'] . '</td>';
                    echo '<td scope="row">
                        <a href=""><button type="button" class="btn btn-warning">Actualizar</button></a>
                        <a href=""><button type="button" class="btn btn-danger">Eliminar</button></a>
                        </td>';
                }
            ?>
        <tr>
    </table>
    
</body>
</html>

<?php
    $conexion = null;
?>