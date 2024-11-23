<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION["usuario_id"])){
    header("Location: login.php");
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/panel2.css">
    <title>Panel</title>
</head>

<body>
    <?php include("layout/header.php");
    
    /*print_r($_SESSION);*/
    ?>
    
    

    <div class="contenido">
        <div class="aside"><?php include("layout/aside.php") ?></div>

        <div class="container">
            <!-- Sección de inicio -->
            <div class="cards-container active" id="inicio-section">
                <h1 class="section-title">Panel Principal</h1>
                <!-- Agregar tarjetas de inicio -->

            </div>

            <!-- Sección de inventario -->
            <div class="cards-container" id="inventario-section">
                <h1 class="section-title">Gestión de Inventario</h1>
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

            <!-- Sección de agua -->
            <div class="cards-container" id="agua-section">
                <h1 class="section-title">Control del agua</h1>
                <a href="formulario_agua.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Registrar calidad del agua</h2>
                        </div>
                    </div>
                </a>
                <a href="tabla_agua.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Calidad del agua</h2>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Sección de alimentación -->
            <div class="cards-container" id="alimentacion-section">
                <h1 class="section-title">Gestión de alimentación</h1>
                <a href="alimentacion.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Registro alimentación</h2>
                        </div>
                    </div>
                </a>
                <a href="tabla_alimentacion.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Programación alimentación</h2>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Sección de tanque -->
            <div class="cards-container" id="tanque-section">
                <h1 class="section-title">Gestión de tanques</h1>
                <a href="gestion_tanque.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Registrar tanque</h2>
                        </div>
                    </div>
                </a>
                <a href="tabla_tanques.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Tanques</h2>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Sección de salud -->
            <div class="cards-container" id="salud-section">
                <h1 class="section-title">Gestión de salud de las especies</h1>
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

            <!-- Sección de empleados -->
            <div class="cards-container" id="empleado-section">
                <h1 class="section-title">Gestión de empleados</h1>
                <a href="registro_usuario.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Registrar Empleados</h2>
                        </div>
                    </div>
                </a>
                <a href="lista_usuario.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Lista Empleados</h2>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Sección de especies -->
            <div class="cards-container" id="especie-section">
                <h1 class="section-title">Gestión de empleados</h1>
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
            <!-- Sección de equipos -->
            <div class="cards-container" id="equipo-section">
                <h1 class="section-title">Gestión de equipos</h1>
                <a href="formulario_equipo.php">
                    <div class="tarjeta"> 
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Registrar equipos</h2>
                        </div>
                    </div>
                </a>
                <a href="tabla_equipo.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Lista de equipos</h2>
                        </div>
                    </div>
                </a>
                

            </div>
            <!-- Sección de mantenimiento -->
            <div class="cards-container" id="mantenimiento-section">
                <h1 class="section-title">Mantenimiento de equipos</h1>
                <a href="formulario_mantenimiento.php">
                    <div class="tarjeta"> 
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Registrar mantenimiento</h2>
                        </div>
                    </div>
                </a>
                <a href="tabla_mantenimiento.php">
                    <div class="tarjeta">
                        <div class="imagen">
                            <img src="../Storage/logo.jpg" alt="logo" height="150px" width="290px">
                        </div>
                        <div class="cont">
                            <h2>Lista de mantenimientos</h2>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</body>
<script src="../functions/aside.js"></script>

</html>