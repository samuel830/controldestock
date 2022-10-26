<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
        $nombreProducto = $_GET["nombre"];
        try{
            $conexion=new PDO("mysql:host=localhost;dbname=proyecto","samuel","1234");
            $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
        }catch(PDOException $ex){
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }

    ?>
    <div class="contenido">
        <div>
        <h1>GESTOR DE STOCK</h1>
        <h2><?php echo $nombreProducto ?></h2>
        <br>
        <table>
            <tr>
                <th>Tienda</th>
                <th>Stock actual</th>
                <th>Nueva tienda</th> 
                <th>Nº unidades</th>
                <th>Enviar</th>
                <?php

                    $codigo = $_GET["codigo"]; 

                    try{
                        $busqueda=$conexion->query("SELECT * FROM stocks WHERE producto=$codigo");
                        $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);
                        
                        $busquedaNombres=$conexion->query("SELECT * FROM tiendas");
                        $arrNombres=$busquedaNombres->fetchAll(PDO::FETCH_ASSOC);
                    }catch(PDOException $e){
                        echo 'Error de consulta: ' . $e->getMessage();
                        exit;
                    }

                    foreach($arrDatos as $muestra){
                        try{
                            $busquedaTienda=$conexion->query("SELECT * FROM tiendas WHERE id='".$muestra['tienda']."' ");
                            $arrTiendas=$busquedaTienda->fetchAll(PDO::FETCH_ASSOC);
                        }catch(PDOException $e){
                            echo 'Error de consulta: ' . $e->getMessage();
                            exit;
                        }

                        foreach($arrTiendas as $tiendas){
                            echo '<tr>';
                            echo '<form action="listado.php" method="get">';
                            echo '<td>' . $tiendas['nombre'] . '</td>';    
                            echo '<td>' . $muestra['unidades'] . '</td>';    
                            echo '<td><select>';
                            foreach($arrNombres as $nombres){
                                echo'<option>'. $nombres['nombre'] .'</option>';
                            }
                            echo '</select></td>'; 
                            echo '<td><select>';
                            for($i = 1 ; $i <= $muestra['unidades']; $i++){
                                echo '<option>'.$i.'</option>';
                            }
                            echo '</select></td>';     
                            echo '<td><button class="button-input" type="submit">Enviar stock</button></td>';       
                            echo '</form>';
                        }
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