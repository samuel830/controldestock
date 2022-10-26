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

    $codigo = $_GET["codigo"]; 

    $busqueda=$conexion->query("SELECT * FROM productos WHERE id = $codigo");
    $arrDatos=$busqueda->fetchAll(PDO::FETCH_ASSOC);

    $familias=$conexion->query("SELECT * FROM familias");
    $arrFamilias=$familias->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="titulo">
        <h1>Actualizar productos</h1>
    </div>
    <div class="contenido">
        <div>
            <form action="listado.php" method="get">
                <label><b>Nombre:</b></label>
                <?php
                    foreach($arrDatos as $muestra){
                        echo '<input type="text" name="nombre" value="'.$muestra['nombre'].'"><br>';
                    }
                ?> 
                <br>
                <label><b>Nombre corto:</b></label>
                <?php
                    foreach($arrDatos as $muestra){
                        echo '<input type="text" name="nombrecorto" value="'.$muestra['nombre_corto'].'"><br>';
                    }
                ?> 
                <br>
                <label><b>Precio:</b></label>
                <?php
                    foreach($arrDatos as $muestra){
                        echo '<input type="text" name="precio" value="'.$muestra['pvp'].'"><br>';
                    }
                ?> 
                <br>
                <label><b>Familia:</b></label>
                <select name="familia">
                    <?php
                        foreach($arrFamilias as $muestra){
                            foreach($arrDatos as $datos){
                                if($muestra['cod'] == $datos['familia']){
                                    echo '<option selected>'. $muestra['nombre'].'</option>';
                                }else
                                    echo '<option>'. $muestra['nombre'].'</option>';
                            }
                        }
                    ?>  
                </select><br>
                <br>
                <label><b>Descripcion:</b></label>
                <br>
                <br>
                <?php
                    foreach($arrDatos as $muestra){
                        echo '<textarea name="textarea" rows="10" cols="50" placeholder="'.$muestra['descripcion'].'"></textarea><br>';
                    }
                ?> 
                <br>
                <input name="accion" type="hidden" value="actualizar">
                <input name="codigo" type="hidden" value="<?php echo $codigo ?>">
                <input type="reset" value="Borrar">
                <input type="submit" value="Actualizar">
            </form>
        </div>
    </div>
</body>
</html>