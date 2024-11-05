<?php
include '../Class/clases.php';

$opcionesFormulario = new OpcionesFormulario();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/inventario/registro_medicamento.css">
    <link rel="icon" href="../Storage/logo.jpg">
    <title>Registro de Usuario</title>
</head>
<body>

<?php include("layout/header.php")?>

<div class="contenido">
    <aside>
    <?php include("layout/aside.php") ?>
    </aside>
    <div class="container">
        <div class="titulo">

            <h1>Registro de Usuario</h1>
        </div>
        <form action="../functions/registro.php" method="POST">
            <div class="formulario">

                <label for="nombre">Nombre(s):</label>
                <input type="text" class="input" id="nombre" name="nombre" required>
    
                <label for="apaterno">Apellido Paterno:</label>
                <input type="text" class="input" id="apaterno" name="apaterno" required>
    
                <label for="amaterno">Apellido Materno:</label>
                <input type="text" class="input" id="amaterno" name="amaterno" required>
    
                <label for="fecha_nac">Fecha de Nacimiento:</label>
                <input type="date" class="input" id="fecha_nac" name="fecha_nac" required>
    
                <label for="direccion">Dirección:</label>
                <input type="text" class="input" id="direccion" name="direccion" required>
    
                <label for="correo">Correo:</label>
                <input type="email" class="input" id="correo" name="correo" required>
    
                <label for="telefono">Número de Teléfono:</label>
                <input type="text" class="input" id="telefono" name="telefono" required>
    
                <label for="contrasena">Contraseña:</label>
                <input type="password" class="input" id="contrasena" name="contrasena" required>
    
                <label for="fk_area">Área:</label>
                <select class="input" id="fk_area" name="fk_area" required>
                    <?php echo $opcionesFormulario->obtenerOpcionesAreas(); ?>
                </select>
    
                <label for="edad">Edad:</label>
                <input type="number" class="input" id="edad" name="edad" required>
    
                <label for="fk_roles">Tipo de usuario (Rol):</label> 
                <select class="input" id="fk_roles" name="fk_roles" required> 
                <?php echo $opcionesFormulario->obtenerOpcionesRoles(); ?>
                </select>
    
    
                <label for="genero">Género:</label>
                <select class="input" id="genero" name="genero" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
                <div class="btn_formulario">

                    <input type="submit" value="Registrar" class="btn">
                </div>
            </div>
        </form>
    </div>
</div>
    
</body>
</html>
