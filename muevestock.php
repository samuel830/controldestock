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
    if(count($_GET) == 2){
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
                            echo '<form action="muevestock.php" method="get">';
                            echo '<td>' . $tiendas['nombre'] . '</td>';  
                            echo '<input name="tiendaActual" type="hidden" value="'.$tiendas['id'].'">';  
                            echo '<td>' . $muestra['unidades'] . '</td>';     
                            echo '<td><select name="tiendaDestino">';
                            echo'<option value="seleccionar">Seleccione una tienda a enviar</option>';
                            foreach($arrNombres as $nombres){
                                echo'<option value="'.$nombres['id'].'">'.$nombres['nombre'].'</option>';
                            }
                            echo '</select></td>'; 
                            echo '<td><select name="unidadesEnviar">';
                            echo '<option value="seleccionar">Número de unidades a enviar</option>';
                            for($i = 1 ; $i <= $muestra['unidades']; $i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            echo '</select></td>';   
                            echo '<input name="nombreProducto" type="hidden" value="'.$nombreProducto.'">';  
                            echo '<input name="codigoProducto" type="hidden" value="'.$codigo.'">';  
                            echo '<input name="unidadesActuales" type="hidden" value="'.$muestra['unidades'].'">'; 
                            echo '<td><button class="button-input" type="submit">Enviar stock</button></td>';       
                            echo '</form>';
                        }
                    }

                    $conexion = null;
                    ?>
                </tr>
                <tr>
            </table>
            <br><br>
            <a href="listado.php"><button type="button" class="volver">Volver</button></a>
        </div>       
    </div>
    </body>
</html>
<!-------------------------------------------------------------------------------------------------------------------------------
    <?php
        }else if(count($_GET) > 2){
            try{
                $conexion=new PDO("mysql:host=localhost;dbname=proyecto","samuel","1234");
                $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
            }catch(PDOException $ex){
                echo 'Error de conexión: ' . $e->getMessage();
                exit;
            }

            $tiendaActual = $_GET['tiendaActual'];
            $tiendaDestino = $_GET['tiendaDestino'];
            $unidadesEnviar = $_GET['unidadesEnviar'];
            $unidadesActuales = $_GET['unidadesActuales'];
            $nombreProducto  = $_GET['nombreProducto'];
            $codigoProducto  = $_GET['codigoProducto'];

            if($tiendaActual != $tiendaDestino){
                //echo "Se va a enviar $unidades de $nombreProducto desde $tiendaActual a $tiendaDestino";
                try{
                    $eliminandoProductoActual=$conexion->query("UPDATE stocks SET unidades=unidades - '".$unidadesEnviar."' WHERE producto = '".$codigoProducto."' AND tienda='".$tiendaActual."'");

                    $comprobarExiste = $conexion->query("SELECT unidades FROM stocks WHERE producto = '".$codigoProducto."' AND tienda='".$tiendaActual."'");
                    $arrStockActualizados=$comprobarExiste->fetch();
                    $unidadesModificadas =$arrStockActualizados["unidades"];
                    if($unidadesModificadas == 0){
                        $eliminar=$conexion->query("DELETE FROM stocks WHERE producto = '".$codigoProducto."' AND tienda='".$tiendaActual."'");
                    }

                    $añadirProductoEnviar=$conexion->query("UPDATE stocks SET unidades=unidades + '".$unidadesEnviar."' WHERE producto = '".$codigoProducto."' AND tienda='".$tiendaDestino."'");
                }catch(PDOException $e){
                    echo 'Error de consulta: ' . $e->getMessage();
                    exit;
                }

                header("Location: muevestock.php?codigo=26&nombre=Creative%20Zen%20MP4%208GB%20Style%20300");

            }else{
                echo "Se esta intentando enviar el producto a la misma tienda";
            }    
            
            $conexion = null;
        }
    ?>