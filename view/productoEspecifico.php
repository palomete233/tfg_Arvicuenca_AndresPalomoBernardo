<?php
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();

    // Verificar que tenemos un producto para mostrar
    if (!isset($producto) || empty($producto)) {
        header("Location: index.php?action=catalogo");
        exit();
    }

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
    <title><?= htmlspecialchars($producto['nombre']) ?> - ArviCuenca</title>
    <link rel="icon" href="../recursos/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style-productosInfo.css">
    <script src="../js/carrito.js" defer></script>
</head>
<body>
    <!-- header (mismo patrón que en otras vistas) -->
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

    <!-- contenedor principal -->
    <div class="container">
        <!-- Imagen del producto -->
        <div class="image">
            <img src="<?= htmlspecialchars($producto['imagen']) ?>" 
                 alt="<?= htmlspecialchars($producto['nombre']) ?>"
                 onerror="this.src='recursos/no-image.png'">
        </div>

        <!-- Detalles del producto -->
        <div class="details">
            <h1><?= htmlspecialchars($producto['nombre']) ?></h1>
            <div class="precio">
                <span class="monto"><?= number_format($producto['precio'], 2) ?> €</span>
                <?php if ($producto['stock'] > 0): ?>
                    <span class="stock disponible">En stock (<?= $producto['stock'] ?> unidades)</span>
                <?php else: ?>
                    <span class="stock agotado">Agotado</span>
                <?php endif; ?>
            </div>
            
            <div class="descripcion">
                <h2>Descripción</h2>
                <p><?= nl2br(htmlspecialchars($producto['descripcion'])) ?></p>
            </div>

            <?php if ($producto['stock'] > 0): ?>
            <div class="acciones">
                <div class="cantidad">
                    <label for="cantidad">Cantidad:</label>
                    <div class="cantidad-control">
                        <button type="button" class="btn-cantidad" data-action="decrease">-</button>
                        <input type="number" id="cantidad" name="cantidad" value="1" min="1" max="<?= $producto['stock'] ?>">
                        <button type="button" class="btn-cantidad" data-action="increase">+</button>
                    </div>
                </div>
                
                <button id="addToCart" class="btn-comprar" 
                        data-producto-id="<?= $producto['id_producto'] ?>"
                        <?= !isset($_SESSION['user']) ? 'disabled' : '' ?>>
                    <?= isset($_SESSION['user']) ? 'Añadir al carrito' : 'Inicia sesión para comprar' ?>
                </button>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- footer (mismo patrón que en otras vistas) -->
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
            <div class="img-marca"><a href="https://www.continental-neumaticos.es/"><img src="recursos/conti.png" alt="imagen-conti" class="imagen"></a></div>
            <div class="img-marca"><a href="https://www.jobs.mahle.com/"><img src="recursos/mahle.png" alt="imagen-mahle" class="imagen"></a></div>
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