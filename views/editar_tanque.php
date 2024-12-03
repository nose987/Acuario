<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();

require_once '../functions/tanque.php';

// Verificar que se ha proporcionado un ID de tanque
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID de tanque no proporcionado.";
    exit();
}

$tanque = new Tanque();
$id = $_GET['id'];

// Obtener los datos del tanque
$datos_tanque = $tanque->obtener_tanque_por_id($id);

// Obtener áreas
$areas = $tanque->obtener_areas();

// Obtener especies
$especies = $tanque->obtener_especies();

if (!$datos_tanque) {
    echo "Tanque no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tanque</title>
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/formulario.css">
</head>

<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="container">
            <div class="titulo">
                <h2>Editar Tanque</h2>

            </div>
            <form action="../functions/actualizar_tanque.php" method="POST">
                <div class="formulario">

                    <input type="hidden" name="pk_tanque" value="<?php echo $datos_tanque['pk_tanque']; ?>">


                    <label>Capacidad:</label>
                    <input class="input" type="text" name="capacidad" value="<?php echo htmlspecialchars($datos_tanque['capacidad']); ?>" required>


                    <label>Temperatura:</label>
                    <input class="input" type="text" name="temperatura" value="<?php echo htmlspecialchars($datos_tanque['temperatura']); ?>" required>

                    <label>Iluminación:</label>
                    <input class="input" type="text" name="iluminacion" value="<?php echo htmlspecialchars($datos_tanque['iluminacion']); ?>" required>

                    <label>Filtración:</label>
                    <select class="input" id="filtracion" name="filtracion" placeholder="Ingrese si cuenta con filtración (si/no)" required>
                        <option value="">Elija si lleva filtración o no.</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <label>Área:</label>
                    <select class="input" name="fk_area" required>
                        <?php foreach ($areas as $area): ?>
                            <option value="<?php echo $area['pk_area']; ?>"
                                <?php echo ($area['pk_area'] == $datos_tanque['fk_area']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($area['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label>Especie:</label>
                    <select class="input" name="fk_especie" required>
                        <?php foreach ($especies as $especie): ?>
                            <option value="<?php echo $especie['pk_especie']; ?>"
                                <?php echo ($especie['pk_especie'] == $datos_tanque['fk_especie']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($especie['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    

                    <div class="btn_formulario">
                        <input type="submit" value="Actualizar Tanque" class="btn">
                        <a href="tabla_tanques.php" type="button" class="btn">Cancelar</a>

                    </div>


                </div>
            </form>
        </div>
    </div>
</body>

</html>