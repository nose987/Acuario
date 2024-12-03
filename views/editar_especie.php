<?php
require_once '../Class/clase_login.php';
$login = new Login();
$login->protegerPagina();

include_once('../Class/especie.php');
$especie = new Especie();

// Obtener el ID de la especie a editar
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: lista_especies.php');
    exit();
}

$id = $_GET['id'];
$resultado = $especie->obtener_especie_por_id($id);

if (!$resultado) {
    header('Location: lista_especies.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/formulario.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Editar Especie</title>
</head>
<body>
    <?php include("layout/header.php") ?>
    <div class="contenido">
        <div class="container">
            <div class="titulo">
                <h2>Editar Especie</h2>
            </div>
            <form id="especieForm" action="../functions/actualizar_especie.php" method="post" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                <input type="hidden" name="pk_especie" value="<?php echo $resultado['pk_especie']; ?>">
                <div class="formulario">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="input" name="nombre" id="nombre" required value="<?php echo htmlspecialchars($resultado['nombre']); ?>">

                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" class="input" id="descripcion" required><?php echo htmlspecialchars($resultado['descripcion']); ?></textarea>

                    <label for="fk_alimento">Alimentación:</label>
                    <select class="input" name="fk_alimento" id="fk_alimento" required>
                        <option value="">Seleccione el alimento</option>
                        <?php 
                        $alimento = $especie->mostrarAlimentacion();
                        while ($item = mysqli_fetch_array($alimento)) {
                            $selected = ($item['pk_inventario'] == $resultado['fk_alimento']) ? 'selected' : '';
                            echo "<option value='". $item['pk_inventario']. "' $selected>". $item['nombre']. "</option>";
                        }
                        ?>
                    </select>

                    <label for="habitad">Hábitat:</label>
                    <input type="text" class="input" name="habitad" id="habitad" required value="<?php echo htmlspecialchars($resultado['habitad']); ?>">

                    <label for="temperatura">Temperatura (°C):</label>
                    <input type="number" class="input" name="temperatura" id="temperatura" step="0.1" required value="<?php echo htmlspecialchars($resultado['temperatura']); ?>">

                    <label for="cuidados">Cuidados:</label>
                    <textarea name="cuidados" class="input" id="cuidados" required><?php echo htmlspecialchars($resultado['cuidados']); ?></textarea>

                    <label for="img_especie">Imagen:</label>
                    <input type="file" class="input" name="img_especie" id="img_especie">
                    <?php if (!empty($resultado['img_especie'])): ?>
                        <div>
                            <p>Imagen actual:</p>
                            <img src="../Storage/<?php echo htmlspecialchars($resultado['img_especie']); ?>" alt="Imagen actual" width="200">
                        </div>
                    <?php endif; ?>

                    <label for="fk_tipo_especie">Tipo de Especie:</label>
                    <select class="input" name="fk_tipo_especie" id="fk_tipo_especie" required>
                        <option value="">Seleccione un tipo de especie</option>
                        <?php
                        include("../Class/tipo_especie.php");
                        $tipo_especie = new Tipo();
                        $tipos = $tipo_especie->mostrar();
                        while ($item = mysqli_fetch_array($tipos)) {
                            $selected = ($item['pk_tipo_especie'] == $resultado['fk_tipo_especie']) ? 'selected' : '';
                        ?>
                            <option value="<?= $item['pk_tipo_especie'] ?>" <?= $selected ?>><?= $item["tipo"] ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <div class="btn_formulario">
                        <input class="btn" type="submit" value="Actualizar">
                        <a class="btn" type="button" onclick="window.location.href='lista_especies.php'">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    function validarFormulario() {
        const campos = [
            { id: "nombre", name: "Nombre" },
            { id: "descripcion", name: "Descripción" },
            { id: "fk_alimento", name: "Alimentación" },
            { id: "habitad", name: "Hábitat" },
            { id: "temperatura", name: "Temperatura" },
            { id: "cuidados", name: "Cuidados" },
            { id: "fk_tipo_especie", name: "Tipo de Especie" }
        ];

        for (const campo of campos) {
            const valor = document.getElementById(campo.id).value.trim();
            if (valor === "") {
                alert(`Por favor, complete el campo: ${campo.name}`);
                document.getElementById(campo.id).focus();
                return false;
            }
        }

        return true;
    }
    </script>
</body>
</html>