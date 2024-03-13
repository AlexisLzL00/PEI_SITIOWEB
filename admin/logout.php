<?php
session_start(); // Inicia la sesión

// Elimina todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirecciona al formulario de inicio de sesión
header('Location: ../sesion_admin/admin.php');
exit();
?>
