<?php
// Incluir el archivo de conexión y funciones
include "../conexion.php";
include "funciones.php";

// Obtener todas las publicaciones de noticiassixela
$publicaciones = obtenerTodasLasPublicaciones();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/noticias.css"> <!-- Ajusta la ruta correcta a tu archivo CSS -->
    <title>Noticias Sixela</title>
</head>
<body>

    <!-- Contenido de noticias.php -->
    <div class="card">
        <h2 class="PostTitle">Noticias Sixela</h2>

        <!-- Mostrar todas las publicaciones -->
        <?php if (!empty($publicaciones)) : ?>
            <ul>
                <?php foreach ($publicaciones as $publicacion) : ?>
                    <li>
                        <strong>Autor:</strong> <?php echo $publicacion['autor_id']; ?> |
                        <strong>Contenido:</strong> <?php echo $publicacion['contenido']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No hay publicaciones disponibles.</p>
        <?php endif; ?>

        <!-- Enlace para volver a la página principal -->
        <p><a href="index.php">Volver a la Página Principal</a></p>
    </div>

</body>
</html>
