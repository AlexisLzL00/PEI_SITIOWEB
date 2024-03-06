<?php 

    session_start();

    include 'conexion.php';

    $Usuario = $_POST['Nombres'];
    $contrasena = $_POST['Password'];
    $contrasena = hash('sha512', $contrasena);

    $validar_login = mysqli_query($base, "SELECT * FROM usuarios WHERE Nombres='$Usuario' and Password='$contrasena'");

    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['Nombres'] = $Usuario;
        header("location: hola.php");
        exit;
    } else{
            echo '
                <script>
                    alert("Usuario no existe, porfavor verifique los datos introducidor");
                    window.location = "login.php";
                </script>    
            ';
            exit;
    }
?>