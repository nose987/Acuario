<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/panel.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Panel especies</title>
</head>

<body>

    <?php include("layout/header.php") ?>

    <div class="contenido">
        <div class="aside"><?php include("layout/aside.php") ?></div>

        <div class="cont-container">
        <div class="container">
            <a href="lista_especies.php">
                <div class="tarjeta">
                    <div class="imagen">
                        <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                    </div>
                    <div class="cont">
                        <h2>Especies</h2>
                    </div>
                </div>
            </a>
            <a href="formulario_especies.php">
                <div class="tarjeta">
                    <div class="imagen">
                        <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                    </div>
                    <div class="cont">
                        <h2>Registrar especies</h2>
                    </div>
                </div>
            </a>

            <a href="formulario_tipo_esp.php">
                <div class="tarjeta">
                    <div class="imagen">
                        <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                    </div>
                    <div class="cont">
                        <h2>Registrar tipo de especies</h2>
                    </div>
                </div>
            </a>
            
        </div>
        
        </div>



    </div>

</body>

</html>