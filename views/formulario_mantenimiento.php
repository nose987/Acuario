<?php
include '../Class/mantenimiento.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/inventario/registro_medicamento.css">
    <title>Registro de Mantenimientos</title>
</head>

<body>


    <?php include("layout/header.php") ?>
    <div class="contenido">
        <aside>
            <?php include("layout/aside.php") ?>
        </aside>
        <div class="container">
            <div class="titulo">
                <h1>Registro de Mantenimientos</h1>
            </div>

            <form action="../functions/mantenimiento.php" method="POST">
                <div class="formulario">

                <label for="fk_equipo">Tipo de equipo:</label>
                    <select class="input" name="fk_equipo" id="fk_equipo" required>
                        <option value="">Seleccione un tipo de equipo</option>
                        <?php
                        include("../Class/equipo.php");
                        $mante = new Equipo();
                        $tipos = $mante->mostrar();
                        while ($item = mysqli_fetch_array($tipos)) {
                        ?>
                            <option value="<?= $item['pk_equipo'] ?>"><?= $item["nombre"] ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <label for="tipo_mante">Tipo de mantenimiento:</label>
                    <input class="input" type="text" id="tipo_mante" name="tipo_mante" required>

                    <label for="descripcion">Descripcion:</label>
                    <input class="input" type="text" id="descripcion" name="descripcion" required>

                    

                    <input class="btn" type="submit" value="Registrar Equipo">
                </div>

            </form>
        </div>
    </div>




</body>


</html>