// Script para mostrar el carrito desde LocalStorage
class CarritoViewer extends CarritoManager {
    constructor() {
        super();
        this.container = document.querySelector('.resumen-pedido');
        this.totalElement = document.querySelector('.total-final');
    }

    // Obtener el descuento del usuario actual
    async obtenerDescuento() {
        try {
            const response = await fetch('index.php?action=obtenerDescuento');
            const data = await response.json();
            return data.descuento || 0;
        } catch (error) {
            console.error('Error al obtener descuento:', error);
            return 0;
        }
    }

    // Calcular el total del pedido incluyendo descuento
    async calcularTotal() {
        const subtotal = this.carrito.reduce((total, item) => total + (item.precio * item.cantidad), 0);
        const descuento = await this.obtenerDescuento();
        const descuentoAplicado = subtotal * descuento;
        return subtotal - descuentoAplicado;
    }

    // Actualizar la vista del carrito
    async actualizarVista() {
        if (!this.container) return;
        
        this.container.innerHTML = '';
        const descuento = await this.obtenerDescuento();
        
        if (this.carrito.length === 0) {
            this.container.innerHTML = '<p class="carrito-vacio">No hay productos en el carrito</p>';
            if (this.totalElement) {
                this.totalElement.innerHTML = `
                    <div class="total-final-precio">
                        <p>Total:</p>
                        <p>0.00€</p>
                    </div>
                `;
            }
            return;
        }

        this.carrito.forEach(item => {
            const articleHTML = `
                <div class="articulo">
                    <img src="${item.imagen}" alt="${item.nombre}">
                    <p>${item.nombre}</p>
                    <div class="detalles">
                        <div class="fila">
                            <p class="titulo">Precio:</p>
                            <p>${item.precio.toFixed(2)} €</p>
                        </div>
                        <div class="fila">
                            <p class="titulo">Cantidad:</p>
                            <p>
                                <button class="boton" onclick="carritoViewer.modificarCantidad(${item.id_producto}, -1)">-</button>
                                <span>${item.cantidad}</span>
                                <button class="boton" onclick="carritoViewer.modificarCantidad(${item.id_producto}, 1)">+</button>
                                <button class="eliminar" onclick="carritoViewer.eliminarProducto(${item.id_producto})">×</button>
                            </p>
                        </div>
                        <div class="fila">
                            <p class="titulo">Total:</p>
                            <p>${(item.precio * item.cantidad).toFixed(2)}€</p>
                        </div>
                    </div>
                </div>
            `;
            this.container.insertAdjacentHTML('beforeend', articleHTML);
        });

        // Actualizar el total con descuento
        const subtotal = this.carrito.reduce((total, item) => total + (item.precio * item.cantidad), 0);
        const descuentoAplicado = subtotal * descuento;
        const total = subtotal - descuentoAplicado;

        if (this.totalElement) {
            this.totalElement.innerHTML = `
                <div class="total-desglose">
                    <p>Subtotal:</p>
                    <p>${subtotal.toFixed(2)}€</p>
                </div>
                ${descuento > 0 ? `
                <div class="descuento-aplicado">
                    <p>Descuento (${(descuento * 100)}%):</p>
                    <p>-${descuentoAplicado.toFixed(2)}€</p>
                </div>` : ''}
                <div class="total-final-precio">
                    <p>Total:</p>
                    <p>${total.toFixed(2)}€</p>
                </div>
            `;
        }
    }

    // Modificar la cantidad de un producto
    async modificarCantidad(productoId, cambio) {
        const producto = this.carrito.find(item => item.id_producto === productoId);
        if (producto) {
            const nuevaCantidad = Math.max(1, producto.cantidad + cambio);
            
            // Verificar stock antes de actualizar
            try {
                const response = await fetch(`index.php?action=verificarStock&id=${productoId}&cantidad=${nuevaCantidad}`, {
                    method: 'GET'
                });
                const data = await response.json();
                
                if (data.success) {
                    producto.cantidad = nuevaCantidad;
                    this.guardarCarrito();
                    this.actualizarVista();
                } else {
                    alert('No hay suficiente stock disponible');
                }
            } catch (error) {
                console.error('Error al verificar stock:', error);
            }
        }
    }

    // Eliminar un producto del carrito
    eliminarProducto(productoId) {
        this.carrito = this.carrito.filter(item => item.id_producto !== productoId);
        this.guardarCarrito();
        this.actualizarVista();
    }
}

// Inicializar el visor del carrito cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.carritoViewer = new CarritoViewer();
    carritoViewer.actualizarVista();
});