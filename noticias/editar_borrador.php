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

// Verificar si se proporciona un ID de borrador a editar
if (isset($_GET['id'])) {
    $borradorId = $_GET['id'];

    // Obtener la información actual del borrador
    $borradorActual = obtenerInformacionBorrador($borradorId);

    if (!$borradorActual) {
        $mensaje = "Error: No se pudo obtener la información del borrador.";
        header("Location: seccionborrador.php?mensaje=" . urlencode($mensaje));
        exit();
    }

// Manejar el envío del formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y procesar la información del formulario
    if (isset($_POST['titulo'], $_POST['contenido'])) {
        $tituloNuevo = $_POST['titulo'];
        $contenidoNuevo = $_POST['contenido'];

        // Actualizar la información del borrador en la base de datos
        if (editarBorrador($borradorId, $tituloNuevo, $contenidoNuevo)) {
            $mensaje = "Borrador editado correctamente.";
        } else {
            $mensaje = "Error al editar el borrador.";
        }
    } else {
        $mensaje = "Error: Todos los campos son obligatorios.";
    }

    // Redirigir a seccionborrador.php con el mensaje
    header("Location: seccionborrador.php?mensaje=" . urlencode($mensaje));
    exit();
}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/noticias.css">
    <link rel="stylesheet" href="../css/borrador.css">
    <title>Editar Borrador</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/lffwbbwbwbtylb17rm6wsrrbmekf5bx4hiinxg7gtnhxttuv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            height: 300,
            plugins: 'image',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | image',
            automatic_uploads: true,
            images_upload_url: 'upload_images.php', // Ruta del script para subir imágenes
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function () {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }
        });
    </script>
</head>
<body>

    <!-- Contenido de editar_borrador.php -->
    <div class="card">
        <h2 class="PostTitle">Editar Borrador</h2>

        <?php
        // Mostrar mensajes de retroalimentación
        if (isset($mensaje)) {
            echo "<p class='Mensaje'>$mensaje</p>";
        }
        ?>

        <form action="editar_borrador.php?id=<?php echo $borradorId; ?>" method="post">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($borradorActual['titulo']); ?>" required>

            <label for="contenido">Contenido:</label>
            <textarea id="editor" name="contenido"><?php echo htmlspecialchars($borradorActual['contenido']); ?></textarea>

            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

</body>
</html>
