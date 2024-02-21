<?php
// Ruta donde se guardarán las imágenes
$rutaDestino = 'imagenes/';  // Ajusta la ruta según tu estructura de directorios

// Verificar si se enviaron archivos
if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
    $nombreArchivo = $_FILES['file']['name'];
    $rutaCompleta = $rutaDestino . $nombreArchivo;

    // Mover el archivo al destino
    if (move_uploaded_file($_FILES['file']['tmp_name'], $rutaCompleta)) {
        // Enviar la ruta del archivo al editor
        echo json_encode(['location' => $rutaCompleta]);
    } else {
        // Error al mover el archivo
        echo json_encode(['error' => 'Error al subir la imagen.']);
    }
} else {
    // No se recibieron archivos
    echo json_encode(['error' => 'No se recibió ninguna imagen.']);
}
?>
