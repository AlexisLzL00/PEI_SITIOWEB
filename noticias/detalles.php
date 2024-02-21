<?php
// Incluir el archivo de funciones y la conexión a la base de datos
include "../conexion.php";
include "funciones.php";

// Verificar si se proporciona un ID en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la URL
    $publicacionId = $_GET['id'];

    // Obtener la información de la publicación desde la base de datos
    $publicacion = obtenerInformacionPublicacion($publicacionId);

    if ($publicacion) { // Verificar si se obtuvo la información de la publicación
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/noticias.css">
    <title>Detalles de Publicación</title>
</head>
<body>

    <!-- Contenido de detalles.php -->
    <div class="card">
        <div class="card-header">
            <?php
            // Mostrar la imagen de perfil del autor si está presente
            $imagenPerfil = (!empty($publicacion['autor_foto'])) ? 'data:image/jpeg;base64,' . base64_encode($publicacion['autor_foto']) : 'ruta/de/imagen/por/defecto.jpg';
            ?>
            <img src="<?php echo $imagenPerfil; ?>" alt="Foto de perfil del autor" class="UserImage">
            <div class="UserInfo">
                <span class="Username"><?php echo $publicacion['autor_username']; ?></span>
                <span class="PostDate">Publicado el <?php echo $publicacion['fecha_publicacion']; ?></span>
            </div>
        </div>
        <div class="card-body">
            <h2 class="PostTitle"><?php echo $publicacion['titulo']; ?></h2>
            <p class="PostContent"><?php echo $publicacion['contenido']; ?></p>
            <div class="publi">
                <?php if (!empty($publicacion['foto'])) : ?>
                    <img src="../nodos/uploadglobal/<?php echo $publicacion['foto']; ?>" alt="Foto de la publicación" class="PostImage">
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php

    } else {
        // Manejar el caso en el que no se pudo obtener la información de la publicación
        echo "No se pudo obtener la información de la publicación.";
    }
} else {
    // Manejar el caso en el que no se proporciona un ID
    echo "No se proporcionó un ID de publicación.";
}
?>

</body>
</html>

