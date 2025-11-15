<?php
    /**
     * Vista del Carrito de Compras
     * Muestra:
     * - Lista de productos en el carrito
     * - Controles de cantidad
     * - Total y botón de tramitar
     * 
     * Requiere:
     * - Usuario logueado
     * - Rol 'user'
     * - carrito.js y carritoViewer.js
     */

    // Verificar autenticación y permisos
    if(!isset($_SESSION["user"]) || $_SESSION["rol"] != "user"){
        header("Location: ../index.php?action=inicio");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../recursos/favicon.ico" type="image/x-icon">
    <!-- Estilos del carrito con grid layout -->
    <link rel="stylesheet" type="text/css" href="../css/style-carrito.css">
    <title>Carrito - ArviCuenca</title>
    <!-- Scripts de gestión del carrito -->
    <script src="../js/carrito.js"></script>
    <script src="../js/carritoViewer.js"></script>
</head>
<body>
    <!-- header -->
    <header>
        <img src="../recursos/logo.png" alt="logo-tienda" class="logo">

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
            <a href="index.php?action=carrito"><img src="../recursos/carro.png" alt="carrito-compra"></a>
        </div>
    </header>

    <!-- seccion de resumen del pedido -->
    <div class="container">
        <h2>Resumen del pedido</h2>
        <div class="resumen-pedido">
            <div class="articulo">
                <img src="../recursos/filtros-aceite.png" alt="Artículo">
                <p>Lorem ipsum dolor sit amet, consectetur</p>
            </div>
            <div class="detalles">
                <div class="fila">
                    <p class="titulo">Precio:</p>
                    <p>12.99 €<br><span class="descuento"> -35%</span></p>
                </div>
                <div class="fila">
                    <p class="titulo">Cantidad:</p>
                    <p>
                        <button class="boton">+</button>
                        <span>1</span>
                        <button class="boton">-</button>
                        <button class="eliminar">×</button>
                    </p>
                </div>
                <div class="fila">
                    <p class="titulo">Total:</p>
                    <p></p>
                </div>
            </div>
        </div>
        
        <div class="total-final">
            <p>Total:</p>
            <p>0€</p>
        </div>
    
        <a class="tramitar-pedido" href="index.php?action=pago">Tramitar pedido</a>
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