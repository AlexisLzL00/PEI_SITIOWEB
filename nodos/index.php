<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404</title>

    <STYle>
body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #000; /* Fondo negro */
    color: #fff; /* Texto blanco */
    animation: fadeIn 2s forwards; /* Animación de fade-in al cargar la página */
}

.error-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5); /* Semitransparencia negra */
}

.error-content {
    text-align: center;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.7); /* Box shadow rojo */
}

h1 {
    color: #fff; /* Texto blanco en Oops! */
    font-size: 3em;
    margin-bottom: 10px;
    animation: bounceIn 2s forwards; /* Animación de bounce-in para la letra */
}

p {
    font-size: 1.5em;
    margin-bottom: 20px;
}

a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #333; /* Color de fondo del botón */
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #555; /* Cambio de color al pasar el ratón */
}

/* Animación de fade-in para la página */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Animación de bounce-in para la letra */
@keyframes bounceIn {
    from {
        transform: scale(0);
    }
    to {
        transform: scale(1);
    }
}
    </STYle>
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <h1>Oops!</h1>
            <p>Lo sentimos, la página que buscas no tiene la url completa.</p>
            <a href="/alexsite/">Ir a la página de inicio</a>
        </div>
    </div>
</body>
</html>
