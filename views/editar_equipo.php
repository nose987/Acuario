<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();
?>
<?php
require_once '../Class/clases.php';
$opcionesFormulario = new OpcionesFormulario();

// Fetch equipment details for editing
$equipo_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$equipo = new OpcionesFormulario();
$detalles_equipo = $equipo->obtenerEquipoPorId($equipo_id);

if (!$detalles_equipo) {
    // Redirect or show error if equipment not found
    header('Location: tabla_equipo.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/formulario.css">
    <title>Editar Equipo</title>
</head>
<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="container">
            <div class="titulo">
                <h1>Editar Equipo</h1>
            </div>

            <form action="../functions/editar_equipo.php" method="POST">
                <input type="hidden" name="pk_equipo" value="<?php echo $detalles_equipo['pk_equipo']; ?>">
                
                <div class="formulario">
                    <label for="nombre">Nombre:</label>
                    <input class="input" type="text" id="nombre" name="nombre" 
                           value="<?php echo htmlspecialchars($detalles_equipo['nombre']); ?>" required>

                    <label for="estado">Estado:</label>
                    <select class="input" id="estado" name="estado" required>
                        <option value="Bueno" <?php echo ($detalles_equipo['estado'] == 'Bueno') ? 'selected' : ''; ?>>Bueno</option>
                        <option value="Regular" <?php echo ($detalles_equipo['estado'] == 'Regular') ? 'selected' : ''; ?>>Regular</option>
                        <option value="Malo" <?php echo ($detalles_equipo['estado'] == 'Malo') ? 'selected' : ''; ?>>Malo</option>
                    </select>

                    <label for="fk_tanque">Tanque:</label>
                    <select class="input" id="fk_tanque" name="fk_tanque" required>
                        <?php echo $opcionesFormulario->obtenerOpcionesTanques($detalles_equipo['fk_tanque']); ?>
                    </select>

                    <div class="btn_formulario">
                        <input class="btn" type="submit" value="Actualizar Equipo">
                        <a onclick="window.location.href='tabla_equipo.php'" class="btn" type="button">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>