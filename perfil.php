<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: login.php");
    }else{
        try{
            $conexion=new PDO("mysql:host=localhost;dbname=proyecto","samuel","1234");
            $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
        }catch(PDOException $e){
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }

        try{
            $busquedaUsuarios = $conexion->query("SELECT * FROM usuarios where usuario='".$_SESSION["usuario"]."'");
            $detallesUsuario = $busquedaUsuarios->fetch();
        }catch(PDOException $ex){
            echo 'Error de consulta: ' . $e->getMessage();
            exit;
        }
        
        $nombreUsuario = $detallesUsuario["nombrecompleto"];
        $usuario = $detallesUsuario["usuario"];
        $clave = $detallesUsuario["clave"];
        $correo = $detallesUsuario["correo"];
        $colorFondo = $detallesUsuario["colorfondo"];
        $tipoletra = $detallesUsuario["tipoletra"];

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Perfil</title>
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
            <div class="titulo">
            <h1>Perfil</h1>
            </div>
            <div class="contenido">
                <div>
                    <form action="perfil.php" method="get">
                        <label><b>Usuario:</b></label>
                        <input type="text" name="usuario" value=<?php echo "'$usuario'"?>><br>
                        <br>
                        <label><b>Contraseña:</b></label>
                        <input type="password" name="contraseña" value=<?php echo "'$clave'"?>><br>
                        <br><br>
                        <label><b>Nombre completo:</b></label>
                        <input type="text" name="nombrecompleto" value=<?php echo "'$nombreUsuario'"?>><br>
                        <br><br>
                        <label><b>Correo:</b></label>
                        <input type="text" name="correo" value=<?php echo "'$correo'"?>><br>
                        <br><br>
                        <label><b>Color fondo:</b></label>
                        <input type="text" name="colorfondo" value=<?php echo "'$colorFondo'"?>><br>
                        <br><br>
                        <label><b>Tipoletra:</b></label>
                        <input type="text" name="tipoletra" value=<?php echo "'$tipoletra'"?>><br>
                        <br>
                        <button class="button-input" type="submit">Actualizar</button>
                        <br>
                        <br>
                        <button class="button-input" type="reset">Limpiar</button>
                        
                    </form>
                    <?php
                        if($_GET){
                            $usuario = $_GET["usuario"];
                            $clave = $_GET["contraseña"];
                            $nombreUsuario = $_GET["nombrecompleto"];
                            $correo = $_GET["correo"];
                            $colorFondo = $_GET["colorfondo"];
                            $tipoletra = $_GET["tipoletra"];
        
                            try{
                                $sql = "UPDATE usuarios SET usuario='".$usuario."',
                                clave='".$clave."',
                                nombrecompleto='".$nombreUsuario."',
                                correo='".$correo."',
                                colorfondo='".$colorFondo."',
                                tipoletra ='".$tipoletra."'
                                WHERE usuario='".$usuario."' && clave='".$clave."'";
                                $actualizarUsuario=$conexion->query($sql);

                                echo $sql;
            
                            }catch(PDOException $e){
                                echo 'Error de consulta: ' . $e->getMessage();
                                exit;
                            }

                            $_SESSION["colorfondo"] = $colorFondo;
                            $_SESSION["tipoletra"] = $tipoletra;
        
                            header("Location: perfil.php");
                        }
                    ?>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
?>
