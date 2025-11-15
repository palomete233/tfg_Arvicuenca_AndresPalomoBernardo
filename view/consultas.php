<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../recursos/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/style-consultas.css">
    <title>ArviCuenca</title>
</head>
<body>
    <!-- header -->
    <header>
        <div class="contenedor">
            <img src="../recursos/logo.png" alt="logo-tienda" class="logo">

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
                <a href="index.php?action=carrito"><img src="../recursos/carro.png" alt="carrito-compra"></a>
            </div>
        </div>
    </header>

    <!-- botonones -->
    <aside class="aside-botones">
        <div class="cerrar-sesion">
            <h3>Cerrar Sesion</h3>
            <a href="index.php?action=logout" class="cerrar-sesion"><span class="inicio">X</span></a>
        </div>

        <div class="contacto-boton">
            <h3>¿Alguna duda?</h3>
            <a href="#" class="contacto-boton"><span class="contacto">d</span></a>
        </div>
    </aside>

    <!-- formulario dudas -->

    <div class="form-cont">
        <h2>¿Necesitas ayuda?</h2>
        <form action="index.php?action=enviar" method="post">
            <div class="form-grupo">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
            </div>

            <div class="form-grupo">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido" required>
            </div>

            <div class="form-grupo">
                <input type="hidden" id="email" name="email" value="palomobernardoandres@gmail.com" required>
            </div>

            <div class="form-grupo">
                <label for="mensaje">¿Cual es el problema?</label>
                <textarea id="mensaje" name="mensaje" placeholder="Ingresa tu problema" rows="5" required></textarea>
            </div>

            <button type="submit" class="boton">Enviar</button>
        </form>
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