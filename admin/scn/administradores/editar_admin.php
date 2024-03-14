<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Administrador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Estilos CSS */
        main.container {
            margin-top: 20px;
            margin-left: 220px; /* Ancho del sidebar */
        }

        @media (max-width: 768px) {
            main.container {
                margin-left: 80px;
            }
        }
    </style>
</head>
<body>

<?php include '../sidebars/sidebar_admin.php'; ?>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="card-title mb-0">Editar Administrador</h2>
                </div>
                <div class="card-body">
                    <?php
                    // Verificar si se ha pasado un ID de administrador por GET
                    if(isset($_GET['id'])) {
                        // Obtener el ID del administrador desde la URL
                        $id = $_GET['id'];

                        // Consulta SQL para obtener los datos del administrador
                        include("../connect.php");
                        $sql = "SELECT * FROM admins WHERE id = $id";
                        $result = $conn->query($sql);

                        // Verificar si se encontró el administrador
                        if ($result->num_rows > 0) {
                            // Mostrar el formulario con los datos del administrador
                            $row = $result->fetch_assoc();
                            ?>
                            <form action="actualizar_admin.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del administrador" value="<?php echo $row['nombre']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese el nombre de usuario" value="<?php echo $row['usuario']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo Electrónico:</label>
                                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese el correo electrónico" value="<?php echo $row['correo_electronico']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save mr-1"></i>Guardar Cambios</button>
                                <a href="administrator.php" class="btn btn-secondary"><i class="fas fa-times mr-1"></i>Cancelar</a>
                            </form>
                            <?php
                        } else {
                            // Si no se encontró el administrador, mostrar un mensaje de error
                            echo "<p>No se encontró el administrador.</p>";
                        }
                    } else {
                        // Si no se ha pasado un ID de administrador por GET, mostrar un mensaje de error
                        echo "<p>No se ha especificado un ID de administrador.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
