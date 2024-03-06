<?php
    include 'conexion.php';
    $usuario = $_POST["Nombres"];
    $ApellidoPaterno = $_POST["ApellidoPaterno"];
    $Correo = $_POST["Correo"];
    $contrasena = $_POST["Password"];

    $contrasena = hash('sha512', $contrasena);


    

    $query = "INSERT INTO usuarios (Nombres, ApellidoPaterno, Correo, Password) 
              VALUES ('$usuario', '$ApellidoPaterno', '$Correo', '$contrasena')";       

    $ejecutar = mysqli_query($base, $query);


    if($ejecutar){
        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location = "login.php";
            </script>
        ';
    }
    else{
        echo '
            <script>
                alert("Intentalo de nuevo, usuario no almacenado");
                window.location = "login.php";
            </script>
        ';
    }
    mysqli_close($base);
?>

