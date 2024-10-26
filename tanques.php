<?php
include 'class/clases.php';
$conn = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $capacidad = $_POST['capacidad'];
    $temperatura = $_POST['temperatura'];
    $iluminacion = $_POST['iluminacion'];
    $filtracion = $_POST['filtracion'];
    $pk_area = $_POST['pk_area'];
    $pk_especie = $_POST['pk_especie'];

    $sql = "INSERT INTO tanque (capacidad, temperatura, iluminacion, filtracion, pk_area, pk_especie) VALUES ('$capacidad', '$temperatura', '$iluminacion', '$filtracion', '$pk_area', '$pk_especie')";

    if ($conn->query($sql) === TRUE) {
        header("Location: AQUIE SE PONE A DONDE DIRIGE.php?status=success");
    } else {
        header("Location: AQUIE SE PONE A DONDE DIRIGE.php?status=error");
    }
}
