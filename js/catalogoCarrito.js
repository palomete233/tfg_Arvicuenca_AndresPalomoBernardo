// Función para añadir productos al carrito desde el catálogo
function addToCart(productoId, event) {
    if (event) {
        event.preventDefault();
    }
    
    const card = document.querySelector(`[data-id="${productoId}"]`).closest('.card');
    const producto = {
        id_producto: productoId,
        nombre: card.querySelector('.product-name').textContent,
        precio: parseFloat(card.querySelector('.price').textContent.replace('€', '').trim()),
        imagen: card.querySelector('.card-image img').src,
        cantidad: 1
    };

    // Usar el CarritoManager del carrito.js
    carritoManager.agregarProducto(producto);
    
    // Mostrar mensaje y redirigir
    alert('Producto añadido al carrito');
    window.location.href = 'index.php?action=carrito';
}