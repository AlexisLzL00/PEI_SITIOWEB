
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Inicio de sesion</title>
</head>
<body>
    <form action="Insertar_login.php" method="POST">
        <h1>INICIAR SESION</h1>
        <hr>
        <i class="fa-solid fa-user"></i>
        <label>Usuario</label>
        <input type="text" name="Nombres" placeholder="Nombre de usuario">

        <i class="fa-solid fa-unlock"></i>
        <label>Contraseña</label>
        <input type="password" name="Password" placeholder="Contraseña">
        <a href="#">¿Olvidaste tu contraseña?</a><br>
        <hr>
        <button type="submit">Iniciar Sesion</button>
        <a href="Registro.html">Crear Cuenta</a>

    </form>
</body>
</html>