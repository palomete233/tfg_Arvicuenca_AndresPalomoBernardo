// Función para manejar el carrito usando LocalStorage
class CarritoManager {
    constructor() {
        this.carrito = this.obtenerCarrito();
    }

    // Obtener el carrito del LocalStorage
    obtenerCarrito() {
        const carritoGuardado = localStorage.getItem('carrito');
        return carritoGuardado ? JSON.parse(carritoGuardado) : [];
    }

    // Guardar el carrito en LocalStorage
    guardarCarrito() {
        localStorage.setItem('carrito', JSON.stringify(this.carrito));
    }

    // Añadir un producto al carrito
    async agregarProducto(producto) {
        try {
            // Calcular la cantidad total que tendría el producto
            let cantidadTotal = producto.cantidad;
            const productoExistente = this.carrito.find(item => item.id_producto === producto.id_producto);
            if (productoExistente) {
                cantidadTotal += productoExistente.cantidad;
            }

            // Verificar stock antes de agregar
            const response = await fetch(`../index.php?action=verificarStock&id=${producto.id_producto}&cantidad=${cantidadTotal}`);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Respuesta del servidor:', data); // Para debug
            
            if (data.success) {
                if (productoExistente) {
                    productoExistente.cantidad = cantidadTotal;
                } else {
                    this.carrito.push(producto);
                }
                this.guardarCarrito();
                return true;
            } else {
                alert('No hay suficiente stock disponible');
                return false;
            }
        } catch (error) {
            console.error('Error al verificar stock:', error);
            alert('Error al verificar el stock disponible');
            return false;
        }
    }

    // Obtener el total de productos en el carrito
    obtenerTotal() {
        return this.carrito.reduce((total, item) => total + item.cantidad, 0);
    }
}

// Inicializar el gestor del carrito
const carritoManager = new CarritoManager();

// Cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    const btnAddToCart = document.getElementById('addToCart');
    const inputCantidad = document.getElementById('cantidad');
    
    if (btnAddToCart && inputCantidad) {
        btnAddToCart.addEventListener('click', async function() {
            const productoId = this.dataset.productoId;
            const cantidad = parseInt(inputCantidad.value);
            
            // Obtener los datos del producto del script incrustado
            const producto = {
                id_producto: parseInt(productoId),
                nombre: document.querySelector('.details h1').textContent,
                precio: parseFloat(document.querySelector('.monto').textContent.replace('€', '')),
                imagen: document.querySelector('.image img').src,
                cantidad: cantidad
            };

            // Añadir al LocalStorage y verificar stock
            const agregado = await carritoManager.agregarProducto(producto);
            
            if (agregado) {
                // Mostrar mensaje de éxito
                alert('Producto añadido al carrito');
                // Redirigir al carrito
                window.location.href = 'index.php?action=carrito';
            }
        });

        // Manejar los botones de cantidad
        document.querySelectorAll('.btn-cantidad').forEach(btn => {
            btn.addEventListener('click', function() {
                const currentVal = parseInt(inputCantidad.value);
                const maxStock = parseInt(inputCantidad.getAttribute('max'));
                
                if (this.dataset.action === 'increase' && currentVal < maxStock) {
                    inputCantidad.value = currentVal + 1;
                } else if (this.dataset.action === 'decrease' && currentVal > 1) {
                    inputCantidad.value = currentVal - 1;
                }
            });
        });
    }
});