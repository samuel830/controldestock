<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: login.php");
    }else{
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Crear producto</title>
            <link rel="stylesheet" href="estilos.css">
        </head>
        <body style="background-color: #<?php echo $_SESSION["colorfondo"] ?>; font-family: '<?php echo $_SESSION["tipoletra"] ?>'">
        <div class="menu">
            <ul>
                <li><a href="listado.php">Listado</a></li>
                <li><a href="perfil.php">Perfil</a></li>
                <li class="item-r"><a href="#">Cerrar sesión</a></li>
            </ul>
        </div>
        <br>
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
                                try{
                                    $busqueda=$conexion->query("SELECT * FROM familias");
                                    $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($arrDatos as $muestra){
                                        echo '<option value="'. $muestra['cod'].'">'. $muestra['nombre'].'</option>';
                                    }
                                }catch(PDOException $e){
                                    echo 'Error de consulta: ' . $e->getMessage();
                                    exit;
                                }
                            ?>  
                        </select><br>
                        <br>
                        <label><b>Descripcion:</b></label>
                        <br>
                        <br>
                        <textarea name="textarea" rows="10" cols="50" ></textarea><br>
                        <br>
                        <input name="accion" type="hidden" value="crear">
                        <button class="button-input" type="reset">Limpiar</button>
                        <br><br>
                        <button class="button-input" type="submit">Crear</button>
                    </form>
                </div>
            </div>
        </body>
        </html>

        <?php
        $conexion = null;
    }
?>