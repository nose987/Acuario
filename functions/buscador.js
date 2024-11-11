function buscarInventario() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_inventario.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
