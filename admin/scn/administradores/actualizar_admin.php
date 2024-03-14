<?php
// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include("../connect.php");

    // Obtener los datos del formulario
    $id = $_POST["id"]; // Asegúrate de agregar un campo oculto con el ID del administrador en el formulario de edición
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];

    // Preparar la consulta SQL para actualizar los datos del administrador
    $sql = "UPDATE admins SET nombre = '$nombre', usuario = '$usuario', correo_electronico = '$correo', fecha_nacimiento = '$fecha_nacimiento' WHERE id = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de edición con un parámetro de consulta para indicar éxito
        header("Location: administrator.php?good=1&id=$id");
        exit();
    } else {
        // Redirigir a la página de edición con un parámetro de consulta para indicar error
        header("Location: editar_admin.php?error=1&id=$id");
        exit();
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se ha enviado el formulario, redirigir al usuario a la página de edición
    header("Location: editar_admin.php");
    exit();
}
?>
