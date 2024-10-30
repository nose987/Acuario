<?php
include 'clases/clases.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = $_POST['nombres'];
    $apaterno = $_POST['apaterno'];
    $amaterno = $_POST['amaterno'];
    $fk_area = $_POST['fk_area'];
    $fecha_nac = $_POST['fecha_nac'];
    $genero = $_POST['genero'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $num_telefono = $_POST['num_telefono'];
    $contrasena = $_POST['contrasena'];
    $pk_rol = $_POST['rol'];

    $usuario = new ValidarUsuario();
    $registroExitoso = $usuario->registrar($nombres, $apaterno, $amaterno, $fk_area, 
        $fecha_nac, $genero, $direccion, $correo, $num_telefono, $contrasena, $pk_rol);

    if ($registroExitoso) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>
