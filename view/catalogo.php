<?php
    // Incluir configuración para URLs
    require_once __DIR__ . '/../config.php';
    
    //Aseguramos que no entren si no estan registrados
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
    <title>ArviCuenca</title>
    <link rel="icon" href="<?php echo asset_url('recursos/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/style-productos.css'); ?>">
    <script src="<?php echo asset_url('js/carrito.js'); ?>"></script>
    <script src="<?php echo asset_url('js/catalogoCarrito.js'); ?>"></script>
</head>
<body>
    <!-- header -->

    <header>
        <img src="<?php echo asset_url('recursos/logo.png'); ?>" alt="logo-tienda" class="logo">

        <!-- menu hamburguesa -->
            <input id="menu-check" type="checkbox">
                <label id="menu" for="menu-check">
                    <span id="menu-abrir">&#9776;</span>
                    <span id="menu-cerrar">X</span>
                </label>

        <nav>
            <a href="index.php?action=mostrarUser">INICIO</a>
            <a href="#">PRODUCTOS</a>
            <a href="index.php?action=mostrarContacto">CONTACTO</a>
        </nav>

        <div class="cart">
            <a href="<?php echo base_url('index.php?action=carrito'); ?>"><img src="<?php echo asset_url('recursos/carro.png'); ?>" alt="carrito-compra"></a>
        </div>
    </header>

    <!-- contendor principal -->

    <!-- filtro -->
    <div class="sidebar">
        <h3>Filtro:</h3>
        <ul>
            <li>
                <a href="index.php?action=catalogo" class="filter-link <?= !isset($_GET['categoria']) ? 'active' : '' ?>">
                    Todos los productos
                </a>
            </li>
            <li>
                <a href="index.php?action=catalogo&categoria=Repuestos" class="filter-link <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Repuestos') ? 'active' : '' ?>">
                    Repuestos
                </a>
            </li>
            <li>
                <a href="index.php?action=catalogo&categoria=Aceite" class="filter-link <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Aceite') ? 'active' : '' ?>">
                    Aceite
                </a>
            </li>
            <li>
                <a href="index.php?action=catalogo&categoria=Filtros" class="filter-link <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Filtros') ? 'active' : '' ?>">
                    Filtros
                </a>
            </li>
            <li>
                <a href="index.php?action=catalogo&categoria=Neumáticos" class="filter-link <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Neumáticos') ? 'active' : '' ?>">
                    Neumáticos
                </a>
            </li>
            <li>
                <a href="index.php?action=catalogo&categoria=Accesorios" class="filter-link <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Accesorios') ? 'active' : '' ?>">
                    Accesorios
                </a>
            </li>
            <li>
                <a href="index.php?action=catalogo&categoria=Otros" class="filter-link <?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Otros') ? 'active' : '' ?>">
                    Otros
                </a>
            </li>
        </ul>
    </div>

    <!-- Contenido principal - Grid de productos -->
    <div class="main-content">
        <?php if(empty($productos)): ?>
            <p class="no-products">No hay productos disponibles en este momento.</p>
        <?php else: ?>
            <?php foreach($productos as $producto): ?>
                <a href="index.php?action=producto&id=<?= htmlspecialchars($producto['id_producto']) ?>" class="product-card">
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo base_url(htmlspecialchars($producto['imagen'])); ?>" 
                                 alt="<?= htmlspecialchars($producto['nombre']) ?>"
                                 onerror="this.src='<?php echo asset_url('recursos/no-image.png'); ?>'">
                        </div>
                        <h3 class="product-name"><?= htmlspecialchars($producto['nombre']) ?></h3>
                        <p class="product-desc"><?= htmlspecialchars(substr($producto['descripcion'], 0, 100)) ?>...</p>
                        <div class="card-footer">
                            <span class="price"><?= number_format($producto['precio'], 2) ?> €</span>
                            <?php if($producto['stock'] > 0): ?>
                                <button id="addToCart" class="add-to-cart" 
                                        data-producto-id="<?= $producto['id_producto'] ?>"
                                        <?= !isset($_SESSION['user']) ? 'disabled' : '' ?>>
                                        <?= isset($_SESSION['user']) ? 'Añadir al carrito' : 'Inicia sesión para comprar' ?>
                                </button>
                            <?php else: ?>
                                <button type="button" class="out-of-stock" disabled>
                                    Agotado
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
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