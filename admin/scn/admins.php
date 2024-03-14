<?php
// Conexión a la base de datos (reemplaza los valores según tu configuración)
include("connect.php");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los administradores
$sql = "SELECT id, usuario, correo_electronico, nombre FROM admins";
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
<body>

<?php include 'sidebars/sidebar_admin.php'; ?>

<div class="container">
    <h2>Lista de Administradores</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Correo Electrónico</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar los datos de los administradores en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["usuario"] . "</td>";
                    echo "<td>" . $row["correo_electronico"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    // Agregar un enlace que redirija a administrator.php con el ID del administrador como parámetro
                    echo "<td><a href='administradores/administrator.php?id=" . $row["id"] . "'>Ver detalles</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron administradores.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Cerrar la conexión
$conn->close();
?>
</body>
</html>
