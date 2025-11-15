<?php
    // Verificar autenticación y permisos
    if(!isset($_SESSION["user"]) || $_SESSION["rol"] != "user"){
        header("Location: index.php?action=inicio");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../recursos/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/style-pago.css">
    <title>Pago - ArviCuenca</title>
    <script src="../js/carrito.js"></script>
    <script src="../js/pago.js"></script>
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

    <div class="pago-container">
        <div class="pago-izquierda">
            <h2>Información de Pago</h2>
            
            <form id="formulario-pago" method="POST" action="index.php?action=procesarPago">
                <!-- Método de pago -->
                <div class="seccion-pago">
                    <h3>Método de Pago</h3>
                    <div class="metodos-pago">
                        <label class="metodo-item">
                            <input type="radio" name="metodo_pago" value="tarjeta" checked>
                            <span>Tarjeta de Crédito/Débito 💳</span>
                        </label>
                        <label class="metodo-item">
                            <input type="radio" name="metodo_pago" value="transferencia">
                            <span>Transferencia Bancaria 🏦</span>
                        </label>
                        <label class="metodo-item">
                            <input type="radio" name="metodo_pago" value="contrareembolso">
                            <span>Contrareembolso 📦</span>
                        </label>
                    </div>
                </div>

                <!-- Datos de tarjeta (solo si se selecciona tarjeta) -->
                <div id="datos-tarjeta" class="seccion-pago">
                    <h3>Datos de la Tarjeta</h3>
                    <div class="form-group">
                        <label for="nombre_titular">Nombre del Titular</label>
                        <input type="text" id="nombre_titular" name="nombre_titular" placeholder="Nombre completo" required>
                    </div>
                    <div class="form-group">
                        <label for="numero_tarjeta">Número de Tarjeta</label>
                        <input type="text" id="numero_tarjeta" name="numero_tarjeta" placeholder="1234 5678 9012 3456" maxlength="19" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fecha_exp">Fecha de Expiración</label>
                            <input type="text" id="fecha_exp" name="fecha_exp" placeholder="MM/AA" maxlength="5" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                </div>

                <!-- Dirección de envío -->
                <div class="seccion-pago">
                    <h3>Dirección de Envío</h3>
                    <div class="form-group">
                        <label for="direccion">Dirección Completa</label>
                        <input type="text" id="direccion" name="direccion" placeholder="Calle, número, piso..." required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" required>
                        </div>
                        <div class="form-group">
                            <label for="codigo_postal">Código Postal</label>
                            <input type="text" id="codigo_postal" name="codigo_postal" placeholder="12345" maxlength="5" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-confirmar-pago">Confirmar Pago</button>
            </form>
        </div>

        <!-- Resumen del pedido -->
        <div class="pago-derecha">
            <h2>Resumen del Pedido</h2>
            <div id="resumen-productos"></div>
            
            <div class="resumen-totales">
                <div class="linea-total">
                    <span>Subtotal:</span>
                    <span id="subtotal-pago">0.00€</span>
                </div>
                <div class="linea-total descuento" id="linea-descuento" style="display: none;">
                    <span>Descuento (<span id="porcentaje-descuento">0</span>%):</span>
                    <span id="descuento-pago">-0.00€</span>
                </div>
                <div class="linea-total">
                    <span>Envío:</span>
                    <span id="envio-pago">Gratis</span>
                </div>
                <div class="linea-total total-final">
                    <span>Total:</span>
                    <span id="total-pago">0.00€</span>
                </div>
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
                <div class="img-marca"><a href="https://www.continental-neumaticos.es"><img src="recursos/conti.png" alt="imagen-conti" class="imagen"></a></div>
                <div class="img-marca"><a href="https://www.jobs.mahle.com"><img src="recursos/mahle.png" alt="imagen-mahle" class="imagen"></a></div>
                <div class="img-marca"><a href="https://www.mann-filter.com"><img src="recursos/man.png" alt="imagen-man" class="imagen"></a></div>
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
