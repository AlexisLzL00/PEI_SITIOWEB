<?php
// Incluir el archivo de conexión y funciones
include "../conexion.php";
include "funciones.php";
include "../autorizarborradores/funciones.php";

// Verificar la sesión del administrador
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir si no hay sesión activa
    exit();
}

// Obtener el ID de la sesión del administrador
$autorId = $_SESSION['user_id'];

// Obtener todos los borradores del autor
$borradores = obtenerBorradoresPorAutor($autorId);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/noticias.css"> <!-- Agrega la ruta correcta a tu archivo CSS -->
    <title>Borradores</title>
</head>
<body>

    <!-- Contenido de seccionborrador.php -->
    <div class="card">
        <h2 class="PostTitle">Borradores</h2>

        <?php
        // Mostrar mensajes de retroalimentación
        if (isset($mensaje)) {
            echo "<p class='Mensaje'>$mensaje</p>";
        }
        ?>

        <?php if (!empty($borradores)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Fecha de Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($borradores as $borrador) : ?>
                        <tr>
                            <td><?php echo $borrador['titulo']; ?></td>
                            <td><?php echo $borrador['fecha_creacion']; ?></td>
                            <td>
                                <a href="visualborrador.php?id=<?php echo $borrador['id']; ?>">Ver</a>
                                <a href="editar_borrador.php?id=<?php echo $borrador['id']; ?>">Editar</a>
                                <a href="eliminarborrador.php?id=<?php echo $borrador['id']; ?>">Eliminar</a>
                                
                                <!-- Formulario para enviar solicitud de autorización -->
                                <form action="../autorizarborradores/adminautorizerborrador.php" method="post">
                                    <input type="hidden" name="borrador_id" value="<?php echo $borrador['id']; ?>">
                                    <input type="hidden" name="admin_id" value="<?php echo $adminIdActual; ?>">
                                    <button type="submit" name="accion" value="solicitar_autorizacion_borrador">Solicitar Autorización</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No hay borradores disponibles.</p>
        <?php endif; ?>
    </div>

</body>
</html>

