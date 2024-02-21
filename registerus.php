<?php
include 'conexion.php';

// Conectar a la base de datos
if ($conn->connect_error) {
    die("Connection failed");
}

// Verificar si ya existe un token en la sesión, si no, generarlo
session_start();
if (!isset($_SESSION["csrf_token"]) || empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32)); // Generar un nuevo token CSRF
}

$error_message = null;

// Procesar el formulario si se envía por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar el token CSRF
    if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION["csrf_token"]) {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        // Puedes agregar más campos según tus necesidades

        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $stmt->close();

            // Redirigir a la página de inicio de sesión o a donde desees
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Error al preparar la declaración";
        }
    } else {
        $error_message = "Token CSRF inválido";
    }
}

// Generar un nuevo token CSRF en cada carga de la página
$_SESSION["csrf_token"] = bin2hex(random_bytes(32));

// Cerrar la conexión a la base de datos
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Agrega tus estilos CSS aquí si es necesario -->
    <style>
        body {
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            background: url('photos/fondo.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
        }

        .card {
            animation: fadeInUp 0.8s ease-out;
            background-color: rgba(0, 0, 0, 0.9);
            color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.7);
            color: #212529;
            border: 2px solid #007bff;
            border-radius: 10px;
            transition: border-color 0.3s ease-in-out;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        button {
            background-color: rgba(0, 188, 212, 0.8);
            border-color: #00bcd4;
            transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
            border-radius: 25px;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
            padding: 10px;
            width: 100%;
        }

        button:hover {
            background-color: rgba(0, 151, 167, 0.8);
            border-color: #0097a7;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1 class="text-center">Registro de Usuario</h1>

        <?php if ($error_message) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="registerus.php">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" name="password" required>

            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ?>">
            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>

</html>
