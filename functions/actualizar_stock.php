<?php

include("../Class/clase_inventario.php");
$inventario = new Inventario();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nuevoStock = $_POST['nuevo_stock'];
    $codigo = $_POST['codigo'];
    
    $resultado = $inventario->actualizar_stock($codigo, $nuevoStock);
    
    if($resultado){
        echo "Stock actualizado correctamente";
    } else {
        echo "Error al actualizar el stock";
    }
}
?>
