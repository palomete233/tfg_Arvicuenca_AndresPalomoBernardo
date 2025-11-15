// Script para la página de pago
class PagoManager extends CarritoManager {
    constructor() {
        super();
        this.resumenProductos = document.getElementById('resumen-productos');
        this.subtotalElement = document.getElementById('subtotal-pago');
        this.descuentoElement = document.getElementById('descuento-pago');
        this.porcentajeDescuentoElement = document.getElementById('porcentaje-descuento');
        this.lineaDescuentoElement = document.getElementById('linea-descuento');
        this.totalElement = document.getElementById('total-pago');
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

    // Mostrar resumen del carrito en la página de pago
    async mostrarResumen() {
        if (this.carrito.length === 0) {
            this.resumenProductos.innerHTML = '<p class="carrito-vacio">No hay productos en el carrito</p>';
            window.location.href = 'index.php?action=carrito';
            return;
        }

        const descuento = await this.obtenerDescuento();
        
        // Mostrar productos
        let productosHTML = '';
        this.carrito.forEach(item => {
            productosHTML += `
                <div class="producto-resumen">
                    <img src="${item.imagen}" alt="${item.nombre}">
                    <div class="producto-info">
                        <p class="producto-nombre">${item.nombre}</p>
                        <p class="producto-cantidad">Cantidad: ${item.cantidad}</p>
                    </div>
                    <p class="producto-precio">${(item.precio * item.cantidad).toFixed(2)}€</p>
                </div>
            `;
        });
        this.resumenProductos.innerHTML = productosHTML;

        // Calcular totales
        const subtotal = this.carrito.reduce((total, item) => total + (item.precio * item.cantidad), 0);
        const descuentoAplicado = subtotal * descuento;
        const total = subtotal - descuentoAplicado;

        // Actualizar valores
        this.subtotalElement.textContent = subtotal.toFixed(2) + '€';
        
        if (descuento > 0) {
            this.lineaDescuentoElement.style.display = 'flex';
            this.porcentajeDescuentoElement.textContent = (descuento * 100).toFixed(0);
            this.descuentoElement.textContent = '-' + descuentoAplicado.toFixed(2) + '€';
        } else {
            this.lineaDescuentoElement.style.display = 'none';
        }
        
        this.totalElement.textContent = total.toFixed(2) + '€';
    }

    // Formatear número de tarjeta
    formatearNumeroTarjeta(input) {
        let valor = input.value.replace(/\s/g, '');
        let formateado = valor.match(/.{1,4}/g);
        input.value = formateado ? formateado.join(' ') : '';
    }

    // Formatear fecha de expiración
    formatearFechaExp(input) {
        let valor = input.value.replace(/\D/g, '');
        if (valor.length >= 2) {
            valor = valor.substring(0, 2) + '/' + valor.substring(2, 4);
        }
        input.value = valor;
    }

    // Validar solo números
    soloNumeros(input) {
        input.value = input.value.replace(/\D/g, '');
    }

    // Inicializar eventos
    inicializarEventos() {
        const metodoPagoRadios = document.querySelectorAll('input[name="metodo_pago"]');
        const datosTarjeta = document.getElementById('datos-tarjeta');
        
        // Mostrar/ocultar datos de tarjeta según método de pago
        metodoPagoRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'tarjeta') {
                    datosTarjeta.style.display = 'block';
                    // Hacer campos requeridos
                    document.getElementById('nombre_titular').required = true;
                    document.getElementById('numero_tarjeta').required = true;
                    document.getElementById('fecha_exp').required = true;
                    document.getElementById('cvv').required = true;
                } else {
                    datosTarjeta.style.display = 'none';
                    // Hacer campos opcionales
                    document.getElementById('nombre_titular').required = false;
                    document.getElementById('numero_tarjeta').required = false;
                    document.getElementById('fecha_exp').required = false;
                    document.getElementById('cvv').required = false;
                }
            });
        });

        // Formatear número de tarjeta
        const numeroTarjeta = document.getElementById('numero_tarjeta');
        if (numeroTarjeta) {
            numeroTarjeta.addEventListener('input', () => this.formatearNumeroTarjeta(numeroTarjeta));
        }

        // Formatear fecha de expiración
        const fechaExp = document.getElementById('fecha_exp');
        if (fechaExp) {
            fechaExp.addEventListener('input', () => this.formatearFechaExp(fechaExp));
        }

        // Solo números en CVV y código postal
        const cvv = document.getElementById('cvv');
        if (cvv) {
            cvv.addEventListener('input', () => this.soloNumeros(cvv));
        }

        const codigoPostal = document.getElementById('codigo_postal');
        if (codigoPostal) {
            codigoPostal.addEventListener('input', () => this.soloNumeros(codigoPostal));
        }

        // Manejar envío del formulario
        const formulario = document.getElementById('formulario-pago');
        if (formulario) {
            formulario.addEventListener('submit', (e) => this.procesarPago(e));
        }
    }

    // Procesar el pago (simulado)
    async procesarPago(e) {
        e.preventDefault();
        
        const metodoPago = document.querySelector('input[name="metodo_pago"]:checked').value;
        
        // Simular procesamiento
        const btnConfirmar = document.querySelector('.btn-confirmar-pago');
        btnConfirmar.disabled = true;
        btnConfirmar.textContent = 'Procesando...';
        
        try {
            // Enviar carrito al servidor para actualizar stock
            const response = await fetch('index.php?action=procesarPedidoAPI', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    carrito: this.carrito
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Si el pedido se procesó correctamente, limpiar el carrito
                localStorage.removeItem('carrito');
                
                // Simular delay de procesamiento
                setTimeout(() => {
                    // Redirigir a página de confirmación
                    window.location.href = 'index.php?action=confirmacionPago&metodo=' + metodoPago;
                }, 1000);
            } else {
                // Si hubo error (por ejemplo, stock insuficiente)
                alert('Error: ' + (data.error || 'No se pudo procesar el pedido'));
                btnConfirmar.disabled = false;
                btnConfirmar.textContent = 'Confirmar Pago';
            }
        } catch (error) {
            console.error('Error al procesar pedido:', error);
            alert('Error al procesar el pedido. Por favor, inténtalo de nuevo.');
            btnConfirmar.disabled = false;
            btnConfirmar.textContent = 'Confirmar Pago';
        }
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    const pagoManager = new PagoManager();
    pagoManager.mostrarResumen();
    pagoManager.inicializarEventos();
});
