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
    <link rel="stylesheet" type="text/css" href="../css/style-delUser.css">
    <link rel="icon" href="../recursos/favicon.ico" type="image/x-icon">
    <title>Eliminar Usuarios</title>
</head>
<body>
    <!-- Cabecera -->
    <header>
        <img src="../recursos/logo.png" alt="logo ArviCuenca" class="logo">
        <h1 class="titulo">Eliminar usuarios</h1>
        <p>Selecciona el usuario que quieres eliminar</p>
    </header>

    <div class="form-container">
        <form action="index.php?action=del" method="post">
            <label for="nombre">Nombre de usuario a eliminar:</label>
            <select id="nombre" name="nombre" required>
                <option value="">-- Seleccione usuario --</option>
                <?php foreach($users as $user): ?>
                    <option value="<?= $user['nom_user'] ?>"><?= $user['nom_user'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Eliminar Usuario</button>

            <a href="index.php?action=mostrarAdmin" class="volver">Volver al menu</a>
        </form>
    </div>
    
</body>
</html>