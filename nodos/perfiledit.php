<?php
session_start();


// Configurar tiempo de espera en MySQL a 60 segundos
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

// Verificar la autenticación del usuario
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION["user_id"];
$Username = $_SESSION["adminuser"];

// Conexión a la base de datos (incluye tu archivo de conexión)
include '../conexion.php';

// Obtener información actual del usuario
$sql = "SELECT descripcion, foto FROM administrador WHERE idadmin = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($descripcion, $foto);
    $stmt->fetch();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nuevaDescripcion = $_POST["nueva_descripcion"];

    // Procesar la subida de la nueva foto (si se proporciona)
    $imagenData = $foto; // Por defecto, mantén la foto actual

    if ($_FILES["nueva_foto"]["size"] > 0) {
        // Obtener datos de la imagen
        $imagenTmp = $_FILES["nueva_foto"]["tmp_name"];
        $imagenType = $_FILES["nueva_foto"]["type"];

        // Validar que sea una imagen
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($imagenType, $allowedTypes)) {
            // Convertir la imagen a datos binarios
            $imagenData = file_get_contents($imagenTmp);
        } else {
            // Manejar error si el archivo no es una imagen válida
            echo "Error: Por favor, sube una imagen válida.";
            exit();
        }
    }

   // Actualizar la información en la base de datos
    $sql = "UPDATE administrador SET descripcion=?, foto=? WHERE idadmin=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssi", $nuevaDescripcion, $imagenData, $userId);
        $stmt->execute();
        $stmt->close();

        // Redirigir a la página de perfil con mensaje de éxito
        header("Location: perfil.php?status=success");
        exit();
    } else {
        // Manejar error si hay un problema con la consulta
        $errorMsg = "Error en la consulta SQL.";
        header("Location: perfil.php?status=error");
        exit();
    }

    } 

?>



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