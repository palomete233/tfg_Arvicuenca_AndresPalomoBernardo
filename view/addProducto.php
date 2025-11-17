<?php
//Con esto hacemos que si no hay una sesion iniciada o el rol no es user nos redirija al inicio
if (!isset($_SESSION["user"]) || $_SESSION["rol"] != "admin") {
    header("Location: ../index.php?action=inicio");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/style-addProducto.css'); ?>">
    <title>Añadir producto</title>
</head>

<body>
    <!-- Cebecera -->
    <header>
        <img src="<?php echo asset_url('recursos/logo.png'); ?>" alt="logo ArviCuenca" class="logo">
        <h1 class="titulo">Añadir nuevo producto</h1>
        <p>Rellene este formulario para crear un nuevo producto</p>
    </header>

    <!-- formulario de insertar producto -->
    <div class="form-container">
        <form action="index.php?action=insertar" method="post" enctype="multipart/form-data">

            <label for="nombre">Nombre del producto:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>

            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <option value="">-- Seleccione categoría --</option>
                <option value="repuestos">Repuestos</option>
                <option value="aceite">Aceite</option>
                <option value="filtros">Filtros</option>
                <option value="neumaticos">Neumáticos</option>
                <option value="accesorios">Accesorios</option>
                <option value="otros">Otros</option>
            </select>

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" min="1" required>
            <div class="help-text">El stock debe ser un número entero mayor o igual a 1.</div>

            <button type="submit">Agregar Producto</button>

            <a href="index.php?action=mostrarAdmin" class="volver">Volver al menu</a>
        </form>
    </div>

</body>

</html>