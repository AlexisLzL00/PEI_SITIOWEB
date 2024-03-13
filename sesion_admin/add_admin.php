<?php

include("../conexion.php");


// Datos del nuevo administrador (reemplaza con los valores deseados)
$usuario = "AlexisLzL";
$nombre = "Alexis";
$correo_electronico = "achavez63@ucol.mx";
$contrasena = password_hash("a", PASSWORD_DEFAULT); // Genera el hash de la contraseña 'a'
$fecha_nacimiento = "2005-08-12"; // Cambia la fecha según sea necesario

// Prepara la consulta para insertar el nuevo administrador
$sql = "INSERT INTO admins (usuario, nombre, correo_electronico, contrasena, fecha_nacimiento) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $usuario, $nombre, $correo_electronico, $contrasena, $fecha_nacimiento);

// Ejecuta la consulta
if ($stmt->execute()) {
    echo "Nuevo administrador creado exitosamente.";
} else {
    echo "Error al crear el administrador: " . $stmt->error;
}

// Cierra la conexión a la base de datos
$stmt->close();
$conn->close();
?>