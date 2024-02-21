<?php


// Recuperar la información de la sesión
session_start();


// Verificar si el usuario está autenticado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

$usuarioId = $_SESSION["usuario_id"];
$username = $_SESSION["username"];

// Ahora puedes usar $userId y $username en tu página según sea necesario.

$requestUri = $_SERVER['REQUEST_URI'];

// Obtén el nombre del archivo actual (última parte de la ruta)
$filename = basename(__FILE__);

// Si la URL es index.php y hay algo después de la barra, redirige a la versión sin ese "algo"
if ($filename === 'index.php' && strpos($requestUri, '/index.php/') !== false) {
    $correctedUrl = rtrim(str_replace('/index.php/', '/index.php', $requestUri), '/');
    header("Location: $correctedUrl");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Awesome Website</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <style>
        /* Estilos adicionales si es necesario */
        #custom-alert {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            max-width: 300px;
            display: none; /* Inicialmente oculto */
        }

        #custom-alert .alert-inner {
            padding: 15px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: fade-in 0.6s ease-out; /* Animación de desvanecimiento */
        }

        #custom-alert.fade-out {
            animation: fade-out 0.6s ease-out forwards; /* Animación de desvanecimiento al ocultarse */
        }

        #custom-alert h4 {
            margin-bottom: 10px;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fade-out {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }


/* Estilos mejorados para los submenús */
.menu-with-submenu {
    position: relative;
}

.menu-with-submenu a {
    text-decoration: none;
    color: #ffffff;
    font-size: 16px;
    margin: 0 15px;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    position: relative;
    display: flex;
    align-items: center;
}

.menu-with-submenu .submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: rgba(0, 0, 0, 0.8); /* Fondo del submenú negro semitransparente */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 5px;
    width: 220px; /* Ajustar el ancho según sea necesario */
}

.menu-with-submenu:hover a {
    background-color: rgba(255, 255, 255, 0.1);
}

.menu-with-submenu:hover .submenu {
    display: flex;
    flex-direction: column;
}

.menu-with-submenu .submenu li {
    padding: 10px;
    transition: background-color 0.3s ease;
    text-align: center;
    list-style-type: none; /* Quitar los puntos de la lista */
}

.menu-with-submenu .submenu li:hover {
    background-color: rgba(255, 255, 255, 0.2); /* Color de fondo en hover */
    border-radius: 5px;
}

.menu-with-submenu a i {
    margin-right: 5px;
}

.menu-with-submenu .submenu a i {
    margin-right: 10px;
}

.menu-with-submenu .submenu a {
    color: #fff;
}

.menu-with-submenu .submenu a:hover {
    color: #ffd700; /* Color del texto en hover */
}

    </style>
</head>

<body>
    <!-- Barra de navegación principal -->
    <nav class="menu navbar">

    
<!-- Enlaces del menú principal con iconos -->
<div class="menu-links" id="menu-links">
    <a href="../index.php"><i class="fas fa-home"></i> Inicio</a>
    
    <!-- Enlace "Perfil" con submenú -->
    <div class="menu-with-submenu">
        <a href="#"><i class="fas fa-user"></i> Perfil</a>
        <ul class="submenu">
            <li><a href="perfiluser.php"><i class="fas fa-user"></i> Tu cuenta</a></li>
            <li><a href="itinerario.php"><i class="fas fa-cog"></i> Itinerario</a></li>
        </ul>
    </div>
    
    <a href="informes.php"><i class="fas fa-chart-bar"></i> Informe</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
</div>
    </nav>


    <div id="custom-alert" class="alert alert-dismissible fade show" role="alert">
                    <div class="alert-inner">
                        <h4>¡Bienvenido, <?php echo $username; ?>!</h4>
                        Esperamos que tengas una gran experiencia en nuestro sitio.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

    <!-- Botón de hamburguesa para dispositivos responsivos -->
    <div class="menu-toggle-responsive" id="mobile-menu-toggle">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <!-- Barra de navegación responsiva -->
    <div class="menu-responsive" id="mobile-menu">
        <div class="menu-responsive-content">
            <!-- Enlaces de la barra de navegación responsiva -->
            <a href="#"><i class="fas fa-home"></i> Inicio</a>
            <a href="nodos/perfil.php"><i class="fas fa-user"></i> Perfil</a>
            <a href="#"><i class="fas fa-chart-bar"></i> Informe</a>
            <a href="nodos/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </div>
    </div>


    <div class="container rounded" id="content">
        <div class="row mt-3">
            <div class="col-md-12">
            <div class="hop cardparaeltexto">
                <h2 class="color-black">Bienvenido a tu página, <?php echo $username; ?></h2>
                <h2 class="color-black">Este seria la Seccion de Clientes donde se tendran Registros</h2>
                <!-- Agregar el alert personalizado -->
</div>
                <!-- Otro contenido de la página -->
            </div>
        </div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuWithSubmenu = document.querySelector('.menu-with-submenu');
        const submenu = menuWithSubmenu.querySelector('.submenu');

        menuWithSubmenu.addEventListener('click', function (e) {
            e.stopPropagation(); // Evitar que el clic llegue al documento y cierre el submenú
            submenu.classList.toggle('active');
        });

        // Cerrar el submenú si se hace clic fuera de él
        document.addEventListener('click', function () {
            submenu.classList.remove('active');
        });
    });
</script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        var mobileMenu = document.getElementById('mobile-menu');

        mobileMenuToggle.addEventListener('click', function () {
            if (mobileMenu) {
                mobileMenu.classList.toggle('active');
                mobileMenuToggle.classList.toggle('active');
            }
        });

        // Verificar si el mensaje ya se ha mostrado durante esta sesión de PHP
        if (!<?php echo isset($_SESSION['welcome_message_shown']) ? 'true' : 'false'; ?>) {
            // Mostrar el alerta después de un tiempo (ejemplo)
            showCustomAlert();

            // Marcar que el mensaje ya se ha mostrado en esta sesión de PHP
            <?php $_SESSION['welcome_message_shown'] = true; ?>;
        }

        function showCustomAlert() {
            var customAlert = document.getElementById('custom-alert');
            if (customAlert) {
                customAlert.style.display = 'block';
                setTimeout(function () {
                    customAlert.classList.add('fade-out');
                    setTimeout(function () {
                        customAlert.style.display = 'none';
                        customAlert.classList.remove('fade-out');
                    }, 600); // Esperar a que termine la animación de desvanecimiento
                }, 4000); // Ocultar después de 4 segundos (ajusta según tus necesidades)
            }
        }
    });
</script>

    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>