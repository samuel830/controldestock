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
        echo 'Error de conexión: ' . $e->getMessage();
        exit;
    }
        
    ?>
    <div class="titulo">
        <h1>Detalles del producto</h1>
    </div>
    <div class="contenidoDetalles">
        <div>
        <table>
                <tr>
                    <th >Nombre</th>
                    <th >Nombre corto</th>
                    <th >Familia</th> 
                    <th >Precio</th>
                    <th >Descripcion</th>
        <?php
            $codigo = $_GET["codigo"]; 

            try{
                $busqueda=$conexion->query("SELECT * FROM productos WHERE id = $codigo");
                $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);

                $familias=$conexion->query("SELECT * FROM familias");
                $arrFamilias=$familias->fetchAll(PDO::FETCH_ASSOC);

                foreach($arrDatos as $muestra){
                    echo '<tr>';
                        
                    echo '<td>' . $muestra['nombre'] . '</td>';
                    echo '<td>' . $muestra['nombre_corto'] . '</td>';
                    foreach($arrFamilias as $familias){
                        foreach($arrDatos as $muestra){
                            if($familias['cod'] == $muestra['familia']){
                                echo '<td>' . $familias['nombre'] . '</td>';
                            }
                        }
                    }
                echo '<td>' . $muestra['pvp'] . '</td>';
                echo '<td>' . $muestra['descripcion'] . '</td>';
                }
            }catch(PDOException $e){
                echo 'Error de consulta: ' . $e->getMessage();
                exit;
            }
            
        ?>
        </tr>
        <tr>
        </table>
        <br>
        <br>
        <a href="listado.php"><button type="button" class="volver">Volver</button></a>
        </div>
    </div>
</body>
</html>