<?php
    require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="icon" href="<?php echo asset_url('recursos/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/style-registro.css'); ?>">
</head>
<body>
    <!-- CABECERA DE BIENVENIDA -->
    <header>
        <img src="<?php echo asset_url('recursos/logo.png'); ?>" alt="logo ArviCuenca" class="logo">
        <h1 class="titulo">Creacion de cuenta</h1>
        <p>Por favor, completa el siguiente formulario. Para crear tu cuenta y tener acceso a la pagina.</p>
    </header>

    <div class="form-box">
        
    <form id="registro-form" action="index.php?action=registrarse" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre">

            <label for="apellido">Apellidos</label>
            <input type="text" id="apellido" name="apellido" required placeholder="Tus apellidos">

            <label for="nom_user">Nombre de usuario</label>
            <input type="text" id="nom_user" name="nom_user" required placeholder="Nombre de usuario deseado">

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required placeholder="Contraseña deseada">
            <!-- Contenedor para mostrar el patrón generado de la contraseña -->
            <div id="password-pattern" aria-live="polite" style="margin-top:8px;color:#444;font-size:0.95rem"></div>
            <!-- Contenedor para mostrar errores/avisos sobre la contraseña -->
            <div id="password-error" aria-live="assertive" style="margin-top:6px;color:#c00;font-size:0.9rem"></div>

            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" required placeholder="Tu dirección">

            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com" pattern="+@ejemplo.com">

            <label for="tipo_cliente">Tipo de cliente</label>
            <select id="tipo_cliente" name="tipo_cliente" required>
                <option value="">Selecciona una opción</option>
                <option value="particular">Particular</option>
                <option value="taller">Taller</option>
            </select>

            <input type="hidden" id="rol" name="rol" value="user">

            <button type="submit" class="bt">Registrarse</button>
        </form>

        <a class="volver" href="index.php?action=inicio">Volver al inicio</a>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="ubicacion">
            <h3>¿Dónde nos encontramos?</h3>
            <br>
            <a href="paginaContacto.php">Calle paseo san Antonio nº 16</a>
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
        <!-- Script externo que genera un patrón compacto a partir de la contraseña -->
        <script src="<?php echo asset_url('js/password-pattern.js'); ?>"></script>
</body>
</html>