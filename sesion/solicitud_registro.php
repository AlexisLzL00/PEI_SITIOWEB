<?php
// Incluye el archivo de conexión a la base de datos
include("../conexion.php");

// Recibe los datos del formulario
$username = $_POST['username'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encripta la contraseña
$alias = generarAliasUnico(); // Genera un alias único

// Agrega campos adicionales como fecha de nacimiento y fecha de registro
$fechaNacimiento = $_POST['fecha_nacimiento'];
$fechaRegistro = date('Y-m-d H:i:s'); // Fecha y hora actual en formato MySQL

// Realiza la inserción en la base de datos utilizando consultas preparadas
$stmt = $conn->prepare("INSERT INTO usuarios (username, nombre, correo, contrasena, alias, fecha_nacimiento, fecha_registro) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $username, $nombre, $correo, $password, $alias, $fechaNacimiento, $fechaRegistro);

if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error al registrar el usuario: " . $stmt->error;
}

$stmt->close();

// Cierra la conexión a la base de datos (importante para evitar posibles problemas)
$conn->close();

// Función para generar un alias único (puedes adaptarla según tus necesidades)
function generarAliasUnico() {
    // Implementa tu lógica para generar un alias único aquí
    // Puedes usar funciones como uniqid() o generar algo basado en el nombre de usuario, etc.
    return "aliasUnico"; // Cambia esto según tu lógica
}
?>
