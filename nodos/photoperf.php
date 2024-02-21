<?php
// Conectar a la base de datos (incluye tu archivo de conexión)
include '../conexion.php';

// Obtener el ID del usuario y validar
if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Consultar la imagen desde la base de datos
    $sql = "SELECT foto FROM administrador WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($imagen);
        $stmt->fetch();
        $stmt->close();

        // Verificar si la imagen no está vacía
        if (!empty($imagen)) {
            // Obtener el tipo de contenido (MIME type)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $imagen);
            finfo_close($finfo);

            // Establecer el tipo de contenido
            header('Content-Type: ' . $mimeType);
            
            // Establecer la longitud total de los datos de la imagen
            header('Content-Length: ' . strlen($imagen));
            
            // Mostrar la imagen
            echo $imagen;
            exit();
        }
    }
}

// Si no se encuentra la imagen, puedes mostrar una imagen predeterminada o redirigir a una página de error
header("Location: default_image.jpg");
exit();
?>
