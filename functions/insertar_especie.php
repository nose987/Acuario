<?php
include("../Class/especie.php");
$especie=new Especie();

$nombre=$_POST["nombre"];
$descripcion=$_POST["descripcion"];
$habitad=$_POST["habitad"];
$temperatura=$_POST["temperatura"];
$cuidados=$_POST["cuidados"];
$fk_tipo_especie=$_POST["fk_tipo_especie"];
$fk_alimento=$_POST["fk_alimento"];

$archivo=$_FILES["img_especie"]["tmp_name"];
$foto=$_FILES["img_especie"]["name"];

move_uploaded_file($archivo,"img/".$foto);

$respuesta=$especie->insertar($nombre,$descripcion,$habitad,$temperatura,$cuidados,$img_especie,$fk_tipo_especie,$fk_alimento);

if ($respuesta) {
    header("Location:../views/lista_especies.php");
    exit;
}else {
echo "<script>
    alert('Error al guardar la especie');
    window.location.href = 'index.php';
</script>";
}
?>