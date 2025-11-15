<?php
    require_once "conex.php";

    class product_Model{
        //Creamos la  conexion para crear la instnacia
        private $conex = null;

        public function __construct(){
            $this->conex = Conexion::getConex();
        }

        //Aqui empezamos a realizar los metodos que vamos a necesitar

        //Con este metdodo mostramos todos los productos que tenemos en la base de datos
        public function mostrarProductos(){
            try {
                $sql = $this->conex->prepare("SELECT * FROM productos");
                $sql->execute();
                $resul = $sql->fetchAll();

                return $resul;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        //Con este metodo insertamos un nuevo producto en la base de datos
        public function insertarProducto($nombre, $descripcion, $precio, $categoria, $imagen, $stock){
            try {
                // Validación: el stock debe ser un entero mayor que 0
                if(!is_numeric($stock) || intval($stock) <= 0){
                    // No insertar stock 0 o negativo
                    return false;
                }
                $stock = intval($stock);
                $comp = $this->conex->prepare("SELECT * FROM productos WHERE nombre = ?");
                $comp->execute([$nombre]);

                if($comp->rowCount() > 0){
                    return false; // El producto ya existe
                }else{
                    // El producto no existe, proceder a insertarlo
                    $sql = $this->conex->prepare("INSERT INTO productos (nombre, descripcion, precio, categoria, imagen, stock) VALUES (?, ?, ?, ?, ?, ?)");
                    $resul = $sql->execute([$nombre, $descripcion, $precio, $categoria, $imagen, $stock]);

                    return $resul; // Retorna true si la inserción fue exitosa
                }
            } catch (PDOException $e) {
                error_log("Error al insertar guía: " . $e->getMessage()); // Registrar el error
                return false; // Retornar false en caso de error
            }
            
        }

        //Con este metodo eliminamos un producto de la base de datos
        public function eliminarProducto($id){
            try {
                $sql = $this->conex->prepare("DELETE FROM productos WHERE id_producto = ?");
                $resul = $sql->execute([$id]);
                return (bool) $resul;
            } catch (PDOException $e) {
                error_log("Error al eliminar producto: " . $e->getMessage()); // Registrar el error
                return false; // Retornar false en caso de error
            }
        }

        // Obtener un producto por id
        public function obtenerProducto($id){
            try{
                $sql = $this->conex->prepare("SELECT * FROM productos WHERE id_producto = ? LIMIT 1");
                $sql->execute([$id]);
                return $sql->fetch();
            } catch (PDOException $e){
                error_log("Error al obtener producto: " . $e->getMessage());
                return false;
            }
        }

        // Actualizar producto
        public function actualizarProducto($id, $nombre, $descripcion, $precio, $categoria, $imagen, $stock){
            try{
                if(!is_numeric($stock) || intval($stock) < 0) return false;
                $stock = intval($stock);
                $sql = $this->conex->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, imagen = ?, stock = ? WHERE id_producto = ?");
                return $sql->execute([$nombre, $descripcion, $precio, $categoria, $imagen, $stock, $id]);
            } catch (PDOException $e){
                error_log("Error al actualizar producto: " . $e->getMessage());
                return false;
            }
        }

        // Obtener productos por categoría
        public function obtenerPorCategoria($categoria){
            try {
                $sql = $this->conex->prepare("SELECT * FROM productos WHERE categoria = ?");
                $sql->execute([$categoria]);
                return $sql->fetchAll();
            } catch (PDOException $e) {
                error_log("Error al obtener productos por categoría: " . $e->getMessage());
                return [];
            }
        }

        // Buscar productos
        public function buscarProductos($termino){
            try {
                $termino = "%$termino%";
                $sql = $this->conex->prepare("SELECT * FROM productos WHERE nombre LIKE ? OR descripcion LIKE ?");
                $sql->execute([$termino, $termino]);
                return $sql->fetchAll();
            } catch (PDOException $e) {
                error_log("Error al buscar productos: " . $e->getMessage());
                return [];
            }
        }

        // Verificar stock disponible
        public function verificarStock($id_producto, $cantidad = 1){
            try {
                if($cantidad < 1) return false;
                
                $sql = $this->conex->prepare("SELECT stock FROM productos WHERE id_producto = ?");
                $sql->execute([$id_producto]);
                $producto = $sql->fetch(PDO::FETCH_ASSOC);
                
                if (!$producto) return false;
                
                $stockDisponible = intval($producto['stock']);
                return $stockDisponible >= $cantidad;
            } catch (PDOException $e) {
                error_log("Error al verificar stock: " . $e->getMessage());
                return false;
            }
        }

        // Actualizar stock después de una compra
        public function actualizarStock($id_producto, $cantidad){
            try {
                // Primero verificamos que hay suficiente stock
                if(!$this->verificarStock($id_producto, $cantidad)) return false;
                
                $sql = $this->conex->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ? AND stock >= ?");
                return $sql->execute([$cantidad, $id_producto, $cantidad]);
            } catch (PDOException $e) {
                error_log("Error al actualizar stock: " . $e->getMessage());
                return false;
            }
        }

        // Obtener productos más vendidos
        public function obtenerMasVendidos($limite = 6){
            try {
                // Asumiendo que tienes una tabla pedidos_detalle con id_producto y cantidad
                $sql = $this->conex->prepare("
                    SELECT p.*, COALESCE(SUM(pd.cantidad), 0) as vendidos 
                    FROM productos p 
                    LEFT JOIN pedidos_detalle pd ON p.id_producto = pd.id_producto 
                    GROUP BY p.id_producto 
                    ORDER BY vendidos DESC 
                    LIMIT ?
                ");
                $sql->execute([$limite]);
                return $sql->fetchAll();
            } catch (PDOException $e) {
                error_log("Error al obtener productos más vendidos: " . $e->getMessage());
                return [];
            }
        }
    }
?>
