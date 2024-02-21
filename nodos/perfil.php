<?php
// Recuperar la información de la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION["user_id"];
$Username = $_SESSION["adminuser"];

// Conectar a la base de datos (incluye tu archivo de conexión)
include '../conexion.php';

// Obtener información actual del usuario, incluida la imagen almacenada como blob
$sql = "SELECT descripcion, fotoadm, correo FROM administrador WHERE idadmin = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($descripcion, $foto, $correo);
    $stmt->fetch();
    $stmt->close();
}

// Verificar si la imagen no está vacía
if (!empty($foto)) {
    // Convertir los datos binarios de la imagen a una representación base64
    $imagenBase64 = base64_encode($foto);
    $imagenSrc = "data:image/png;base64," . $imagenBase64;
} else {
    // Si no hay imagen, puedes establecer una imagen predeterminada
    $imagenSrc = "../photos/avatar.png";
}


$requestUri = $_SERVER['REQUEST_URI'];

// Obtén el nombre del archivo actual (última parte de la ruta)
$filename = basename(__FILE__);

// Si la URL es index.php y hay algo después de la barra, redirige a la versión sin ese "algo"
if ($filename === 'perfil.php' && strpos($requestUri, '/perfil.php/') !== false) {
    $correctedUrl = rtrim(str_replace('/perfil.php/', '/perfil.php', $requestUri), '/');
    header("Location: $correctedUrl");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Awesome Website</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>    
    <link rel="stylesheet" href="../css/barra.css">

    <style>
        

    </style>
</head>

<body>
    <!-- Barra de navegación principal -->
    <nav class="menu navbar">
        <a href="#" class="navbar-brand">
            <div class="null">
                <img src="../photos/perf.png" alt="Logo">
                <span class="ms-2" style="color:white;"> NULL,;</span>
            </div>
        </a>
<!-- Enlaces del menú principal con iconos -->
<div class="menu-links" id="menu-links">
    <a href="../index.php"><i class="fas fa-home"></i> Inicio</a>
    
    <!-- Enlace "Perfil" con submenú -->
    <div class="menu-with-submenu">
        <a href="#"><i class="fas fa-user"></i> Perfil</a>
        <ul class="submenu">
            <li><a href="#"><i class="fas fa-user"></i> Tu cuenta</a></li>
            <li><a href="publicaciones.php"><i class="fas fa-file-alt"></i> Mis publicaciones</a></li>
            <li><a href="#"><i class="fas fa-play"></i> videos</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Configuración</a></li>
        </ul>
    </div>
    
    <a href="#"><i class="fas fa-chart-bar"></i> Informe</a>
    <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
</div>
    </nav>

    <!-- Botón de hamburguesa para dispositivos responsivos -->
    <div class="menu-toggle-responsive" id="mobile-menu-toggle">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <!-- Barra de navegación responsiva -->
    <div class="menu-responsive" id="mobile-menu">
        <div class="menu-responsive-content">
            <!-- Enlaces de la barra de navegación responsiva -->
            <a href="../index.php"><i class="fas fa-home"></i> Inicio</a>
            <a href="#"><i class="fas fa-user"></i> Perfil</a>
            <a href="#"><i class="fas fa-chart-bar"></i> Informe</a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </div>
    </div>

    <!-- Contenido principal de la página -->
    <div class="container rounded" id="content">
        <div class="row mt-3">
            <div class="col-md-12">
                <h2 class="text-light">Usuario : <?php echo $Username; ?></h2>
                <p>Nuevo Comienzo.</p>
                <!-- Agrega el alert personalizado u otro contenido según sea necesario -->
                
                <!-- Mostrar información adicional en una card -->
                <div class="card text-center animate__animated animate__fadeIn">
                <!-- Colocar la foto en el centro de la card -->
                <div class="mt-3">

                <img src="<?php echo $imagenSrc; ?>" alt="Imagen de perfil" style="max-width: 150px; height: 150px; border-radius: 50%;">

                </div>

                <!-- Cuerpo de la card para mostrar el resto de la información -->
                <div class="card-body">
                    <!-- Agregar el nombre de usuario -->
                    <h3 class="mt-3"><?php echo $Username; ?></h3>
                    <p><strong>Correo Electrónico:</strong> <?php echo $correo; ?></p>
                    <p><strong>Descripción:</strong> <?php echo $descripcion; ?></p>
                </div>

                <!-- Botón de edición -->
                <div class="card-footer">
                    <button class="btn btn-primary" onclick="window.location.href='perfiledit.php'">Editar Información</button>
                </div>
            </div>
                <!-- Otro contenido de la página -->
            </div>
        </div>
    </div>

    <?php
if (isset($_GET['status']) && $_GET['status'] == 'error') {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Se ha producido un error. Por favor, inténtalo de nuevo más tarde.',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'error-popup', // Clase personalizada para el estilo de error
                    title: 'error-title',
                    content: 'error-content',
                    confirmButton: 'error-confirm-button',
                }
            }).then(() => {
                window.location.href = 'perfil.php';
            });
          </script>";
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuWithSubmenu = document.querySelector('.menu-with-submenu');
        const submenu = menuWithSubmenu.querySelector('.submenu');

        menuWithSubmenu.addEventListener('click', function (e) {
            e.stopPropagation(); // Evitar que el clic llegue al documento y cierre el submenú
            submenu.classList.toggle('active');
        });

        // Cerrar el submenú si se hace clic fuera de él
        document.addEventListener('click', function () {
            submenu.classList.remove('active');
        });
    });
</script>

    <script>
        // Verificar si hay un parámetro 'status' en la URL y es 'success'
        const urlParams = new URLSearchParams(window.location.search);
        const statusParam = urlParams.get('status');

        if (statusParam === 'success') {
            // Mostrar el mensaje de éxito
            Swal.fire({
                icon: 'success',
                title: 'Éxito :)',
                text: '¡Perfil actualizado con éxito!',
                confirmButtonText: 'OK',
                // Puedes agregar más opciones de configuración según tus necesidades
            }).then(() => {
                // Redirigir a la misma URL sin el parámetro 'status'
                window.location.href = window.location.origin + window.location.pathname;
            });
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            var mobileMenu = document.getElementById('mobile-menu');

            mobileMenuToggle.addEventListener('click', function () {
                if (mobileMenu) {
                    mobileMenu.classList.toggle('active');
                    mobileMenuToggle.classList.toggle('active');
                }
            });
        });
    </script>

    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>