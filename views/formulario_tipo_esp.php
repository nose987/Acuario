<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/inventario/registro_medicamento.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Registrar tipo de especie</title>
</head>

<body>

    <?php include("layout/header.php") ?>

    <div class="contenido">
        <aside>
            <?php include("layout/aside.php") ?>
        </aside>

        <div class="container">
            <div class="titulo">
                <h2>Tipo de Especie</h2>
            </div>
            <form id="tipoForm" action="../functions/insertar_tipo_esp.php" method="post" enctype="multipart/form-data" class="form-tipo" onsubmit="return validarFormulario()">
                <div class="formulario">



                    <label for="tipo">Tipo:</label>
                    <input class="input" type="text" id="tipo" name="tipo">

                    <div class="btn_formulario">

                        <input class="btn" type="submit" value="Guardar"><br><br>
    
                        <a class="btn" type="button" onclick="window.location.href='panel_de_especies.php'">
                            cancelar
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