<?php
    // Inicia la sesión
    session_start();

    // Verifica si la sesión está iniciada
    if (!isset($_SESSION['username'])) {
        // Si no hay sesión iniciada, redirecciona al formulario de inicio de sesión
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">




    <link rel="stylesheet" href="css/index.css">
    

    <style>

    </style>
    <title>Progrsolab</title>
</head>

<body>

 <!--   <header>
        <div class="header-content">
        </div> 
    </header> -->

    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#">
            <img src="img/a.png" alt="Logo" class="img-fluid">
            Progrsolab
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-hard-hat"></i> Trabajo
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="trabajo/emprendimiento.php">Emprendimiento</a>
                    <a class="dropdown-item" href="trabajo/crecimiento.php">Crecimiento</a>
                    <a class="dropdown-item" href="trabajo/ideas.php">Ideas</a>
                </div>
            </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#"><i class="fas fa-home"></i> Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="perfil.php"><i class="fas fa-user"></i> Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-cog"></i> Configuración</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="open-btn" onclick="toggleAside()">
        <i class="fas fa-chevron-right"></i>
    </div>

    <div class="overlay" onclick="toggleAside()"></div>

    <main>
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../img/car1.jpg" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Título del Slide 1</h5>
                <p>Descripción breve del Slide 1.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../img/ca2.jpg" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Título del Slide 2</h5>
                <p>Descripción breve del Slide 2.</p>
            </div>
        </div>
        <!-- Agrega más slides según sea necesario -->
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>


    <section id="bienvenida">
        <!-- Contenido principal relacionado con la bienvenida -->
        <h1>Bienvenido, <?php echo $_SESSION['username']; ?>!</h1>
    </section>

    <!-- Resto de tu contenido -->
</main>



    <aside>
        <h3>Actividades Recientes</h3>
        <a href="#">Actividad 1</a>
        <a href="#">Actividad 2</a>
        <!-- Agrega más enlaces según sea necesario -->
        <div class="close-btn" onclick="toggleAside()">&#10006;</div>
    </aside>

    <footer>
        <p>&copy; 2024 Tu Aplicación. Todos los derechos reservados.</p>
    </footer>


    <script>
        function toggleAside() {
            document.querySelector('.overlay').classList.toggle('show-overlay');
            document.querySelector('aside').classList.toggle('show-aside');
            document.getElementById('open-btn').classList.toggle('active');
        }
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarIcon = document.querySelector('.navbar-toggler-icon');

            navbarToggler.addEventListener('click', function () {
                navbarIcon.classList.toggle('active');
            });
        });
    </script>
</body>

</html>
