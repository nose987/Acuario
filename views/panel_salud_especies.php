<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/panel.css">
    <title>Panel Alimentación</title>
</head>

<body>

    <?php include("layout/header.php") ?>

    <div class="contenido">
        <div class="aside"><?php include("layout/aside.php") ?></div>
        <div class="cont-container">
            <div class="container">
                <a href="registro_salud_especies.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Salud especies</h2>
                        </div>
                    </div>
                </a>
                <a href="registro_diagnostico_especies.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Diagnostico</h2>
                        </div>
                    </div>
                </a>
                <a href="registro_tratamiento_especies.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Tratamiento</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="container">
                <a href="lista_salud_especies.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Ver salud de especies</h2>
                        </div>
                    </div>
                </a>
                <a href="lista_diagnostico_especies.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Ver diagnosticos</h2>
                        </div>
                    </div>
                </a>
                <a href="lista_tratamiento_especies.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Ver tratamientos</h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>



    </div>

</body>

</html>