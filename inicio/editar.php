<?php
// editar.php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Progrsolab";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['username'];

// Obtener información del usuario
$consulta = "SELECT * FROM usuarios WHERE username = '$userId'";
$resultado = $conn->query($consulta);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    echo "Usuario no encontrado";
    exit();
}

// Manejar la actualización del perfil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y procesar la foto de perfil
    if ($_FILES['nueva_foto_perfil']['error'] == 0) {
        $rutaFotoPerfil = guardarFotoPerfil($_FILES['nueva_foto_perfil']);
    } else {
        // Si no se proporciona una nueva foto, mantener la existente
        $rutaFotoPerfil = $usuario['foto_perfil'];
    }

    // Obtener otros datos del formulario
    $nuevoNombre = $_POST['nuevo_nombre'];
    $nuevoCorreo = $_POST['nuevo_correo'];

    // Actualizar información del usuario
    $actualizarConsulta = "UPDATE usuarios SET nombre = '$nuevoNombre', correo = '$nuevoCorreo', foto_perfil = '$rutaFotoPerfil' WHERE username = '$userId'";
    $conn->query($actualizarConsulta);

    // Redirigir después de actualizar
    header("Location: perfil.php");
    exit();
}

// Función para guardar la foto de perfil
function guardarFotoPerfil($file) {
    $directorioSubida = 'fotosperf';
    $nombreArchivo = basename($file['name']);
    $rutaCompleta = $directorioSubida . '/' . $nombreArchivo;

    // Validar y mover la foto al directorio de subida
    if (move_uploaded_file($file['tmp_name'], $rutaCompleta)) {
        return $rutaCompleta;
    } else {
        echo "Error al subir la foto de perfil";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Perfil</title>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Editar Perfil</h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nueva_foto_perfil">Nueva Foto de Perfil:</label>
            <input type="file" class="form-control" id="nueva_foto_perfil" name="nueva_foto_perfil">
        </div>
        <div class="form-group">
            <label for="nuevo_nombre">Nuevo Nombre:</label>
            <input type="text" class="form-control" id="nuevo_nombre" name="nuevo_nombre" value="<?php echo $usuario['nombre']; ?>">
        </div>
        <div class="form-group">
            <label for="nuevo_correo">Nuevo Correo Electrónico:</label>
            <input type="email" class="form-control" id="nuevo_correo" name="nuevo_correo" value="<?php echo $usuario['correo']; ?>">
        </div>
        <!-- Agrega más campos según sea necesario -->

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
