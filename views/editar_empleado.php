<?php
require_once '../Class/clases.php'; // Ruta ajustada según tu proyecto.

$opcionesFormulario = new OpcionesFormulario();
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $empleado = $opcionesFormulario->obtenerEmpleadoPorId($id);

    if (!$empleado) {
        header("Location: ../lista_usuario.php?mensaje=Empleado no encontrado");
        exit;
    }
} else {
    header("Location: ../lista_usuario.php?mensaje=ID no proporcionado");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datosActualizados = [
        'nombre' => $_POST['nombre'],
        'apaterno' => $_POST['apaterno'],
        'amaterno' => $_POST['amaterno'],
        'fecha_nac' => $_POST['fecha_nac'],
        'direccion' => $_POST['direccion'],
        'correo' => $_POST['correo'],
        'telefono' => $_POST['telefono'],
        'genero' => $_POST['genero'],
        'fk_roles' => $_POST['fk_roles'],
        'fk_area' => $_POST['fk_area'],
        'id' => $id
    ];
    
    if ($opcionesFormulario->actualizarEmpleado($datosActualizados)) {
        header("Location: ../lista_usuario.php?mensaje=Empleado actualizado correctamente");
    } else {
        echo "Error al actualizar el empleado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../Styles/formulario.css">
</head>
<body>
    <h1>Editar Usuario</h1>
    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($empleado['nombre']) ?>" required>
        
        <label>Apellido Paterno:</label>
        <input type="text" name="apaterno" value="<?= htmlspecialchars($empleado['apaterno']) ?>" required>
        
        <label>Apellido Materno:</label>
        <input type="text" name="amaterno" value="<?= htmlspecialchars($empleado['amaterno']) ?>" required>
        
        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nac" value="<?= htmlspecialchars($empleado['fecha_nac']) ?>" required>
        
        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?= htmlspecialchars($empleado['direccion']) ?>" required>
        
        <label>Correo Electrónico:</label>
        <input type="email" name="correo" value="<?= htmlspecialchars($empleado['correo']) ?>" required>
        
        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?= htmlspecialchars($empleado['telefono']) ?>" required>
        
        <label>Género:</label>
        <select name="genero" required>
            <option value="M" <?= $empleado['genero'] == 'M' ? 'selected' : '' ?>>Masculino</option>
            <option value="F" <?= $empleado['genero'] == 'F' ? 'selected' : '' ?>>Femenino</option>
        </select>
        
        <label>Rol:</label>
        <input type="text" name="fk_roles" value="<?= htmlspecialchars($empleado['fk_roles']) ?>" required>
        
        <label>Área:</label>
        <input type="text" name="fk_area" value="<?= htmlspecialchars($empleado['fk_area']) ?>" required>
        
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
