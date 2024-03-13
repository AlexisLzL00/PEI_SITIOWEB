<?php
include("../conexion.php");

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica si se enviaron datos de usuario y contraseña
if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    // Obtiene los valores enviados
    $username = $_POST['usuario'];
    $password = $_POST['contrasena'];

    // Prepara la consulta para obtener la contraseña almacenada
    $sql = "SELECT id, contrasena FROM admins WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($admin_id, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verifica si el usuario existe y la contraseña es correcta
    if ($hashed_password && password_verify($password, $hashed_password)) {
        // Inicio de sesión exitoso, puedes almacenar información de sesión si es necesario
        session_start();
        $_SESSION['admin_id'] = $admin_id;

        // Redirige a la página de bienvenida o realiza las acciones necesarias
        header('Location: ../admin/Dashboard.php');
        exit();
    } else {
        // Usuario o contraseña incorrectos, redirige a admin.php con el parámetro de error
        header('Location: admin.php?error=utx');
        exit();
    }
} else {
    // Si no se enviaron datos, redirige a la página de login
    header('Location: admin.php');
    exit();
}

// Cierra la conexión a la base de datos
$conn->close();
?>
