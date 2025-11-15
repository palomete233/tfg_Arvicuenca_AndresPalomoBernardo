<?php

    // Verificar autenticación y permisos
    if(!isset($_SESSION["user"]) || $_SESSION["rol"] != "user"){
        header("Location: ../index.php?action=inicio");
        exit();
    }

    $metodoPago = $_GET['metodo'] ?? 'tarjeta';
    $metodosNombre = [
        'tarjeta' => 'Tarjeta de Crédito/Débito',
        'transferencia' => 'Transferencia Bancaria',
        'contrareembolso' => 'Contrareembolso'
    ];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../recursos/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/style-confirmacion.css">
    <title>Confirmación de Pedido - ArviCuenca</title>
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

    <div class="confirmacion-container">
        <div class="confirmacion-contenido">
            <div class="icono-exito">✓</div>
            <h1>¡Pedido Confirmado!</h1>
            <p class="mensaje-exito">Tu pedido ha sido procesado correctamente</p>
            
            <div class="detalles-confirmacion">
                <div class="detalle-item">
                    <span class="detalle-label">Número de Pedido:</span>
                    <span class="detalle-valor">#<?= strtoupper(substr(md5(time()), 0, 8)) ?></span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Método de Pago:</span>
                    <span class="detalle-valor"><?= $metodosNombre[$metodoPago] ?? 'No especificado' ?></span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Fecha:</span>
                    <span class="detalle-valor"><?= date('d/m/Y H:i') ?></span>
                </div>
            </div>

            <div class="mensaje-info">
                <p>📧 Recibirás un correo de confirmación con los detalles de tu pedido.</p>
                <p>📦 Tu pedido será procesado y enviado en las próximas 24-48 horas.</p>
            </div>

            <div class="botones-confirmacion">
                <a href="index.php?action=catalogo" class="btn-seguir-comprando">Seguir Comprando</a>
                <a href="index.php?action=mostrarUser" class="btn-mi-cuenta">Ir a Mi Cuenta</a>
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
