// JS para la vista de eliminar productos
document.addEventListener('DOMContentLoaded', function(){
    let selectAll = document.getElementById('select-all');
    if(selectAll){
        selectAll.addEventListener('change', function(e){
            let checked = e.target.checked;
            document.querySelectorAll('input[name="delete_ids[]"]').forEach(function(cb){ cb.checked = checked; });
        });
    }
});
