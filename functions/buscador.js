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

function buscarTanque() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_tanque.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function buscarEspecie() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_especie.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function buscarAgua() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_agua.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function buscarAlimentacion() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_alimentacion.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function buscarUsuario() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_usuario.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function buscarEquipo() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_equipo.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function buscarMantenimiento() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_mantenimiento.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function buscarSalud() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_salud.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function buscarDiagnostico() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_diagnostico.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function buscarTratamiento() {
    const busqueda = document.getElementById("busqueda").value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../functions/buscar_tratamienta.php?busqueda=${encodeURIComponent(busqueda)}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("tabla-resultados").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
