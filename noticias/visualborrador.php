<?php
// Incluir el archivo de conexión y funciones
include "../conexion.php";
include "funciones.php";

// Verificar la sesión del administrador
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir si no hay sesión activa
    exit();
}

// Obtener el ID del borrador desde la URL
if (isset($_GET['id'])) {
    $borradorId = $_GET['id'];

    // Obtener información del borrador
    $borrador = obtenerInformacionBorrador($borradorId);

    // Resto de tu código...
} else {
    // Redirigir si no se proporciona un ID de borrador
    header("Location: seccionborrador.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/noticias.css"> <!-- Agrega la ruta correcta a tu archivo CSS -->
    <link rel="stylesheet" href="../css/visualborrador.css"> <!-- Agrega la ruta correcta a tu archivo CSS -->
    <title>Visualizar Borrador</title>
</head>
<body>

    <!-- Contenido de visualborrador.php -->
    <div class="card">
        <h2 class="PostTitle">Visualizar Borrador</h2>

        <?php
        // Mostrar detalles del borrador
        if (isset($borrador)) {
            echo "<p>Título: {$borrador['titulo']}</p>";
            echo "<p>Autor: {$borrador['autor_username']}</p>";
            echo "<p>Contenido: {$borrador['contenido']}</p>";

            // Mostrar imágenes asociadas al borrador
            $imagenes = obtenerImagenesPorBorrador($borradorId);
            if (!empty($imagenes)) {
                echo "<h3>Imágenes Adjuntas:</h3>";
                foreach ($imagenes as $imagen) {
                    echo "<img src='{$imagen['ruta_imagen']}' alt='Imagen Adjunta'>";
                }
            }
        } else {
            echo "<p>No se encontró el borrador solicitado.</p>";
        }
        ?>

        <!-- Enlace para volver a la sección de borradores -->
        <a href="seccionborrador.php">Volver a la lista de borradores</a>
    </div>

    <!-- Otros elementos y scripts que puedas necesitar -->

</body>
</html>
