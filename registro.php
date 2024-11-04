
<?php
include 'conexion.php'; 
include 'class/clases.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se completan todos los campos requeridos
    $requiredFields = ['nombre', 'apaterno', 'amaterno', 'fecha_nac', 'direccion', 'correo', 'telefono', 'contrasena', 'edad', 'fk_area', 'fk_roles', 'genero'];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            die("Por favor, completa todos los campos requeridos.");
        }
    }

    // Asigna valores desde el formulario
    $nombre = $_POST['nombre'];
    $apaterno = $_POST['apaterno'];
    $amaterno = $_POST['amaterno'];
    $fk_area = $_POST['fk_area'];
    $fecha_nac = $_POST['fecha_nac'];
    $genero = $_POST['genero'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $edad = $_POST['edad'];
    $fk_roles = $_POST['fk_roles'];

    // Crear una instancia de ValidarUsuario
    $usuario = new ValidarUsuario();

    // Llama al método registrar
    $registroExitoso = $usuario->registrar($nombre, $apaterno, $amaterno, $fk_area, 
        $fecha_nac, $genero, $direccion, $correo, $telefono, $contrasena, $edad, $fk_roles);

    if ($registroExitoso === true) {
        header("Location: index.php");
        exit;
    } else {
        echo $registroExitoso; // Imprimir mensaje de error si la consulta falla
    }
}
?>


