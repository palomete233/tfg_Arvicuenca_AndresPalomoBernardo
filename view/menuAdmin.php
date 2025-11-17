<?php
    //Con esto hacemos que si no hay una sesion iniciada o el rol no es user nos redirija al inicio
    if(!isset($_SESSION["user"]) || $_SESSION["rol"] != "admin"){
        header("Location: ../index.php?action=inicio");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/style-menuAdmin.css'); ?>">
    <title>Menu del admin</title>
</head>
<body>
  <!-- Cabecera -->
    <header>
        <img src="<?php echo asset_url('recursos/logo.png'); ?>" alt="logo ArviCuenca" class="logo">
        <h1 class="titulo">Panel de administracion</h1>
        <p>Bienvenido al panel de administracion, porfavor seleccione una tarea</p>
    </header>

    <!-- botones -->
    <aside class="aside-botones">
        <div class="cerrar-sesion">
            <h3>Cerrar Sesion</h3>
            <a href="index.php?action=logout" class="cerrar-sesion"><span class="inicio">X</span></a>
        </div>
    </aside>

    <!-- Menu desplegable -->
    <nav>
        <div class="menu-container">
            <h3 id="menu-title" onclick="toggleMenu()">¿Que quieres hacer? <span class="arrow">▼</span></h3>
            <ul id="menu" class="menu">
                <li><a href="index.php?action=insertar">Agregar nuevo producto</a></li>
                <li><a href="index.php?action=del">Eliminar usuario</a></li>
                <li><a href="index.php?action=delproducto">Eliminar producto</a></li>
                <li><a href="index.php?action=modProducto">Modificar producto</a></li>
                <li><a href="index.php?action=modPermisos">Modificar permisos</a></li>
            </ul>
        </div>
    </nav>

    <script src="<?php echo asset_url('js/js_menuAdmin.js'); ?>"></script><!--Este js nos  hace el que el menu sea desplegable -->
</body>
</html>