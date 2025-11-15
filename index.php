<?php
    /**
     * Router principal de la aplicación
     * Gestiona todas las rutas y redirecciona a los controladores correspondientes
     */

    // Importar controladores necesarios
    require_once "controller/login_controller.php";
    require_once "controller/admin_controller.php";
    require_once "controller/user_controller.php";
    require_once "controller/productos_controller.php";

    // Inicializar controladores
    $log = new login_controller();    // Gestión de login/logout
    $admin = new Admin_controller();  // Panel de administración
    $user = new User_controller();    // Funciones de usuario
    $pro = new Productos_controller(); // Gestión de productos

    // Obtener acción de la URL (?action=X), por defecto 'inicio'
    $var = $_GET['action'] ?? 'inicio';

    // Router principal - redirecciona según la acción
    switch($var){
        // --- Autenticación ---
        case "loginAction":  // Procesar login
            $log->login();
            break;
        case "logout":      // Cerrar sesión
            $log->logout();
            break;
        case "deleteCookie": // Eliminar cookie de sesión
            $log->delCookie();
            break;

        // --- Panel Admin ---
        case "mostrarAdmin": // Vista panel admin
            $admin->mostrarAdmin();
            break;

        // --- Gestión Usuarios ---
        case "mostrarUser":  // Vista panel usuario
            $user->mostrarUser();
            break;
        case "registrarse":  // Registro nuevo usuario
            $user->registrarse();
            break;
        case "del":         // Eliminar usuario
            $user->eliminarUser();
            break;
        case "modPermisos": // Modificar permisos usuario
            $user->modPermisos();
            break;

        // --- Gestión Productos ---
        case "insertar":    // Añadir nuevo producto
            $pro->insertarProducto();
            break;
        case "modProducto": // Modificar producto existente
            $pro->modificarProducto();
            break; 
        case "delproducto": // Eliminar producto
            $pro->mostrarEliminarProductos();
            break;

        // --- Contacto ---
        case "mostrarContacto": // Vista página contacto
            $user->mostrarContacto();
            break;
        case "mostrarConsultas": // Ver consultas recibidas
            $user->mostrarConsultas();
            break;
        case "enviar":      // Enviar consulta
            $user->enviar();
            break;

        // --- Tienda y Carrito ---
        case "catalogo":    // Vista catálogo productos
            $pro->mostrarCatalogo();
            break;
        case "producto":    // Ver detalle de producto
            $pro->verProducto();
            break;
        case "addToCart":   // Añadir al carrito
            $pro->addToCart();
            break;
        case "carrito":     // Ver carrito
            $pro->verCarrito();
            break;
        case "pago":        // Mostrar página de pago
            $pro->mostrarPago();
            break;
        case "confirmacionPago": // Mostrar confirmación de pago
            $pro->confirmarPago();
            break;
        case "verificarStock": // API: Verificar stock disponible
            $pro->verificarStock();
            break;
        case "procesarPedidoAPI": // API: Procesar pedido y reducir stock
            $pro->procesarPedido();
            break;
        case "obtenerDescuento": // Obtener descuento del usuario
            $user->obtenerDescuento();
            break;

        // --- Por defecto ---
        default:           // Página inicio
            $log->index();
            break;
    }
?>