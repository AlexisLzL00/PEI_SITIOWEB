<?php
// Inicia la sesión en la parte superior del archivo
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['admin_id'])) {
    // Si no está autenticado, redirige a la página de inicio de sesión u otra página de autenticación
    header("Location: login.php"); // Ajusta el nombre de la página de inicio de sesión según tu estructura de archivos
    exit();
}

// Obtén el ID de administrador de la sesión

$admin_id = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Incluye la biblioteca de Bootstrap (CDN) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Incluye Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Incluye el archivo de estilos personalizados -->
    <link rel="stylesheet" href="../css/sidebar.css">
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluye tu archivo de estilos si es necesario -->
</head>
<body>

<?php include 'sidebar.php'; ?>


</body>
</html>
