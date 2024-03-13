<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Asegúrate de que este enlace esté presente en la sección head de tu HTML -->

     <!-- Añade esto en la sección head de tu HTML -->

    <link rel="stylesheet" href="../css/logadmin.css">
    <!-- Agregado Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Asegúrate de que este enlace esté presente en la sección head de tu HTML -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Login - Progrsolab</title>
</head>
<body>
    <div class="login">
        <div class="form">
            <div class="logo-container">
                <img src="../img/a.png" alt="Logo" class="logo">
                <span class="logo-text">Progrsolab</span>
            </div>
            <h2>Inicie Sesion Administrador!</h2>
            <form action="solicitud_admin.php" method="POST">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="usuario" placeholder="Administrador" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="contrasena" id="password" placeholder="Password" required>
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>
                <input type="submit" value="Sign In" class="submit">
            </form>
            <p class="terms">By signing in, you agree to our <a href="#">Terms and Conditions</a></p>
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
    
<!-- Agrega esto en la sección head de tu HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Verifica si hay un parámetro de error en la URL
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');

        // Muestra el mensaje de error correspondiente
        if (error === 'utx') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Usuario o contraseña incorrectos'
            }).then(function() {
                // Redirige a admin.php después de mostrar el mensaje de error
                window.location.href = 'admin.php';
            });
        }
    });
</script>

</body>
</html>
