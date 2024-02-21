<?php
// Incluir el archivo de conexión
include "../conexion.php";

// Obtener información de un borrador por su ID
function obtenerInformacionBorrador($id) {
    global $conn;

    $consulta = $conn->prepare("SELECT b.*, a.adminuser as autor_username, a.fotoadm as autor_foto
            FROM borradores b
            INNER JOIN administrador a ON b.autor_id = a.idadmin
            WHERE b.id = ?
            LIMIT 1");
    $consulta->bind_param("i", $id);
    $consulta->execute();

    $resultado = $consulta->get_result();
    $borrador = $resultado->fetch_assoc();

    $consulta->close();

    return $borrador;
}

// Insertar un nuevo borrador en la base de datos
function insertarBorrador($titulo, $contenido, $autorId) {
    global $conn;

    // Insertar el borrador en la tabla borradores
    $consultaBorrador = $conn->prepare("INSERT INTO borradores (titulo, contenido, autor_id, fecha_creacion) VALUES (?, ?, ?, NOW())");
    $consultaBorrador->bind_param("ssi", $titulo, $contenido, $autorId);
    $consultaBorrador->execute();
    $borradorId = $consultaBorrador->insert_id;
    $consultaBorrador->close();

    return $borradorId;
}

// Obtener la lista de borradores pendientes de autorización
function obtenerBorradoresPendientes() {
    global $conn;

    // Asumiendo que hay una columna 'autor_id' en la tabla 'borradores' que se relaciona con 'administradores.id'
    $consulta = $conn->prepare("SELECT borradores.*, administrador.adminuser as autor_username 
                                FROM borradores 
                                LEFT JOIN administrador ON borradores.autor_id = administrador.idadmin
                                WHERE borradores.autorizado IS NULL");
    
    $consulta->execute();

    $resultado = $consulta->get_result();
    $borradores = $resultado->fetch_all(MYSQLI_ASSOC);

    $consulta->close();

    return $borradores;
}




// Agrega esta función para guardar una solicitud de autorización en la base de datos
function solicitarAutorizacionBorrador($borradorId, $adminId) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO solicitudes_autorizacion_borrador (borrador_id, admin_id, estado) VALUES (?, ?, 'pendiente')");
    $stmt->bind_param("ii", $borradorId, $adminId);
    $stmt->execute();
    $stmt->close();
}


// En tus funciones.php o archivo específico de funciones
function obtenerSolicitudesPendientes($adminId) {
    global $conn;

    $consulta = $conn->prepare("SELECT * FROM solicitudes_autorizacion_borrador WHERE estado = 'pendiente'");
    $consulta->execute();

    $resultado = $consulta->get_result();
    $solicitudes = $resultado->fetch_all(MYSQLI_ASSOC);

    $consulta->close();

    return $solicitudes;
}

// En tu archivo funciones.php
function solicitarAutorizacion($borradorId, $adminId) {
    global $conn;

    // Asegúrate de que los valores recibidos sean seguros para evitar SQL injection
    $borradorId = mysqli_real_escape_string($conn, $borradorId);
    $adminId = mysqli_real_escape_string($conn, $adminId);

    // Insertar la solicitud en la tabla de solicitudes_autorizacion_borrador
    $sql = "INSERT INTO solicitudes_autorizacion_borrador (borrador_id, admin_id) VALUES ('$borradorId', '$adminId')";
    
    if ($conn->query($sql) === TRUE) {
        // Éxito
        echo "Solicitud de autorización enviada correctamente.";
    } else {
        // Manejar el error si la inserción falla
        echo "Error al enviar la solicitud: " . $conn->error;
    }
}

// En funciones.php
function obtenerSolicitudesAutorizacion() {
    global $conn;

    $consulta = $conn->prepare("SELECT * FROM solicitudes_autorizacion_borrador");
    $consulta->execute();

    $resultado = $consulta->get_result();
    $solicitudes = $resultado->fetch_all(MYSQLI_ASSOC);

    $consulta->close();

    return $solicitudes;
}




// En tu archivo funciones.php

// Obtener todos los borradores de un autor
function obtenerBorradoresPorAutor($autorId) {
    global $conn;

    $consulta = $conn->prepare("SELECT * FROM borradores WHERE autor_id = ?");
    $consulta->bind_param("i", $autorId);
    $consulta->execute();

    $resultado = $consulta->get_result();
    $borradores = $resultado->fetch_all(MYSQLI_ASSOC);

    $consulta->close();

    return $borradores;
}

// Obtener imágenes asociadas a un borrador por su ID
function obtenerImagenesPorBorrador($borradorId) {
    global $conn;

    $consulta = $conn->prepare("SELECT * FROM imagenes_borrador WHERE borrador_id = ?");
    $consulta->bind_param("i", $borradorId);
    $consulta->execute();

    $resultado = $consulta->get_result();
    $imagenes = $resultado->fetch_all(MYSQLI_ASSOC);

    $consulta->close();

    return $imagenes;
}



// Eliminar un borrador de la base de datos
function eliminarBorrador($borradorId) {
    global $conn;

    $consulta = $conn->prepare("DELETE FROM borradores WHERE id = ?");
    $consulta->bind_param("i", $borradorId);
    
    // Ejecutar la consulta y verificar si tuvo éxito
    $resultado = $consulta->execute();
    
    $consulta->close();

    return $resultado;
}

// Editar un borrador en la base de datos
function editarBorrador($borradorId, $tituloNuevo, $contenidoNuevo) {
    global $conn;

    $consulta = $conn->prepare("UPDATE borradores SET titulo = ?, contenido = ? WHERE id = ?");
    $consulta->bind_param("ssi", $tituloNuevo, $contenidoNuevo, $borradorId);
    
    // Ejecutar la consulta y verificar si tuvo éxito
    $resultado = $consulta->execute();
    
    $consulta->close();

    return $resultado;
}

// En tu archivo funciones.php
function obtenerTodasLasPublicaciones() {
    global $conn;

    // Consultar todas las publicaciones de noticiassixela
    $consulta = $conn->query("SELECT * FROM noticiassixela");

    if ($consulta) {
        // Obtener el resultado como un array asociativo
        $publicaciones = $consulta->fetch_all(MYSQLI_ASSOC);
        return $publicaciones;
    } else {
        // Manejar el error, por ejemplo, mostrar un mensaje o registrar el error
        echo "Error al obtener las publicaciones: " . $conn->error;
        return false;
    }
}

?>


