<?php
// perfil.php
// Conexión a la base de datos (reemplaza los valores según tu configuración)
include("../conexion.php");
session_start(); // Inicia la sesión si no está iniciada

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Consulta para obtener la información del usuario
    $consulta = "SELECT * FROM usuarios WHERE username = '$username'";
    $resultado = $conn->query($consulta);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
    } else {
        // Manejo de error si no se encuentra el usuario
        echo "Usuario no encontrado";
        exit();
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    

    <style>

    </style>
    <title>Progrsolab</title>
</head>
<style>
    .profile-img {
        max-width: 100%;
        height: auto;
        border: 5px solid #fff; /* Agrega un borde blanco alrededor de la imagen */
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Agrega una sombra suave */
        transition: transform 0.3s ease-in-out; /* Agrega una transición suave al hacer hover */
    }

    .profile-img:hover {
        transform: scale(1.1); /* Hace la imagen un poco más grande al hacer hover */
    }
</style>
<body>

 <!--   <header>
        <div class="header-content">
        </div> 
    </header> -->

    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#">
            <img src="../img/a.png" alt="Logo" class="img-fluid">
            Progrsolab
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="perfil.php"><i class="fas fa-user"></i> Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-cog"></i> Configuración</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Perfil de Usuario</h2>
                <a href="editar.php" class="btn btn-primary"><i class="fas fa-edit"></i> Editar Perfil</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?php
                    if (!empty($usuario['foto_perfil'])) {
                        echo '<img src="' . $usuario['foto_perfil'] . '" alt="Foto de perfil" class="img-fluid rounded-circle profile-img">';
                    } else {
                        echo '<p class="text-center">No hay foto de perfil</p>';
                    }
                    ?>
                </div>
                <div class="col-md-8 d-flex align-items-center">
                    <div>
                        <h3 class="card-title"><?php echo $usuario['nombre']; ?></h3>
                        <p class="card-text"><i class="fas fa-user"></i> <?php echo $usuario['username']; ?></p>
                        <p class="card-text"><i class="fas fa-envelope"></i> <?php echo $usuario['correo']; ?></p>
                        <p class="card-text"><i class="fas fa-at"></i> <?php echo $usuario['alias']; ?></p>
                        <p class="card-text"><i class="fas fa-birthday-cake"></i> <?php echo $usuario['fecha_nacimiento']; ?></p>
                        <!-- Agrega más campos según tus necesidades -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarIcon = document.querySelector('.navbar-toggler-icon');

            navbarToggler.addEventListener('click', function () {
                navbarIcon.classList.toggle('active');
            });
        });
    </script>
</body>

</html>
