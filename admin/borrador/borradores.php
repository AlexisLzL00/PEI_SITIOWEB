<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borradores - Editor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="css/sidebar.css">
    <!DOCTYPE html>
<html lang="es">
<head>
    <!-- Otras etiquetas head... -->

    <style>
        body {
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #007bff;
        }

        /* Estilo del editor */
        #editor-container {
            position: relative;
            z-index: 1; /* Establece el z-index a 1 */
        }

        #editor {
            width: 100%;
            height: 400px;
            margin-top: 20px;
            margin-left: auto;
            margin-right: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        /* Estilo del botón personalizado */
        .custom-toolbar button {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<?php include 'sidebar_borrador.php'; ?>

    <div class="container" id="editor-container">
        <!-- Contenido de la página -->
        <h1>Borradores - Editor</h1>
        <textarea id="editor"></textarea>
    </div>

    <script src="https://cdn.tiny.cloud/1/lffwbbwbwbtylb17rm6wsrrbmekf5bx4hiinxg7gtnhxttuv/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Inicializar TinyMCE con el plugin de imágenes -->
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'autoresize image',
            autoresize_bottom_margin: 16,
            toolbar_mode: 'sliding',
            menubar: false,
            statusbar: false,
            image_title: true,
            automatic_uploads: true,
            images_upload_url: 'upload.php', // Ruta del script para subir imágenes
            images_upload_base_path: '/uploads',
            images_upload_credentials: true,
            // Puedes personalizar más opciones según tus necesidades
        });
    </script>
</body>
</html>


    <!-- Scripts de Bootstrap (si no los tienes ya cargados) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
