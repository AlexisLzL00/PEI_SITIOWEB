<?php
// Incluir el archivo de conexión y funciones
include "../conexion.php";
include "funciones.php";

// Verificar la sesión del administrador
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir si no hay sesión activa
    exit();
}

// Verificar si se proporciona un ID de borrador a eliminar
if (isset($_GET['id'])) {
    $borradorId = $_GET['id'];

    // Eliminar el borrador de la base de datos
    if (eliminarBorrador($borradorId)) {
        $mensaje = "Borrador eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar el borrador.";
    }
} else {
    $mensaje = "ID de borrador no proporcionado.";
}

// Redirigir a la página de sección de borradores con el mensaje
header("Location: seccionborrador.php?mensaje=" . urlencode($mensaje));
exit();
?>
