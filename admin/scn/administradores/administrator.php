<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Administradores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="css/tabla_admins.css">
    <style>
        body {
            padding-top: 56px; /* Altura del navbar */
        }

        @media (max-width: 576px) {
            body {
                padding-top: 0;
            }

            .card {
                padding: 10px;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .card-text {
                font-size: 1rem;
            }

            .btn {
                font-size: 0.9rem;
            }
        }

        .container {
            margin-left: 7rem;
        }

        main {
            margin-top: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: #666;
        }

        .btn {
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<?php include '../sidebars/sidebar_admin.php'; ?>

<main class="container">
    <h2 class="mb-4">Lista de Administradores</h2>
    <div class="row justify-content-center">
        <?php
        // Incluir el archivo de conexión a la base de datos
        include("../connect.php");

        // Consulta para obtener todos los administradores
        $sql = "SELECT id, usuario, correo_electronico, nombre, fecha_nacimiento FROM admins";
        $result = $conn->query($sql);

        // Mostrar los datos de los administradores en tarjetas
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card'>";
                echo "<h5 class='card-title'><i class='fas fa-user'></i> ID: " . $row["id"] . "</h5>";
                echo "<p class='card-text'><i class='fas fa-user'></i> Usuario: " . $row["usuario"] . "</p>";
                echo "<p class='card-text'><i class='fas fa-envelope'></i> Correo Electrónico: " . $row["correo_electronico"] . "</p>";
                echo "<p class='card-text'><i class='fas fa-address-card'></i> Nombre: " . $row["nombre"] . "</p>";
                echo "<p class='card-text'><i class='fas fa-birthday-cake'></i> Fecha de Nacimiento: " . $row["fecha_nacimiento"] . "</p>";
                echo "<a href='editar_admin.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fas fa-edit'></i> Editar</a>";
                echo "<a href='eliminar_admin.php?id=" . $row["id"] . "' class='btn btn-danger'><i class='fas fa-trash'></i> Eliminar</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='col-md-12'><p>No se encontraron administradores.</p></div>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </div>
</main>

<?php
// Mostrar alerta si hay parámetros en la URL indicando éxito o error
if(isset($_GET['good'])) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'Los datos del administrador se han actualizado correctamente.',
                showConfirmButton: false,
                timer: 3000
            });
          </script>";
} elseif(isset($_GET['error'])) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Ha ocurrido un error al actualizar los datos del administrador.',
                showConfirmButton: false,
                timer: 3000
            });
          </script>";
}
?>

</body>
</html>
