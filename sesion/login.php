<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <!-- Agregado Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    
<body>
    <div class="login">
        <div class="form">
            <div class="logo-container">
                <img src="../img/a.png" alt="Logo" class="logo">
                <span class="logo-text">Progrsolab</span>
            </div>


            <h2>Bienvenido Usuario</h2>

            <form action="solicitud_login.php" method="POST">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="contrasena" id="password" placeholder="Password" required>
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>
                <input type="submit" value="Sign In" class="submit">
            </form>
            <p class="terms">not user ?  <a href="registro.php">Register</a></p>
            <p class="terms">Leer  <a href="../terminos.html">Terminos & Conditions</a></p>
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
