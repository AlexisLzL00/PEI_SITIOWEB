<?php
session_start(); // Inicia la sesión

include("../conexion.php");

// Recibir datos del formulario
$username = $_POST['username'];
$password = $_POST['contrasena'];

// Validar las credenciales (deberías implementar una lógica más segura, por ejemplo, utilizando consultas preparadas y verificando la contraseña hasheada)
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['contrasena'])) {
    // Credenciales válidas, se inicia la sesión
    $_SESSION['username'] = $username;

    // Redirecciona al área protegida (página de inicio de la aplicación, por ejemplo)
    header('Location: ../inicio/index.php');
    exit();
} else {
    // Credenciales incorrectas, redirecciona al formulario de inicio de sesión con un mensaje de error
    header('Location: login.php?error=1');
    exit();
}

$stmt->close();
$conn->close();
?>
