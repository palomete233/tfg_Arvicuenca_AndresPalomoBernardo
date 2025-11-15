<?php
    require_once "model/productos_model.php";

    /**
     * Controlador de Productos
     * Gestiona todas las operaciones relacionadas con productos:
     * - CRUD de productos
     * - Verificación de stock
     * - Gestión del carrito
     * - Visualización de catálogo
     */
    class Productos_controller {
        private $produc;

        public function __construct() {
            $this->produc = new product_Model();
        }

        // Verificar stock disponible para un producto (AJAX)
        public function verificarStock() {
            header('Content-Type: application/json');
            
            try {
                // Validar parámetros recibidos
                if(isset($_GET['id']) && isset($_GET['cantidad'])) {
                    $id_producto = intval($_GET['id']);
                    $cantidad = intval($_GET['cantidad']);
                    
                    // Validar valores
                    if($id_producto <= 0 || $cantidad <= 0) {
                        throw new Exception('Datos inválidos');
                    }
                    
                    // Consultar disponibilidad
                    $hayStock = $this->produc->verificarStock($id_producto, $cantidad);
                    echo json_encode([
                        'success' => $hayStock,
                        'mensaje' => $hayStock ? 'Stock disponible' : 'Stock insuficiente',
                        'stock_solicitado' => $cantidad
                    ]);
                } else {
                    throw new Exception('Faltan parámetros');
                }
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
            exit();
        }

        //Con este metodo insertamos un nuevo producto en la base de datos
        public function insertarProducto(){
            if(!isset($_SESSION["user"]) && $_SESSION["rol"] != "user" && $_SESSION["rol"] != "admin"){
                header("Location: ../index.php?action=inicio");
                exit();
            }

            if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["imagen"])){
                $nombre = $_POST["nombre"];
                $descripcion = $_POST["descripcion"];
                $precio = $_POST["precio"];
                $categoria = $_POST["categoria"];
                $archivo = $_FILES["imagen"];
                $stock = $_POST["stock"];

                // Manejar la subida de la imagen
                if($archivo["size"] > 3 * 1024 * 1024){
                    echo "<p class='error'>El archivo es demasiado grande. El tamaño máximo es 3MB.</p>";
                    include "view/addProducto.php";
                    exit();
                }

                $tiposPermitidos = ["image/jpeg", "image/png", "image/gif"];
                if(!in_array($archivo["type"], $tiposPermitidos)){
                    echo "<p class='error'>Tipo de archivo no permitido. Solo se permiten imágenes JPEG, PNG y GIF.</p>";
                    include "view/addProducto.php";
                    exit();
                }

                $dir = "img/";
                if(!file_exists($dir)){
                    mkdir($dir, 0777, true);
                }

                $disDestino = $dir . basename($_FILES["imagen"]["name"]);
                if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $disDestino)){
                    $resul = $this->produc->insertarProducto($nombre, $descripcion, $precio, $categoria, $disDestino, $stock);

                    if($resul === true){
                        echo "<p class='mensaje'>Producto agregado correctamente</p>";
                        include "view/addProducto.php";
                    }else{
                        echo "<p class='error'>Error al agregar el producto. Puede que el producto ya exista o el stock no sea válido.</p>";
                        include "view/addProducto.php";
                    }
                } 
            }else{
                require_once "view/addProducto.php";
            }
        }

        // Mostrar lista de productos con checkbox para eliminar
        public function mostrarEliminarProductos(){
            // aseguramos sesión y rol admin
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            if(empty($_SESSION['user']) || ($_SESSION['rol'] ?? '') !== 'admin'){
                header('Location: ../index.php?action=inicio');
                exit();
            }

            // Procesar eliminación POST
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_ids'])){
                $ids = $_POST['delete_ids']; // array de ids
                $deleted = 0;
                foreach($ids as $id){
                    $id = intval($id);
                    if($id > 0){
                        $ok = $this->produc->eliminarProducto($id);
                        if($ok) $deleted++;
                    }
                }
                $msg = "<p class='mensaje'>Se eliminaron $deleted productos.</p>";
                // recargar la vista con mensaje
                $productos = $this->produc->mostrarProductos();
                include "view/delproducto.php";
                return;
            }
            
            $productos = $this->produc->mostrarProductos();
            include "view/delproducto.php";
        }

        // Mostrar y procesar modificación de un producto
        public function modificarProducto(){
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            if(empty($_SESSION['user']) || ($_SESSION['rol'] ?? '') !== 'admin'){
                header('Location: ../index.php?action=inicio');
                exit();
            }

            // POST: actualizar
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_product'){
                $id = intval($_POST['id_producto'] ?? 0);
                $nombre = $_POST['nombre'] ?? '';
                $descripcion = $_POST['descripcion'] ?? '';
                $precio = $_POST['precio'] ?? 0;
                $categoria = $_POST['categoria'] ?? '';
                $stock = $_POST['stock'] ?? 0;

                // imagen opcional
                $imagenPath = null;
                if(isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0){
                    $archivo = $_FILES['imagen'];
                    $tiposPermitidos = ["image/jpeg", "image/png", "image/gif"];
                    if(!in_array($archivo['type'], $tiposPermitidos)){
                        $msg = "<p class='error'>Tipo de imagen no permitido.</p>";
                    } else {
                        $dirAbs = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
                        if(!file_exists($dirAbs)) mkdir($dirAbs, 0777, true);
                        $filename = basename($archivo['name']);
                        $destAbs = $dirAbs . $filename;
                        if(move_uploaded_file($archivo['tmp_name'], $destAbs)){
                            $imagenPath = 'img/'.$filename;
                        }
                    }
                }

                // Si no se subió imagen, obtener la actual para no perderla
                if(!$imagenPath){
                    $current = $this->produc->obtenerProducto($id);
                    $imagenPath = $current['imagen'] ?? '';
                }

                $ok = $this->produc->actualizarProducto($id, $nombre, $descripcion, $precio, $categoria, $imagenPath, $stock);

                // Lanzamos los mensajes de error o exito
                if($ok) $msg = "<p class='mensaje'>Producto actualizado correctamente</p>";
                else $msg = "<p class='error'>Error actualizando producto</p>";

                $productos = $this->produc->mostrarProductos();
                include 'view/modProducto.php';
                return;
            }

            // GET: mostrar vista
            $productos = $this->produc->mostrarProductos();
            include 'view/modProducto.php';
        }

        // Mostrar catálogo de productos
        public function mostrarCatalogo(){
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            // Manejar filtros
            $categoria = $_GET['categoria'] ?? null;
            $busqueda = $_GET['buscar'] ?? null;
            
            if($categoria){
                $productos = $this->produc->obtenerPorCategoria($categoria);
            } elseif($busqueda){
                $productos = $this->produc->buscarProductos($busqueda);
            } else {
                $productos = $this->produc->mostrarProductos();
            }

            // Obtener productos destacados si estamos en la primera página
            $destacados = [];
            if(!$categoria && !$busqueda){
                $destacados = $this->produc->obtenerMasVendidos(4);
            }

            include 'view/catalogo.php';
        }

        // Ver detalles de un producto
        public function verProducto(){
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            $id = intval($_GET['id'] ?? 0);
            if($id <= 0){
                header('Location: index.php?action=catalogo');
                exit();
            }

            $producto = $this->produc->obtenerProducto($id);
            if(!$producto){
                header('Location: index.php?action=catalogo');
                exit();
            }

            // Obtener productos relacionados de la misma categoría
            $relacionados = $this->produc->obtenerPorCategoria($producto['categoria']);
            $relacionados = array_filter($relacionados, function($p) use ($id) {
                return $p['id_producto'] != $id;
            });
            // Limitar a 4 productos relacionados
            $relacionados = array_slice($relacionados, 0, 4);

            include 'view/productoEspecifico.php';
        }

        // Añadir al carrito (AJAX)
        public function addToCart(){
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            // Verificar si está logueado
            if(empty($_SESSION['user'])){
                echo json_encode(['success' => false, 'message' => 'Debe iniciar sesión para comprar']);
                return;
            }

            // Verificar request
            if($_SERVER['REQUEST_METHOD'] !== 'POST'){
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
                return;
            }

            $id_producto = intval($_POST['id_producto'] ?? 0);
            $cantidad = intval($_POST['cantidad'] ?? 1);

            if($id_producto <= 0 || $cantidad <= 0){
                echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
                return;
            }

            // Verificar stock
            if(!$this->produc->verificarStock($id_producto, $cantidad)){
                echo json_encode(['success' => false, 'message' => 'No hay suficiente stock']);
                return;
            }

            // Inicializar carrito si no existe
            if(!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];

            // Añadir o actualizar cantidad en carrito
            $found = false;
            foreach($_SESSION['carrito'] as &$item){
                if($item['id_producto'] == $id_producto){
                    $item['cantidad'] += $cantidad;
                    $found = true;
                    break;
                }
            }

            if(!$found){
                $producto = $this->produc->obtenerProducto($id_producto);
                if(!$producto){
                    echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
                    return;
                }
                $_SESSION['carrito'][] = [
                    'id_producto' => $id_producto,
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => $cantidad,
                    'imagen' => $producto['imagen']
                ];
            }

            echo json_encode([
                'success' => true,
                'message' => 'Producto añadido al carrito',
                'cartCount' => count($_SESSION['carrito'])
            ]);
        }

        // Ver carrito de compras
        public function verCarrito() {
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            // Inicializar carrito si no existe
            if(!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];

            // Calcular total
            $total = 0;
            foreach($_SESSION['carrito'] as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            include 'view/carrito.php';
        }

        // Mostrar página de pago
        public function mostrarPago() {
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            // Verificar que el usuario esté logueado y tenga rol de usuario
            if(!isset($_SESSION["user"]) || $_SESSION["rol"] != "user"){
                header("Location: index.php?action=inicio");
                exit();
            }

            // Verificar que el carrito no esté vacío (desde localStorage se gestiona en JS)
            
            include 'view/pago.php';
        }

        // Mostrar confirmación de pago
        public function confirmarPago() {
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            
            // Verificar que el usuario esté logueado y tenga rol de usuario
            if(!isset($_SESSION["user"]) || $_SESSION["rol"] != "user"){
                header("Location: index.php?action=inicio");
                exit();
            }
            
            include 'view/confirmacionPago.php';
        }

        // Procesar pedido y actualizar stock
        public function procesarPedido() {
            header('Content-Type: application/json');
            
            try {
                if(session_status() !== PHP_SESSION_ACTIVE) session_start();
                
                // Verificar que el usuario esté logueado
                if(empty($_SESSION['user'])){
                    echo json_encode([
                        'success' => false,
                        'error' => 'Debe iniciar sesión'
                    ]);
                    exit();
                }

                // Obtener datos del carrito desde el body JSON
                $input = file_get_contents('php://input');
                $data = json_decode($input, true);
                
                if(!isset($data['carrito']) || empty($data['carrito'])){
                    echo json_encode([
                        'success' => false,
                        'error' => 'El carrito está vacío'
                    ]);
                    exit();
                }

                $carrito = $data['carrito'];
                $errores = [];
                
                // Primero verificar que hay stock suficiente para todos los productos
                foreach($carrito as $item){
                    $id_producto = intval($item['id_producto']);
                    $cantidad = intval($item['cantidad']);
                    
                    if(!$this->produc->verificarStock($id_producto, $cantidad)){
                        $errores[] = "Stock insuficiente para: " . $item['nombre'];
                    }
                }

                // Si hay errores, devolver sin actualizar stock
                if(!empty($errores)){
                    echo json_encode([
                        'success' => false,
                        'error' => implode(', ', $errores)
                    ]);
                    exit();
                }

                // Si todo está ok, actualizar el stock de cada producto
                foreach($carrito as $item){
                    $id_producto = intval($item['id_producto']);
                    $cantidad = intval($item['cantidad']);
                    
                    $actualizado = $this->produc->actualizarStock($id_producto, $cantidad);
                    
                    if(!$actualizado){
                        $errores[] = "Error al actualizar stock de: " . $item['nombre'];
                    }
                }

                // Si hubo errores al actualizar
                if(!empty($errores)){
                    echo json_encode([
                        'success' => false,
                        'error' => implode(', ', $errores)
                    ]);
                    exit();
                }

                // OKEY
                echo json_encode([
                    'success' => true,
                    'mensaje' => 'Pedido procesado correctamente'
                ]);
                
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Error al procesar el pedido: ' . $e->getMessage()
                ]);
            }
            exit();
        }
    
    }
?>