<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registro.css">
    <!-- Agregado Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Registro de Usuarios</title>
</head>
<body>

    <div class="login">
        <div class="form">
            <div class="logo-container">
                <img src="../IMG/a.png" alt="Logo" class="logo">
                <span class="logo-text">Progrsolab</span>
            </div>
            <h2>Registro de Usuario</h2>
            <form action="solicitud_registro.php" method="POST">
                <!-- Agregado un formulario con campos para el registro de usuario -->
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="correo" placeholder="Correo Electrónico" required>
                </div>
<!-- Agregado campo de fecha de nacimiento -->
                <div class="input-container">
                    <i class="fas fa-calendar"></i>
                    <input type="date" name="fecha_nacimiento" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>
                <input type="submit" value="Registrar" class="submit">
            </form>
            <p class="terms">Al registrarte, aceptas nuestros <a href="#">Términos y Condiciones</a></p>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            togglePassword.classList.toggle('fa-eye-slash');
        });
    </script>

</body>
</html>
