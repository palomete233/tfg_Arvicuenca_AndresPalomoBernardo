<?php
/**
 * Archivo para detectar acceso directo a vistas
 * Incluir este archivo al inicio de cada vista para redirigir correctamente
 */

// Si se accede directamente a una vista (no a través del router principal)
if (basename($_SERVER['SCRIPT_NAME']) !== 'index.php') {
    // Redirigir al index principal
    $host = $_SERVER['HTTP_HOST'];
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    
    // Detectar la carpeta del proyecto
    $current_dir = dirname($_SERVER['SCRIPT_NAME']);
    if (strpos($current_dir, '/view') !== false) {
        $project_dir = str_replace('/view', '', $current_dir);
    } else {
        $project_dir = $current_dir;
    }
    
    $redirect_url = $protocol . '://' . $host . $project_dir . '/index.php';
    
    // Redirigir con mensaje
    header("Location: $redirect_url");
    exit("Acceso directo no permitido. Redirigiendo al inicio...");
}
?>