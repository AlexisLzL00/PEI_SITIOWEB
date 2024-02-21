<?php
session_start();

// Configurar tiempo de espera en MySQL a 60 segundos
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

// Verificar la autenticación del usuario
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$usuarioId = $_SESSION["usuario_id"];
$Username = $_SESSION["username"];

// Conexión a la base de datos (incluye tu archivo de conexión)
include '../conexion.php';

// Obtener información actual del usuario
$sql = "SELECT descripcion, foto FROM usuarios WHERE idusuario = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $usuarioId);
    $stmt->execute();
    $stmt->bind_result($descripcion, $foto);
    $stmt->fetch();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nuevaDescripcion = $_POST["nueva_descripcion"];

    // Procesar la subida de la nueva foto (si se proporciona)
    $imagenPath = $foto; // Por defecto, mantén la foto actual

    if (!empty($_FILES["nueva_foto"]["name"])) {
        // Directorio donde se guardan las fotos
        $targetDir = "fotosperfil/";

        // Ruta completa de la nueva foto
        $imagenPath = $targetDir . basename($_FILES["nueva_foto"]["name"]);

        // Subir la nueva foto al servidor
        move_uploaded_file($_FILES["nueva_foto"]["tmp_name"], $imagenPath);
    }

    // Actualizar la información en la base de datos
    $sql = "UPDATE usuarios SET descripcion=?, foto=? WHERE idusuario=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssi", $nuevaDescripcion, $imagenPath, $usuarioId);
        $stmt->execute();
        $stmt->close();

        // Redirigir a la página de perfil con mensaje de éxito
        header("Location: perfiluser.php?status=success");
        exit();
    } else {
        // Manejar error si hay un problema con la consulta
        $errorMsg = "Error en la consulta SQL.";
        header("Location: perfiluser.php?status=error");
        exit();
    }
}
?>

<!-- ... (tu código HTML) ... -->




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editperf.css">
    <title>Editar Perfil</title>

    <style>

    </style>
</head>
<body>

    <h1>Editar Perfil</h1>

    <?php
    // Mostrar mensajes de éxito o error
    if (!empty($errorMsg)) {
        echo "<p class='error'>$errorMsg</p>";
    }

    if (!empty($successMsg)) {
        echo "<p class='success'>$successMsg</p>";
        echo "<script>showSuccessAlert();</script>";
    }
    ?>

    <!-- Formulario de edición de perfil -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="nueva_foto">Nueva Foto de Perfil:</label>
        <label class="file-upload">
            <span></span>
            <input type="file" name="nueva_foto" accept="image/*">
            <img class="file-preview" id="file-preview" src="#" alt="">
        </label>

        <textarea name="nueva_descripcion" rows="4" placeholder="Nueva Descripción"><?php echo $descripcion; ?></textarea>

        <input type="submit" value="Actualizar Perfil">
    </form>

    <script>
        // Mostrar la vista previa de la imagen seleccionada
        const fileInput = document.querySelector('input[type="file"]');
        const filePreview = document.getElementById('file-preview');

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    filePreview.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Función para mostrar el alert de éxito
        function showSuccessAlert() {
            alert("¡Perfil actualizado con éxito!");
        }
    </script>

</body>
</html>