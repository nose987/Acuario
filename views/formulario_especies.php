<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/formulario.css">
    <title>Formulario de especies</title>
</head>

<body>

    <?php include("layout/header.php") ?>
    <div class="contenido">
        <!--<aside>
            <?php //include("layout/aside.php") ?>
        </aside>-->
        <div class="container">
            <div class="titulo">
                <h2>Nueva Especie</h2>
            </div>
            <form id="especieForm" action="../functions/insertar_especie.php" method="post" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                <div class="formulario">

                    <label for="nombre">Nombre:</label>
                    <input type="text" class="input" name="nombre" id="nombre" required>

                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" class="input" id="descripcion" required></textarea>

                    <label for="alimentacion">Alimentación:</label>
                    <input type="text" class="input" name="alimentacion" id="alimentacion" required>

                    <label for="habitad">Hábitat:</label>
                    <input type="text" class="input" name="habitad" id="habitad" required>

                    <label for="temperatura">Temperatura (°C):</label>
                    <input type="number" class="input" name="temperatura" id="temperatura" step="0.1" required>

                    <label for="cuidados">Cuidados:</label>
                    <textarea name="cuidados" class="input" id="cuidados" required></textarea>

                    <label for="img_especie">Imagen:</label>
                    <input type="file" class="input" name="img_especie" id="img_especie" required>

                    <label for="fk_tipo_especie">Tipo de Especie:</label>
                    <select class="input" name="fk_tipo_especie" id="fk_tipo_especie" required>
                        <option value="">Seleccione un tipo de especie</option>
                        <?php
                        include("../Class/tipo_especie.php");
                        $tipo_especie = new Tipo();
                        $tipos = $tipo_especie->mostrar();
                        while ($item = mysqli_fetch_array($tipos)) {
                        ?>
                            <option value="<?= $item['pk_tipo_especie'] ?>"><?= $item["tipo"] ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <div class="btn_formulario">

                        <input class="btn" type="submit" value="Guardar">
                        <a  class="btn" type="button" onclick="window.location.href='panel.php'">
                            Cancelar
                        </a>
                    </div>

                </div>


            </form>
        </div>
    </div>


    <script>
        function validarFormulario() {
            const campos = [{
                id: "tipo",
                name: "tipo"
            }];

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