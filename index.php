<?php
session_start();

// Verificar si el usuario no está autenticado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

// Obtener todas las publicaciones con detalles del autor
$sql = "SELECT p.*, a.adminuser as autor_username, a.fotoadm as autor_foto
        FROM publicaciones p
        INNER JOIN administrador a ON p.autor_id = a.idadmin
        ORDER BY p.fecha_publicacion DESC";

$resultado = mysqli_query($conn, $sql);

// Verificar si hay resultados
if (!$resultado) {
    die('Error al ejecutar la consulta: ' . mysqli_error($conn));
}

// Ahora puedes usar $usuarioId y $username en tu página según sea necesario.
$usuarioId = $_SESSION["usuario_id"];
$username = $_SESSION["username"];

$requestUri = $_SERVER['REQUEST_URI'];

// Obtén el nombre del archivo actual (última parte de la ruta)
$filename = basename(__FILE__);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Awesome Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/.css">

    <style>



    </style>
</head>

<body>

    <!-- Barra de navegación principal -->
    <nav class="menu navbar">
        <a href="#" class="navbar-brand">
            <div class="null">
                
                <span class="ms-2" style="color:white;"> NULL,;</span>
            </div>
        </a>
<!-- Enlaces del menú principal con iconos -->
<div class="menu-links" id="menu-links">
    <a href=""><i class="fas fa-home"></i> Inicio</a>
    
    <!-- Enlace "Perfil" con submenú -->
    <div class="menu-with-submenu">
        <a href="#"><i class="fas fa-user"></i> Perfil</a>
        <ul class="submenu">
            <li><a href="nodos/perfil.php"><i class="fas fa-user"></i> Tu cuenta</a></li>
            <li><a href="#"><i class="fas fa-file-alt"></i> Mis publicaciones</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Configuración</a></li>
        </ul>
    </div>
    
    <a href="#"><i class="fas fa-chart-bar"></i> Informe</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
</div>
    </nav>


    <div id="custom-alert" class="alert alert-dismissible fade show" role="alert">
                    <div class="alert-inner">
                        <h4>¡Bienvenido, <?php echo $username; ?>!</h4>
                        Esperamos que tengas una gran experiencia en nuestro sitio.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

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
            <a href="#"><i class="fas fa-home"></i> Inicio</a>
            <a href="nodos/perfil.php"><i class="fas fa-user"></i> Perfil</a>
            <a href="#"><i class="fas fa-chart-bar"></i> Informe</a>
            <a href="nodos/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </div>
    </div>


<!-- Mostrar las publicaciones -->
<div class="publicaciones-container">
<?php while ($fila = mysqli_fetch_assoc($resultado)) : ?>
    <a href="noticias/detalles.php?id=<?php echo $fila['id']; ?>" class="card-link">

    <div class="card">
        <div class="card-header">
            <?php
            $imagenPerfil = (!empty($fila['autor_foto'])) ? 'data:image/jpeg;base64,' . base64_encode($fila['autor_foto']) : 'ruta/de/imagen/por/defecto.jpg';
            ?>
            <img src="<?php echo $imagenPerfil; ?>" alt="Foto de perfil del autor" class="UserImage">
            <div class="UserInfo">
                <span class="Username"><?php echo $fila['autor_username']; ?></span>
                <span class="PostDate">Publicado el <?php echo $fila['fecha_publicacion']; ?></span>
            </div>
        </div>
        <div class="card-body">
            <h2 class="PostTitle"><?php echo $fila['titulo']; ?></h2>
            <p class="PostContent"><?php echo $fila['contenido']; ?></p>
            <?php if (!empty($fila['foto'])) : ?>
                <img src="nodos/uploadglobal/<?php echo $fila['foto']; ?>" class="PostImage" alt="Foto de la publicación">
            <?php endif; ?>
        </div>
    </div>
    <div style="clear: both;"></div> <!-- Agrega esta línea después de cada publicación -->
            </a>
<?php endwhile; ?>
            </div>
<!-- ... (resto del script JS y cierre del cuerpo y HTML) ... -->

</body>

</html>
