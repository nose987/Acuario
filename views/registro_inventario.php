<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Storage/logo.jpg">
    <link rel="stylesheet" href="../Styles/formulario.css">
    <title>Registro Medicamento</title>
</head>

<body>




<?php include("layout/header.php") ?>

<div class="contenido">
    <!--<div class="aside">
        <?php //include("layout/aside.php") ?>
    </div>-->
    
    <div class="container">
        <div class="titulo">
            <h1>Registro de inventario</h1>
        </div>
        
        <form action="../Class/clase_inventario.php" method="POST">
            <div class="formulario">
                <label for="codigo">Código</label>
                <input type="text" class="input" name="codigo" placeholder="Ingrese el código del producto" required>

                <label for="nombre">Nombre</label>
                <input type="text" class="input" name="nombre" placeholder="Ingrese el nombre del producto" required>

                <label for="categoria">Categoría</label>
                <select class="input" name="categoria" id="categoria">
                    <?php include("../Class/clase_inventario.php");
                        $categoria = new Inventario();
                        $categorias = $categoria->categoria();
                        foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria['pk_categoria']; ?>">
                                <?php echo htmlspecialchars($categoria['nombre']); ?>
                            </option>
                    <?php endforeach; ?>
                </select>

                <label for="stock">Cantidad</label>
                <input type="text" class="input" name="stock" placeholder="Ingrese la cantidad del producto" required>

                <label for="descripcion">Descripción</label>
                <textarea class="input" name="descripcion" placeholder="Ingrese una breve descripción del producto" required></textarea>

                <div class="btn_formulario">
                    <input type="submit" value="Guardar" class="btn">
                    <a onclick="window.location.href='panel.php'" class="btn" type="button">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>

</body>

</html>