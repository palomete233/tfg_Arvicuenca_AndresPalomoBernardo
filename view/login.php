<?php
    require_once __DIR__ . '/../config.php';
    // Creamos la cookie y almacenamos el nombre de usuario
    $nom_user = '';

    if (isset($_COOKIE["recordar_user"])) {
        $nom_user = $_COOKIE["recordar_user"];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo asset_url('recursos/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/style-login.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0"></script>
    <title>ArviCuenca</title>
</head>
<body>
    <!-- CABECERA DE BIENVENIDA -->
    <header>
        <img src="<?php echo asset_url('recursos/logo.png'); ?>" alt="logo ArviCuenca" class="logo">
        <h1>¡Bienvenido a <span>ArviCuenca</span>!</h1>
        <p>Tu tienda de confianza en recambios, neumáticos y mantenimiento del automóvil</p>
    </header>

    <!-- LOGIN -->
    <div class="form-box">
        <h1>¡BIENVENIDO DE NUEVO!</h1>
        <img src="<?php echo asset_url('recursos/desc.jpg'); ?>" alt="foto">
        
        <form action="<?php echo base_url('index.php?action=loginAction'); ?>" method="post">
            <label for="userName">Nombre de usuario</label>
            <input type="text" id="nom_user" name="nom_user" required placeholder="Usuario" value="<?php echo $nom_user ?>">
            
            <label for="passwd">Introduce tu contraseña</label>
            <input type="password" id="password" name="password" required placeholder="Password">
            
            <label for="recordar">Recordar Usuario</label>
            <input type="checkbox" name="recordar" <?php if ($nom_user != '') { echo 'checked'; } ?>>
            
            <button type="submit" class="bt" onclick="mostrarConfeti(event)">Iniciar Sesion 🚗</button>
            
        </form>

        <form action="<?php echo base_url('index.php?action=deleteCookie'); ?>" method="post">
            <button class="bt" type="submit">Borrar recordatorio</button>
        </form>

        <a href="<?php echo base_url('index.php?action=registrarse'); ?>" class="enlace">¿No tienes cuenta?</a>
    </div>

    <!-- CONTENIDO DE BIENVENIDA -->
    <main>
        <h2>Conoce todo lo que tenemos para ti</h2>
        <p>
            En <strong>ArviCuenca</strong> trabajamos cada día para ofrecerte los mejores productos del sector automovilístico,
            con la máxima calidad y confianza.  
            Explora nuestras categorías y descubre recambios, neumáticos, filtros y mucho más.
        </p>
        <p>Inicia sesión para ver nuestro catálogo de productos y realizar tus pedidos.</p>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="ubicacion">
            <h3>¿Dónde nos encontramos?</h3>
            <a href="paginaContacto.php">Calle Paseo San Antonio nº 16</a>
        </div>

        <div class="marcas">
            <h3>Nuestras principales marcas:</h3>
            <div class="img-marca">
                <a href="https://www.recoficial.es">
                    <img src="<?php echo asset_url('recursos/recoficial.png'); ?>" alt="imagen recoficial" class="imagen">
                </a>
            </div>
            <div class="img-marca">
                <a href="https://www.continental-neumaticos.es/?gad_source=1&gclid=EAIaIQobChMIyOzSxcrbiQMVAqdoCR3OAwRoEAAYASAAEgKR2PD_BwE">
                    <img src="<?php echo asset_url('recursos/conti.png'); ?>" alt="imagen continental" class="imagen">
                </a>
            </div>
            <div class="img-marca">
                <a href="https://www.jobs.mahle.com/germany/en/?gad_source=1&gclid=EAIaIQobChMIi87G0srbiQMVmKdoCR2yzjyqEAAYASAAEgKi7_D_BwE">
                    <img src="<?php echo asset_url('recursos/mahle.png'); ?>" alt="imagen mahle" class="imagen">
                </a>
            </div>
            <div class="img-marca">
                <a href="https://www.mann-filter.com/es-es/catalogo.html">
                    <img src="<?php echo asset_url('recursos/man.png'); ?>" alt="imagen mann-filter" class="imagen">
                </a>
            </div>
            <p>&copy; 2024 ArviCuenca. Todos los derechos reservados.</p>
        </div>

        <div class="redes">
            <h3>Visita nuestras redes:</h3>
            <a href="#"><span class="icon">f</span></a>
            <a href="#"><span class="icon">l</span></a>
            <a href="#"><span class="icon">t</span></a>
        </div>
    </footer>

    <script src="<?php echo asset_url('js/js_login.js'); ?>"></script>
</body>
</html>
