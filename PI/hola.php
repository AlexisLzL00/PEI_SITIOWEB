<?php

    session_start();

    if(!isset($_SESSION['Nombres'])){
        echo '
            <script>
                alert("Porfavor debes iniciar sesion");
                window.location = "login.php";
            </script>
        ';
        session_destroy();
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hola mundo</h1>
    <a href="cerrar_sesion.php">cerrar sesion</a>
</body>
</html>