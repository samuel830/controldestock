<?php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: login.php");
}else{
    if(empty($_POST)){
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
            <div class="titulo">
                <h1>¿Esta seguro que desea cerrar sesion?</h1>
            </div>
            <div class="contenido">
                <div>
                    <form action="cerrarsesion.php" method="post">
                        <button class="button-input" type="submit">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        </body>
        </html>
    <?php
    }else{
        session_destroy();
        header("Location: login.php");
    }
}
?>
