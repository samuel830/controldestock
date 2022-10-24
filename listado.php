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

        /*function crear($nombre_form,$nombreCorto_form,$precio_form,$familia_form,$descripcion_form){
            $busqueda=$conexion->query("INSERT INTO productos (nombre,nombre_corto,descripcion,pvp,familia) 
            VALUES ('".$nombre_form."','".$nombreCorto_form."','".$descripcion_form."','".$precio_form."','".$familia_form."')");
        }*/

        if(!empty($_GET)){
            $accion = $_GET["accion"];

            switch($accion){
                case "crear":

                    $nombre = $_GET["nombre"];
                    $nombreCorto = $_GET["nombrecorto"];
                    $precio = $_GET["precio"];
                    $familia = $_GET["familia"];
                    $descripcion = $_GET["textarea"];

                    $busqueda=$conexion->query("INSERT INTO productos (nombre,nombre_corto,descripcion,pvp,familia) 
                    VALUES ('".$nombre."','".$nombreCorto."','".$descripcion."','".$precio."','".$familia."')");

                    header("Location: listado.php");

                    break;

                case "actualizar":
                    $codigo = $_GET["codigo"];
                    $nombre = $_GET["nombre"];
                    $nombreCorto = $_GET["nombrecorto"];
                    $precio = $_GET["precio"];
                    $familia = $_GET["familia"];
                    $descripcion = $_GET["textarea"];

                    $busqueda=$conexion->query("UPDATE productos SET nombre='".$nombre."',
                    nombre_corto='".$nombreCorto."',
                    descripcion='".$descripcion."',
                    pvp='".$precio."',
                    familia='".$familia."'
                    WHERE id='".$codigo."'");

                    header("Location: listado.php");

                    break;

                case "eliminar":
                    $codigo = $_GET["codigo"];
                    $busqueda=$conexion->query("DELETE FROM productos WHERE id='".$codigo."'");

                    header("Location: listado.php");
                    break;
            }
        }

        $busqueda=$conexion->query("SELECT * FROM productos");

        $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);


    ?>
    <div class="contenido">
        <div>
            <h1>GESTOR DE CONTENIDO</h1>
            <br><br>
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