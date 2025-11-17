<?php
    require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo asset_url('recursos/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/style-contacto.css'); ?>">
    <title>ArviCuenca</title>
</head>
<body>
    <!-- header -->
    <header>
        <img src="recursos/logo.png" alt="logo-tienda" class="logo">

        <!-- menu hamburguesa -->
            <input id="menu-check" type="checkbox">
                <label id="menu" for="menu-check">
                    <span id="menu-abrir">&#9776;</span>
                    <span id="menu-cerrar">X</span>
                </label>

        <nav>
            <a href="index.php?action=mostrarUser">INICIO</a>
            <a href="index.php?action=catalogo">PRODUCTOS</a>
            <a href="index.php?action=mostrarContacto">CONTACTO</a>
        </nav>

        <div class="cart">
            <a href="index.php?action=carrito"><img src="recursos/carro.png" alt="carrito-compra"></a>
        </div>
    </header>

    <!-- botones -->
    <aside class="aside-botones">
        <div class="cerrar-sesion">
            <h3>Cerrar Sesion</h3>
            <a href="index.php?action=logout" class="cerrar-sesion"><span class="inicio">X</span></a>
        </div>

        <div class="contacto-boton">
            <h3>¿Alguna duda?</h3>
            <a href="index.php?action=mostrarConsultas" class="contacto-boton"><span class="contacto">d</span></a>
        </div>
    </aside>

    <!-- mapa y redes sociales -->
    <div class="container-contacto">
        <h2>¿Donde nos encontramos?</h2>
        <div class="container-mapa">
        <!-- mapa -->
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3053.3561047268245!2d-2.140158587837503!3d40.06746817137907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5d676b04ec3767%3A0xe530193a093c7fad!2sAUTO%20RECAMBIOS%20ARVI!5e0!3m2!1ses!2ses!4v1732527357419!5m2!1ses!2ses" 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                class="mapa">
            </iframe>
        </div>
        <h2>¡Contactanos!</h2>
        <div class="iconos">
            <div class="icon-box phone">
                <img src="recursos/telefono.png" alt="Teléfono" class="icon">
                <span class="info">Llamanos al: 123-456-789</span>
            </div>
            <div class="icon-box">
                <a href="https://x.com/?lang=es"><img src="recursos/twiter.png" alt="Twitter" class="icon"></a>
            </div>
            <div class="icon-box">
                <a href="https://www.facebook.com/p/Auto-recambios-ARVI-100072101864635/?locale=es_LA"><img src="recursos/face.png" alt="Facebook" class="icon"></a>
            </div>
            <div class="icon-box email">
                <img src="recursos/email.png" alt="Correo" class="icon">
                <span class="info">Envíanos un correo: arvicuenca@hotmail.com</span>
            </div>
            <div class="icon-box">
                <a href="https://www.instagram.com/autorecambiosarvi"><img src="recursos/insta.png" alt="Instagram" class="icon"></a>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="ubicacion">
            <h3>¿Donde nos encontramos?</h3>
            <br>
            <a href="index.php?action=mostrarContacto">Calle paseo san Antonio nº 16</a>
        </div>
        <br>
        
        <div class="marcas">
            <h3>Nuestras principales marcas:</h3>
            <br>
                <div class="img-marca"><a href="https://www.recoficial.es"><img src="recursos/recoficial.png" alt="imagen-rec" class="imagen"></a></div>
                <div class="img-marca"><a href="https://www.continental-neumaticos.es/?gad_source=1&gclid=EAIaIQobChMIyOzSxcrbiQMVAqdoCR3OAwRoEAAYASAAEgKR2PD_BwE"><img src="recursos/conti.png" alt="imagen-conti" class="imagen"></a></div>
                <div class="img-marca"><a href="https://www.jobs.mahle.com/germany/en/?gad_source=1&gclid=EAIaIQobChMIi87G0srbiQMVmKdoCR2yzjyqEAAYASAAEgKi7_D_BwE"><img src="recursos/mahle.png" alt="imagen-mahle" class="imagen"></a></div>
                <div class="img-marca"><a href="https://www.mann-filter.com/es-es/catalogo.html"><img src="recursos/man.png" alt="imagen-man" class="imagen"></a></div>
                <br>
                <p>&copy; 2024 ArviCuenca. Todos los derechos reservados.</p>
        </div>
        <br>
        <div class="redes">
            <h3>Visita nuestras redes:</h3>
            <br>
            <a href="#"><span class="icon">f</span></a>
            <a href="#"><span class="icon">l</span></a>
            <a href="#"><span class="icon">t</span></a>
        </div>
    </footer>
</body>
</html>