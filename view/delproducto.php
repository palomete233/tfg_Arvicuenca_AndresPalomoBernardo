<?php
    // view: mostrar tabla de productos con checkboxes para eliminar
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    if(empty($_SESSION['user']) || ($_SESSION['rol'] ?? '') !== 'admin'){
        header('Location: ../index.php?action=inicio');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eliminar productos</title>
    <link rel="stylesheet" href="<?php echo asset_url('css/style-delproductos.css'); ?>">
</head>
<body class="delproductos">
    <header>
        <img src="<?php echo asset_url('recursos/logo.png'); ?>" alt="logo" class="logo">
        <h1 class="titulo">Eliminar productos</h1>
        <p>Selecciona los productos que quieres eliminar y pulsa el botón</p>
    </header>

    <main class="delprod-container">
        <?php if(!empty($msg)) echo $msg; ?>

        <form method="post" action="index.php?action=delproducto">
            <table class="delprod-table">
                <thead>
                    <tr>
                        <th style="width:40px;"><input type="checkbox" id="select-all"></th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Stock</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productos as $p): ?>
                        <tr>
                            <td><input type="checkbox" name="delete_ids[]" value="<?= htmlspecialchars($p['id_producto']) ?>"></td>
                            <td><?= htmlspecialchars($p['id_producto']) ?></td>
                            <td><?= htmlspecialchars($p['nombre']) ?></td>
                            <td><?= htmlspecialchars($p['descripcion']) ?></td>
                            <td><?= htmlspecialchars($p['precio']) ?> €</td>
                            <td><?= htmlspecialchars($p['categoria']) ?></td>
                            <td><?= htmlspecialchars($p['stock']) ?></td>
                            <td><img src="<?php echo base_url(htmlspecialchars($p['imagen'])); ?>" alt="img"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="delprod-actions">
                <button type="submit" class="btn">Eliminar seleccionados</button>
            </div>

            <a href="index.php?action=mostrarAdmin" class="volver">Volver al menu</a>
        </form>
    </main>

    <script src="<?php echo asset_url('js/del-productos.js'); ?>"></script>
</body>
</html>
