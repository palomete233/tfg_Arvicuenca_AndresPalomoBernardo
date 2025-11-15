<?php
    // Vista para modificar productos: lista desplegable + formulario
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if (empty($_SESSION['user']) || ($_SESSION['rol'] ?? '') !== 'admin') {
        header('Location: ../index.php?action=inicio');
        exit();
    }

    require_once 'model/productos_model.php';

    // Obtener todos los productos para la lista desplegable
    $model = new product_Model();
    $productos = $productos ?? $model->mostrarProductos();
    $productos = is_array($productos) ? $productos : [];
    $productos_map = [];

    foreach ($productos as $p) {
        $productos_map[$p['id_producto']] = $p;
    }
    $msg = $msg ?? '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../recursos/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style-modProductos.css">
    <title>Modificar producto</title>
</head>

<body>
    <!-- Cebecera -->
    <header>
        <img src="../recursos/logo.png" alt="logo ArviCuenca" class="logo">
        <h1 class="titulo">Modificar un producto</h1>
        <p>Seleccione un producto y cambie los campos que desee</p>
    </header>

    <!-- Formulario de actualizacion -->
    <main class="modprod-main">
        <?= $msg ?>
        <label for="producto-select">Selecciona un producto:</label>
        <select id="producto-select" class="modprod-selector">
            <option value="">-- Selecciona --</option>
            <?php foreach ($productos as $p): ?>
                <option value="<?= $p['id_producto'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
        <div class="form-container modprod-form" style="margin-top:12px;">
            <form id="edit-product-form" method="post" action="index.php?action=modProducto" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_product">
                <input type="hidden" id="id_producto" name="id_producto" value="">

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion" rows="4"></textarea>

                <label for="precio">Precio</label>
                <input type="number" step="0.01" id="precio" name="precio" required>

                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria">
                    <option value="repuestos">Repuestos</option>
                    <option value="aceite">Aceite</option>
                    <option value="filtros">Filtros</option>
                    <option value="neumaticos">Neumáticos</option>
                    <option value="accesorios">Accesorios</option>
                    <option value="otros">Otros</option>
                </select>

                <label for="imagen">Imagen (opcional)</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
                <img id="imagen-preview" alt="Imagen actual del producto">

                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" required min="0">

                <div class="form-actions">
                    <button type="submit">Actualizar</button>
                </div>

                <a href="index.php?action=mostrarAdmin" class="volver">Volver al menu</a>
            </form>
        </div>
    </main>

    <script>
        // Expose product data for the external script to consume
        window.MOD_PROD_DATA = <?php echo json_encode($productos_map, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?> || {};
    </script>
    <script src="../js/modProducto.js"></script>
</body>

</html>