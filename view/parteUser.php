<?php
    require_once __DIR__ . '/../config.php';
    //Con esto hacemos que si no hay una sesion iniciada o el rol no es user nos redirija al inicio
    if(!isset($_SESSION["user"]) || $_SESSION["rol"] != "user"){
        header("Location: " . base_url('index.php?action=inicio'));
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArviCuenca</title>
    <link rel="icon" href="<?php echo asset_url('recursos/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/style-parteUser.css'); ?>">
    <title>ArviCuenca</title>
</head>
<body>
    <!-- header -->
    <header>
        <div class="contenedor">
            <img src="<?php echo asset_url('recursos/logo.png'); ?>" alt="logo-tienda" class="logo">

            <!-- menu hamburguesa -->
            <input id="menu-check" type="checkbox">
                <label id="menu" for="menu-check">
                    <span id="menu-abrir">&#9776;</span>
                    <span id="menu-cerrar">X</span>
                </label>

            <nav>
                <ul>
                    <li><a href="index.php?action=mostrarUser">INICIO</a></li>
                    <li><a href="index.php?action=catalogo">PRODUCTOS</a></li>
                    <li><a href="index.php?action=mostrarContacto">CONTACTO</a></li>
                </ul>
            </nav>

            <div class="cart">
                <a href="<?php echo base_url('index.php?action=carrito'); ?>"><img src="<?php echo asset_url('recursos/carro.png'); ?>" alt="carrito-compra"></a>
            </div>
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

    <!-- contenedor principal -->

    <main class="cont">
        <section class="desc-section">
            <img src="<?php echo asset_url('recursos/desc.jpg'); ?>" alt="foto-tienda" class="desc-img">
            <article class="desc-text">
                <h2>HOLA DE NUEVO <?php echo $_SESSION["user"]?></h2>
                
                <p>
                    En ArviCuenca, sabemos que mantener tu vehículo en óptimas condiciones es tu prioridad. Por eso, te ofrecemos el catálogo de recambios de automóvil más completo y accesible del mercado.
                </p>

                <p>
                    Encuentra la pieza exacta que necesitas en minutos: Desde filtros, frenos y sistemas de motor, hasta carrocería y accesorios. Nuestra plataforma está diseñada para una búsqueda rápida e intuitiva, asegurando la compatibilidad con tu modelo de coche.
                </p>

                <h3>¿Por qué elegirnos?</h3> <ul class="ventajas-list"> <li>Variedad: Miles de referencias para todas las marcas y modelos.</li>
                    <li>Calidad Garantizada: Solo trabajamos con fabricantes de primera línea.</li>
                    <li>Envío Rápido: Recibe tu pedido donde lo necesites con la máxima urgencia.</li>
                </ul>

                <p>
                    ¡Empieza a buscar ahora! Utiliza nuestro buscador por marca y modelo, o explora nuestras categorías principales.
                </p>
                
                <a href="index.php?action=catalogo" class="cta-button">¡Buscar Recambios Ahora!</a>
            </article>  
        </section>
    </main>

    <!-- carrusel de fotos -->
    <div class="slider">
        <h3>NUESTROS PRODUCTOS MAS DESTACADOS</h3>
        <div class="slide-track">
            <div class="slide">
                <img src="<?php echo asset_url('recursos/1.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/2.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/3.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/4.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/5.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/6.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/7.png'); ?>" alt="">
            </div>

            <div class="slide">
                <img src="<?php echo asset_url('recursos/1.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/2.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/3.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/4.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/5.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/6.png'); ?>" alt="">
            </div>
            <div class="slide">
                <img src="<?php echo asset_url('recursos/7.png'); ?>" alt="">
            </div>
        </div>
    </div>

    <!-- footer -->

    <footer>
        <div class="ubicacion">
            <h3>¿Dónde nos encontramos?</h3>
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