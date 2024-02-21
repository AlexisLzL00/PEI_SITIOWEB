<?php
session_start();

// Verificar si el usuario ya está autenticado
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit();
}

include 'conexion.php';

// Verificar si ya existe un token en la sesión, si no, generarlo
if (!isset($_SESSION["csrf_token"]) || empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32)); // Generar un nuevo token CSRF
}

$error_message = null;

// Conectar a la base de datos
if ($conn->connect_error) {
    die("Connection failed");
}

// Procesar el formulario si se envía por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar el token CSRF
    if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION["csrf_token"]) {
        $username = mysqli_real_escape_string($conn, $_POST["adminuser"]);
        $password = $_POST["password"];

        $sql = "SELECT idadmin, adminuser, password FROM administrador WHERE adminuser = ? LIMIT 1";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($userId, $dbUsername, $dbPassword);
            $stmt->fetch();
            $stmt->close();

            // Verificar la contraseña directamente
            if ($userId && $password === $dbPassword) {
                // Almacenar información en la sesión
                $_SESSION["user_id"] = $userId;
                $_SESSION["adminuser"] = $dbUsername;

                // Redirigir a la página principal
                header("Location: dashboard.php");
                exit();
            } else {
                $error_message = "Credenciales incorrectas";
            }
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
    <title>Login Form</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap">
    <link rel="stylesheet" href="css/estilos.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 card">
            <div class="profile-image">

            </div>
            <div class="card-body">
                <div class="welcome-message">
                    Welcome! Admon.
                </div>
                <?php if ($error_message): ?>
                    <div class="custom-alert alert bg-dark mt-3">
                        <i class="fas fa-exclamation-circle text-white"></i>
                        <span class="text-white"><?php echo $error_message; ?></span>
                    </div>
                <?php endif; ?>
                <form id="loginForm" method="POST">
                    <div class="form-group">
                        <label for="adminuser" class="mt-3">Username</label>
                        <input type="text" class="form-control" id="adminuser" name="adminuser" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ?>">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
        // Genera un nuevo token CSRF en cada carga de la página
        document.addEventListener("DOMContentLoaded", function() {
            // Actualiza el valor del token en el formulario
            document.getElementById("csrf_token").value = "<?php echo $_SESSION["csrf_token"]; ?>";
        });
    </script>
<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
