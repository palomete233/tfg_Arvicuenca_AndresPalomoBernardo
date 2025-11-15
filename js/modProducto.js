(function(){
    // Este sript se encarga de cargar los datos del producto seleccionado en el formulario
    if(typeof window.MOD_PROD_DATA === 'undefined') window.MOD_PROD_DATA = {};
    let productos = window.MOD_PROD_DATA || {};

    let sel = document.getElementById('producto-select');
    let form = document.getElementById('edit-product-form');

    function loadProduct(id) {
        if (!id) {
            form.reset();
            let hid = document.getElementById('id_producto'); if(hid) hid.value = '';
            return;
        }
        let p = productos[id];
        if (!p) return;
        let hid = document.getElementById('id_producto'); if(hid) hid.value = p.id_producto || p.id || id;
        let nombre = document.getElementById('nombre'); if(nombre) nombre.value = p.nombre || '';
        let descripcion = document.getElementById('descripcion'); if(descripcion) descripcion.value = p.descripcion || '';
        let precio = document.getElementById('precio'); if(precio) precio.value = p.precio || '';
        let categoria = document.getElementById('categoria'); if(categoria) categoria.value = p.categoria || '';
        let stock = document.getElementById('stock'); if(stock) stock.value = p.stock || 0;

        // Mostrar imagen si existe
        let preview = document.getElementById('imagen-preview');
        if(preview){
            if(p.imagen){
                preview.src = '../' + p.imagen.replace(/^\/+/, '');
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        }
    }

    if(sel) sel.addEventListener('change', function(){ loadProduct(this.value); });

    // Cargar datos del primer producto si hay alguno seleccionado
    if(sel && sel.value) loadProduct(sel.value);
})();
