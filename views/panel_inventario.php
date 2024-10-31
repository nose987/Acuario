<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/panel.css">
    <title>Panel inventario</title>
</head>

<body>

    <?php include("layout/header.php") ?>

    <div class="contenido">
        <div class="aside"><?php include("layout/aside.php") ?></div>

        <div class="container">
            <a href="registro_inventario.php">
                <div class="tarjeta">
                    <div class="imagen">
                        <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                    </div>
                    <div class="cont">
                        <h2>Registrar inventario</h2>
                    </div>
                </div>
            </a>
            <a href="inventario.php">
                <div class="tarjeta">
                    <div class="imagen">
                        <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                    </div>
                    <div class="cont">
                        <h2>Inventario</h2>
                    </div>
                </div>
            </a>
        </div>


    </div>

</body>

</html>