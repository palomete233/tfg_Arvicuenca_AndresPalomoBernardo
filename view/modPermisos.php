<?php
    //Con esto lo que hacemos es evitar que nos entren a esta vista si no estan logeados
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
    <link rel="icon" href="../recursos/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url('css/style-modPermisos.css'); ?>">
    <title>Modificar permisos</title>
</head>
<body>
    <!-- Cebecera -->
    <header>
        <img src="<?php echo asset_url('recursos/logo.png'); ?>" alt="logo ArviCuenca" class="logo">
        <h1 class="titulo">Modificar permisos</h1>
        <p>Seleccione un usuario y cambie su rol</p>
    </header>

    <!-- Formulario para cambiar permisos -->
    <div class="form-container">
        <form action="index.php?action=modPermisos" method="post">
            <label for="nom_user">Nombre de usuario a modificar:</label>
            <select id="nom_user" name="nom_user" required>
                <option value="">-- Seleccione usuario --</option>
                <?php foreach($users as $user): ?>
                    <option value="<?= $user['nom_user'] ?>"><?= $user['nom_user'] ?></option>
                <?php endforeach; ?>
            </select>

                </br>
            
            <select class="select-rol" id="rol" name="rol">
                <option value="admin">admin</option>
                <option value="user">user</option>
            </select><br>

            <button type="submit">Modificar</button>

            <a href="index.php?action=mostrarAdmin" class="volver">Volver al menu</a>
        </form>
    </div>
</body>
</html>