<?php
require_once("../Class/tipo_especie.php");
$tipo=$_POST["tipo"];

$tipo_especie = new Tipo();
$respuesta = $tipo_especie->insertar($tipo);

if ($respuesta) {
    header("Location:../views/panel_de_especies.php");
    exit;
}else {
echo "<script>
    alert('Error al guardar el tipo de especie');
    window.location.href = '../views/panel_de_especies.php';
</script>";
}
?>