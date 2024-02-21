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

$autorId = $_SESSION['user_id']; // Obtener el ID de la sesión del administrador

// Manejar el envío de formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y procesar la información del borrador (título y contenido)
    if (isset($_POST['titulo'], $_POST['contenido'])) {
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];

        // Insertar el borrador en la base de datos
        $borradorId = insertarBorrador($titulo, $contenido, $autorId);

        // Subir y asociar imágenes con el borrador
        if (!empty($_FILES['imagenes']['name'][0])) {
            $imagenes = subirImagenes($borradorId, $_FILES['imagenes']);
            asociarImagenesBorrador($borradorId, $imagenes);
        }

        // Mensaje de éxito
        $mensaje = "Borrador guardado correctamente.";
    } else {
        // Mensaje de error si faltan campos
        $mensaje = "Error: Todos los campos son obligatorios.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/noticias.css"> <!-- Agrega la ruta correcta a tu archivo CSS -->

    <!-- Otros enlaces y metaetiquetas que puedas necesitar -->
    <title>Crear Borrador</title>
</head>
<body>

    <!-- Contenido de borrador.php -->
    <div class="card">
        <h2 class="PostTitle">Crear Borrador</h2>

        <?php
        // Mostrar mensajes de retroalimentación
        if (isset($mensaje)) {
            echo "<p class='Mensaje'>$mensaje</p>";
        }
        ?>

        <form action="borrador.php" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>

            <label for="contenido">Contenido:</label>
            <textarea id="editor" name="contenido"></textarea>

            <div class="uploaded-images" id="preview-container"></div>

            <input type="submit" value="Guardar Borrador">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/lffwbbwbwbtylb17rm6wsrrbmekf5bx4hiinxg7gtnhxttuv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#editor',
            height: 300,
            plugins: 'image',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | image',
            automatic_uploads: true,
            images_upload_url: 'upload_images.php', // Cambia 'tu_ruta_especifica' por la ruta deseada
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function () {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function () {
                        // Eliminamos la generación de base64 y utilizamos directamente el archivo
                        cb(file);
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }
        });
    </script>

</body>
</html>
