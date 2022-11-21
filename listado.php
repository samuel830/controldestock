<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
    <link rel="stylesheet" href="estilos.css">
</head>
    <?php
    if(!empty($_POST)){

        $usuario = $_POST['usuario'];

        session_start();

        $_SESSION["usuario"] = $usuario;

        try{
            $conexion=new PDO("mysql:host=localhost;dbname=proyecto","samuel","1234");
            $version = $conexion->getAttribute(PDO::ATTR_SERVER_VERSION);
        }catch(PDOException $e){
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }

        $busquedaUsuarios = $conexion->query("SELECT * FROM usuarios where usuario='".$usuario."'");
        $detallesUsuario = $busquedaUsuarios->fetch();

        $_SESSION["colorfondo"] = $detallesUsuario["colorfondo"];
        $_SESSION["tipoletra"] = $detallesUsuario["tipoletra"];

        if(!empty($_GET)){
            $accion = $_GET["accion"];
    
            switch($accion){
                case "crear":
    
                    $nombre = $_GET["nombre"];
                    $nombreCorto = $_GET["nombrecorto"];
                    $precio = $_GET["precio"];
                    $familia = $_GET["familia"];
                    $descripcion = $_GET["textarea"];
    
                    try{
                        $busqueda=$conexion->query("INSERT INTO productos (nombre,nombre_corto,descripcion,pvp,familia) 
                        VALUES ('".$nombre."','".$nombreCorto."','".$descripcion."','".$precio."','".$familia."')");
                    }catch(PDOException $e){
                        echo 'Error de consulta: ' . $e->getMessage();
                        exit;
                    }
    
                    header("Location: listado.php");
                    break;
    
                case "actualizar":
                    $codigo = $_GET["codigo"];
                    $nombre = $_GET["nombre"];
                    $nombreCorto = $_GET["nombrecorto"];
                    $precio = $_GET["precio"];
                    $familia = $_GET["familia"];
                    $descripcion = $_GET["textarea"];
    
                    try{
                        $familiaCod=$conexion->query("SELECT * from familias where nombre='".$familia."'");
                        $arrFamiliasCod=$familiaCod->fetch();
                        $codfamilia = $arrFamiliasCod["cod"];
    
                        $busqueda=$conexion->query("UPDATE productos SET nombre='".$nombre."',
                        nombre_corto='".$nombreCorto."',
                        descripcion='".$descripcion."',
                        pvp='".$precio."',
                        familia='".$arrFamiliasCod['cod']."'
                        WHERE id='".$codigo."'");
    
                    }catch(PDOException $e){
                        echo 'Error de consulta: ' . $e->getMessage();
                        exit;
                    }
                        
                    header("Location: listado.php");
                    break;
    
                case "eliminar":
                    $codigo = $_GET["codigo"];
    
                    try{
                        $busqueda=$conexion->query("DELETE FROM productos WHERE id='".$codigo."'");
                    }catch(PDOException $e){
                        echo 'Error de consulta: ' . $e->getMessage();
                        exit;
                    }
                        
                    header("Location: listado.php");
                    break;
            }
        }
    
        try{
            $busqueda=$conexion->query("SELECT * FROM productos");
            $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo 'Error de consulta: ' . $e->getMessage();
            exit;
        }

        ?>
        <body style="background-color: #<?php echo $_SESSION["colorfondo"] ?>; font-family: '<?php echo $_SESSION["tipoletra"] ?>'">
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
                                    <a href="borrar.php?codigo='.$muestra['id'].'&nombre='.$muestra['nombre'].'"><button type="button" class="danger">Eliminar</button></a>
                                    <a href="muevestock.php?codigo='.$muestra['id'].'&nombre='.$muestra['nombre'].'"><button type="button" class="stock">Mover a stock</button></a>
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

    }else{
        header("location: login.php");
    }
?>