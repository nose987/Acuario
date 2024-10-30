function abrirModal(codigo, nombre, stock) {
    console.log(codigo, nombre, stock);
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('codigo').value = codigo;
    document.getElementById('nombre').value = nombre;
    document.getElementById('stock').value = stock;
    
}

function cerrarModal() {
    document.getElementById('modal').style.display = 'none';
}




document.querySelector('.form_modal form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('../functions/actualizar_stock.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        console.log(data);
        if(data.includes('correctamente')){
            cerrarModal();
            location.reload(); 
        }
    });
});