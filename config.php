<?php
/**
 * Configuración de la aplicación
 * Sistema de rutas absolutas para CSS/JS
 */

    // Detectar la ruta base del proyecto automáticamente
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];

    // Obtener la ruta del script actual
    $script_path = $_SERVER['SCRIPT_NAME'];

    // Si estamos en una vista, subir un nivel
    if (strpos($script_path, '/view/') !== false) {
        $base_path = str_replace('/view/' . basename($script_path), '', $script_path);
    } else {
        $base_path = dirname($script_path);
    }

    // Asegurar que termine con /
    if ($base_path !== '/' && substr($base_path, -1) !== '/') {
        $base_path .= '/';
    }

    define('BASE_URL', $protocol . '://' . $host . $base_path);

    // Configuración de base de datos
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'arvicuenca');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    /**
     * Función para generar URLs absolutas
     */
    function base_url($path = '') {
        return BASE_URL . ltrim($path, '/');
    }

    /**
     * Función para generar rutas de assets (CSS, JS, imágenes)
     */
    function asset_url($path = '') {
        return BASE_URL . ltrim($path, '/');
    }
?>