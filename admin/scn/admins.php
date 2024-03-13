<?php
// Conexión a la base de datos (reemplaza los valores según tu configuración)
include("connect.php");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los administradores
$sql = "SELECT * FROM admins";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/tabla_admins.css">
    <title>Lista de Administradores</title>
</head>
<style>
    body {
    padding-top: 56px; /* Altura del navbar */
}

@media (max-width: 576px) {
    body {
        padding-top: 0;
    }
}

.container {
    margin-left: 7rem;
}

</style>
    <title>Lista de Administradores</title>
</head>
<body>

<?php include 'sidebars/sidebar_admin.php'; ?>

<?php
// Cerrar la conexión
$conn->close();
?>
