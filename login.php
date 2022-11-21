<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="titulo">
        <h1>Login</h1>
    </div>
    <div class="contenido">
        <div>
            <form action="listado.php" method="post">
                <label><b>Usuario:</b></label>
                <input type="text" name="usuario"><br>
                <br>
                <label><b>Contraseña:</b></label>
                <input type="password" name="contraseña"><br>
                <br><br>
                <button class="button-input" type="submit">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>