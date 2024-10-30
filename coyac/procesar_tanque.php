<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $capacidad = $_POST['capacidad'];
    $temperatura = $_POST['temperatura'];
    $iluminacion = $_POST['iluminacion'];
    $filtracion = $_POST['filtracion'];
    $pk_area = $_POST['pk_area'];
    $pk_especie = $_POST['pk_especie'];

    $conn = new Conexion();
    $sql = "INSERT INTO tanques (capacidad, temperatura, iluminacion, filtracion, pk_area, pk_especie) 
            VALUES ('$capacidad', '$temperatura', '$iluminacion', '$filtracion', '$pk_area', '$pk_especie')";

    if ($conn->query($sql) === TRUE) {
        echo "Tanque registrado con éxito.";
    } else {
        echo "Error al registrar el tanque: " . $conn->conn->error;
    }
}
?>
