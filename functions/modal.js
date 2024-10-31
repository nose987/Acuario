function abrirModal(codigo, nombre, stock) {
    const modal = document.getElementById('modal');
    modal.style.display = 'flex';
    modal.offsetHeight;
    modal.classList.add('show');

    document.getElementById('codigo').value = codigo;
    document.getElementById('nombre').value = nombre;
    document.getElementById('stock').value = stock;
}

function cerrarModal() {
    const modal = document.getElementById('modal');

    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300); 
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
            setTimeout(() => {
                location.reload();
            }, 300);
        }
    });
});